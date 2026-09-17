<?php

namespace Tests\Feature\Admin;

use App\Enums\InvoiceStatus;
use App\Enums\PaymentStatus;
use App\Enums\UserRole;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\ProcessedWebhookEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Enums\UserStatus;

class RazorpayPaymentTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $client;
    protected string $keySecret = 'mocksecret456';
    protected string $webhookSecret = 'mockwebhooksecret789';

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.razorpay.key_id' => 'rzp_test_mockkey123',
            'services.razorpay.key_secret' => $this->keySecret,
            'services.razorpay.webhook_secret' => $this->webhookSecret,
        ]);

        $this->admin = User::factory()->create([
            'role' => UserRole::ADMIN,
            'status' => UserStatus::ACTIVE,
        ]);

        $this->client = User::factory()->create([
            'role' => UserRole::CLIENT,
            'status' => UserStatus::ACTIVE,
        ]);
    }

    public function test_admin_can_create_razorpay_order_for_valid_invoice(): void
    {
        $invoice = Invoice::factory()->create([
            'client_id' => $this->client->id,
            'subtotal' => 1000.00,
            'discount' => 0.00,
            'tax' => 180.00,
            'total' => 1180.00,
            'amount_paid' => 0.00,
            'amount_due' => 1180.00,
            'status' => InvoiceStatus::ISSUED,
        ]);

        $response = $this->actingAs($this->admin)
            ->postJson(route('admin.invoices.razorpay.order', $invoice->id));

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'amount' => 118000,
                'currency' => 'INR',
                'invoice_id' => $invoice->id,
            ]);

        $this->assertDatabaseHas('payments', [
            'invoice_id' => $invoice->id,
            'amount' => 1180.00,
            'provider' => 'razorpay',
            'status' => PaymentStatus::PENDING->value,
        ]);
    }

    public function test_cannot_create_razorpay_order_for_fully_paid_or_cancelled_invoice(): void
    {
        $paidInvoice = Invoice::factory()->create([
            'client_id' => $this->client->id,
            'subtotal' => 500.00,
            'discount' => 0.00,
            'tax' => 0.00,
            'total' => 500.00,
            'amount_paid' => 500.00,
            'amount_due' => 0.00,
            'status' => InvoiceStatus::PAID,
        ]);

        Payment::create([
            'reference_number' => 'GMC-PAY-PAID01',
            'invoice_id' => $paidInvoice->id,
            'client_id' => $this->client->id,
            'amount' => 500.00,
            'currency' => 'INR',
            'status' => PaymentStatus::PAID,
        ]);

        $response = $this->actingAs($this->admin)
            ->postJson(route('admin.invoices.razorpay.order', $paidInvoice->id));

        $response->assertStatus(422)
            ->assertJson(['success' => false]);

        $cancelledInvoice = Invoice::factory()->create([
            'client_id' => $this->client->id,
            'subtotal' => 500.00,
            'discount' => 0.00,
            'tax' => 0.00,
            'total' => 500.00,
            'amount_paid' => 0.00,
            'amount_due' => 500.00,
            'status' => InvoiceStatus::CANCELLED,
        ]);

        $cancelledResponse = $this->actingAs($this->admin)
            ->postJson(route('admin.invoices.razorpay.order', $cancelledInvoice->id));

        $cancelledResponse->assertStatus(422)
            ->assertJson(['success' => false]);
    }

    public function test_successful_razorpay_payment_signature_verification_updates_invoice_and_creates_payment(): void
    {
        $invoice = Invoice::factory()->create([
            'client_id' => $this->client->id,
            'total' => 2000.00,
            'amount_paid' => 0.00,
            'amount_due' => 2000.00,
            'status' => InvoiceStatus::ISSUED,
        ]);

        $orderId = 'order_mock_123456';
        $paymentId = 'pay_mock_7891011';

        $payment = Payment::create([
            'reference_number' => 'GMC-PAY-TEST01',
            'invoice_id' => $invoice->id,
            'client_id' => $this->client->id,
            'amount' => 2000.00,
            'currency' => 'INR',
            'provider' => 'razorpay',
            'provider_order_id' => $orderId,
            'status' => PaymentStatus::PENDING,
        ]);

        // Generate cryptographically valid HMAC-SHA256 signature
        $validSignature = hash_hmac('sha256', $orderId . '|' . $paymentId, $this->keySecret);

        $response = $this->actingAs($this->admin)
            ->postJson(route('admin.invoices.razorpay.verify', $invoice->id), [
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $validSignature,
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'invoice_status' => InvoiceStatus::PAID->value,
            ]);

        $this->assertDatabaseHas('payments', [
            'id' => $payment->id,
            'provider_payment_id' => $paymentId,
            'status' => PaymentStatus::PAID->value,
        ]);

        $this->assertDatabaseHas('invoices', [
            'id' => $invoice->id,
            'amount_paid' => 2000.00,
            'amount_due' => 0.00,
            'status' => InvoiceStatus::PAID->value,
        ]);
    }

    public function test_invalid_signature_verification_is_rejected(): void
    {
        $invoice = Invoice::factory()->create([
            'client_id' => $this->client->id,
            'total' => 1500.00,
            'amount_paid' => 0.00,
            'amount_due' => 1500.00,
            'status' => InvoiceStatus::ISSUED,
        ]);

        $orderId = 'order_mock_bad_1';
        $paymentId = 'pay_mock_bad_1';

        Payment::create([
            'reference_number' => 'GMC-PAY-TEST02',
            'invoice_id' => $invoice->id,
            'client_id' => $this->client->id,
            'amount' => 1500.00,
            'currency' => 'INR',
            'provider' => 'razorpay',
            'provider_order_id' => $orderId,
            'status' => PaymentStatus::PENDING,
        ]);

        $response = $this->actingAs($this->admin)
            ->postJson(route('admin.invoices.razorpay.verify', $invoice->id), [
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => 'invalid_tampered_signature_string',
            ]);

        $response->assertStatus(400)
            ->assertJson(['success' => false]);
    }

    public function test_valid_razorpay_webhook_signature_processes_payment_captured_event(): void
    {
        $invoice = Invoice::factory()->create([
            'client_id' => $this->client->id,
            'total' => 5000.00,
            'amount_paid' => 0.00,
            'amount_due' => 5000.00,
            'status' => InvoiceStatus::ISSUED,
        ]);

        $orderId = 'order_webhook_test_99';
        $paymentId = 'pay_webhook_test_99';

        $payment = Payment::create([
            'reference_number' => 'GMC-PAY-TEST03',
            'invoice_id' => $invoice->id,
            'client_id' => $this->client->id,
            'amount' => 5000.00,
            'currency' => 'INR',
            'provider' => 'razorpay',
            'provider_order_id' => $orderId,
            'status' => PaymentStatus::PENDING,
        ]);

        $webhookPayload = [
            'entity' => 'event',
            'account_id' => 'acc_test',
            'event' => 'payment.captured',
            'contains' => ['payment'],
            'payload' => [
                'payment' => [
                    'entity' => [
                        'id' => $paymentId,
                        'entity' => 'payment',
                        'amount' => 500000, // 5000.00 INR in paise
                        'currency' => 'INR',
                        'status' => 'captured',
                        'order_id' => $orderId,
                        'notes' => [
                            'invoice_id' => (string) $invoice->id,
                        ],
                    ],
                ],
            ],
            'created_at' => time(),
        ];

        $rawBody = json_encode($webhookPayload);
        $signature = hash_hmac('sha256', $rawBody, $this->webhookSecret);
        $eventId = 'evt_test_' . time();

        $response = $this->call('POST', route('webhooks.razorpay'), [], [], [], [
            'HTTP_X-Razorpay-Signature' => $signature,
            'HTTP_x-razorpay-event-id' => $eventId,
            'CONTENT_TYPE' => 'application/json',
        ], $rawBody);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('payments', [
            'id' => $payment->id,
            'provider_payment_id' => $paymentId,
            'status' => PaymentStatus::PAID->value,
        ]);

        $this->assertDatabaseHas('invoices', [
            'id' => $invoice->id,
            'amount_paid' => 5000.00,
            'amount_due' => 0.00,
            'status' => InvoiceStatus::PAID->value,
        ]);

        $this->assertDatabaseHas('processed_webhook_events', [
            'event_id' => $eventId,
            'event_type' => 'payment.captured',
        ]);
    }

    public function test_webhook_idempotency_prevents_duplicate_event_credits(): void
    {
        $eventId = 'evt_duplicate_test_123';

        ProcessedWebhookEvent::create([
            'event_id' => $eventId,
            'event_type' => 'payment.captured',
            'provider' => 'razorpay',
            'payload' => [],
            'processed_at' => now(),
        ]);

        $webhookPayload = ['event' => 'payment.captured'];
        $rawBody = json_encode($webhookPayload);
        $signature = hash_hmac('sha256', $rawBody, $this->webhookSecret);

        $response = $this->call('POST', route('webhooks.razorpay'), [], [], [], [
            'HTTP_X-Razorpay-Signature' => $signature,
            'HTTP_x-razorpay-event-id' => $eventId,
            'CONTENT_TYPE' => 'application/json',
        ], $rawBody);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Duplicate webhook event ignored.',
            ]);
    }

    public function test_invalid_webhook_signature_is_rejected(): void
    {
        $rawBody = json_encode(['event' => 'payment.captured']);

        $response = $this->call('POST', route('webhooks.razorpay'), [], [], [], [
            'HTTP_X-Razorpay-Signature' => 'invalid_tampered_signature',
            'HTTP_x-razorpay-event-id' => 'evt_bad_sig',
            'CONTENT_TYPE' => 'application/json',
        ], $rawBody);

        $response->assertStatus(400)
            ->assertJson(['success' => false, 'error' => 'Invalid webhook signature']);
    }
}
