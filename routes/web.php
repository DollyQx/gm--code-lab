<?php

use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LeadController as AdminLeadController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ProjectRequirementController as AdminProjectRequirementController;
use App\Http\Controllers\Admin\ProjectMilestoneController as AdminProjectMilestoneController;
use App\Http\Controllers\Admin\ProjectTaskController as AdminProjectTaskController;
use App\Http\Controllers\Admin\QuotationController as AdminQuotationController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\RazorpayPaymentController as AdminRazorpayPaymentController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Public\RazorpayWebhookController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\ClientLoginController;
use App\Http\Controllers\Auth\ClientRegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\InvoiceController as ClientInvoiceController;
use App\Http\Controllers\Client\PaymentController as ClientPaymentController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\ProjectController as ClientProjectController;
use App\Http\Controllers\Client\QuotationController as ClientQuotationController;
use App\Http\Controllers\Client\RazorpayPaymentController as ClientRazorpayPaymentController;
use App\Http\Controllers\Client\SupportTicketController as ClientSupportTicketController;
use App\Http\Controllers\Admin\AdminSupportTicketController;
use App\Http\Controllers\Client\ChangeRequestController as ClientChangeRequestController;
use App\Http\Controllers\Admin\AdminChangeRequestController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\IndustryController;
use App\Http\Controllers\Public\PortfolioController;
use App\Http\Controllers\Public\ServiceController;
use App\Http\Controllers\Public\StartProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Website Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/industries', [IndustryController::class, 'index'])->name('industries.index');
Route::get('/industries/{slug}', [IndustryController::class, 'show'])->name('industries.show');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/start-project', [StartProjectController::class, 'index'])->name('start-project');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Guest Routes - Client Authentication
Route::middleware('guest')->group(function () {
    Route::get('/register', [ClientRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [ClientRegisterController::class, 'register'])->middleware('throttle:6,1');

    Route::get('/login', [ClientLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ClientLoginController::class, 'login'])->middleware('throttle:6,1');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('throttle:6,1');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update')->middleware('throttle:6,1');
});

// Guest Routes - Admin Authentication
Route::middleware('guest')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->middleware('throttle:6,1');
});

// Protected Client Routes
Route::middleware(['auth', 'active', 'role:client'])->group(function () {
    Route::post('/logout', [ClientLoginController::class, 'logout'])->name('logout');

    // Email Verification Notice & Handlers
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [VerificationController::class, 'resend'])->middleware('throttle:6,1')->name('verification.send');

    // Client Dashboard & Profile
    Route::get('/client/dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
    Route::get('/client/profile', [ProfileController::class, 'show'])->name('client.profile');
    Route::put('/client/profile', [ProfileController::class, 'update'])->name('client.profile.update');

    // Client Projects
    Route::get('/client/projects', [ClientProjectController::class, 'index'])->name('client.projects.index');
    Route::get('/client/projects/{project}', [ClientProjectController::class, 'show'])->name('client.projects.show');

    // Client Quotations
    Route::get('/client/quotations', [ClientQuotationController::class, 'index'])->name('client.quotations.index');
    Route::get('/client/quotations/{quotation}', [ClientQuotationController::class, 'show'])->name('client.quotations.show');
    Route::post('/client/quotations/{quotation}/accept', [ClientQuotationController::class, 'accept'])->name('client.quotations.accept');
    Route::post('/client/quotations/{quotation}/reject', [ClientQuotationController::class, 'reject'])->name('client.quotations.reject');

    // Client Invoices
    Route::get('/client/invoices', [ClientInvoiceController::class, 'index'])->name('client.invoices.index');
    Route::get('/client/invoices/{invoice}', [ClientInvoiceController::class, 'show'])->name('client.invoices.show');

    // Client Online Payments (Razorpay)
    Route::post('/client/invoices/{invoice}/razorpay/order', [ClientRazorpayPaymentController::class, 'createOrder'])->name('client.invoices.razorpay.order');
    Route::post('/client/invoices/{invoice}/razorpay/verify', [ClientRazorpayPaymentController::class, 'verifyPayment'])->name('client.invoices.razorpay.verify');

    // Client Payment History & Receipts
    Route::get('/client/payments', [ClientPaymentController::class, 'index'])->name('client.payments.index');
    Route::get('/client/payments/{payment}', [ClientPaymentController::class, 'show'])->name('client.payments.show');
    Route::get('/client/payments/{payment}/receipt', [ClientPaymentController::class, 'receipt'])->name('client.payments.receipt');

    // Client Support Tickets (Phase 7C.1)
    Route::get('/client/tickets', [ClientSupportTicketController::class, 'index'])->name('client.tickets.index');
    Route::get('/client/tickets/create', [ClientSupportTicketController::class, 'create'])->name('client.tickets.create');
    Route::post('/client/tickets', [ClientSupportTicketController::class, 'store'])->name('client.tickets.store');
    Route::get('/client/tickets/{ticket}', [ClientSupportTicketController::class, 'show'])->name('client.tickets.show');
    Route::post('/client/tickets/{ticket}/reply', [ClientSupportTicketController::class, 'reply'])->name('client.tickets.reply');

    // Client Change Requests (Phase 7C.2)
    Route::get('/client/change-requests', [ClientChangeRequestController::class, 'index'])->name('client.change-requests.index');
    Route::get('/client/change-requests/create', [ClientChangeRequestController::class, 'create'])->name('client.change-requests.create');
    Route::post('/client/change-requests', [ClientChangeRequestController::class, 'store'])->name('client.change-requests.store');
    Route::get('/client/change-requests/{changeRequest}', [ClientChangeRequestController::class, 'show'])->name('client.change-requests.show');
    Route::post('/client/change-requests/{changeRequest}/cancel', [ClientChangeRequestController::class, 'cancel'])->name('client.change-requests.cancel');
});

// Protected Admin CRM Routes
Route::middleware(['auth', 'active', 'role:admin,super_admin,support,project_manager,developer'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Client Management
    Route::get('/clients', [AdminClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/{client}', [AdminClientController::class, 'show'])->name('clients.show');

    // Lead Management
    Route::get('/leads', [AdminLeadController::class, 'index'])->name('leads.index');
    Route::get('/leads/create', [AdminLeadController::class, 'create'])->name('leads.create');
    Route::post('/leads', [AdminLeadController::class, 'store'])->name('leads.store');
    Route::get('/leads/{lead}', [AdminLeadController::class, 'show'])->name('leads.show');
    Route::get('/leads/{lead}/edit', [AdminLeadController::class, 'edit'])->name('leads.edit');
    Route::put('/leads/{lead}', [AdminLeadController::class, 'update'])->name('leads.update');
    Route::patch('/leads/{lead}/status', [AdminLeadController::class, 'updateStatus'])->name('leads.status');

    // Project Management
    Route::get('/projects', [AdminProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [AdminProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [AdminProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [AdminProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [AdminProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [AdminProjectController::class, 'update'])->name('projects.update');
    Route::patch('/projects/{project}/status', [AdminProjectController::class, 'updateStatus'])->name('projects.status');

    // Requirements
    Route::post('/projects/{project}/requirements', [AdminProjectRequirementController::class, 'store'])->name('projects.requirements.store');
    Route::put('/projects/{project}/requirements/{requirement}', [AdminProjectRequirementController::class, 'update'])->name('projects.requirements.update');
    Route::patch('/projects/{project}/requirements/{requirement}/status', [AdminProjectRequirementController::class, 'updateStatus'])->name('projects.requirements.status');

    // Milestones
    Route::post('/projects/{project}/milestones', [AdminProjectMilestoneController::class, 'store'])->name('projects.milestones.store');
    Route::put('/projects/{project}/milestones/{milestone}', [AdminProjectMilestoneController::class, 'update'])->name('projects.milestones.update');
    Route::patch('/projects/{project}/milestones/{milestone}/status', [AdminProjectMilestoneController::class, 'updateStatus'])->name('projects.milestones.status');

    // Tasks
    Route::post('/projects/{project}/tasks', [AdminProjectTaskController::class, 'store'])->name('projects.tasks.store');
    Route::put('/projects/{project}/tasks/{task}', [AdminProjectTaskController::class, 'update'])->name('projects.tasks.update');
    Route::patch('/projects/{project}/tasks/{task}/status', [AdminProjectTaskController::class, 'updateStatus'])->name('projects.tasks.status');

    // Quotation Management
    Route::get('/quotations', [AdminQuotationController::class, 'index'])->name('quotations.index');
    Route::get('/quotations/create', [AdminQuotationController::class, 'create'])->name('quotations.create');
    Route::post('/quotations', [AdminQuotationController::class, 'store'])->name('quotations.store');
    Route::get('/quotations/{quotation}', [AdminQuotationController::class, 'show'])->name('quotations.show');
    Route::get('/quotations/{quotation}/edit', [AdminQuotationController::class, 'edit'])->name('quotations.edit');
    Route::put('/quotations/{quotation}', [AdminQuotationController::class, 'update'])->name('quotations.update');
    Route::patch('/quotations/{quotation}/status', [AdminQuotationController::class, 'updateStatus'])->name('quotations.status');

    // Invoice Management (Phase 6B)
    Route::get('/invoices', [AdminInvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/create', [AdminInvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [AdminInvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/{invoice}', [AdminInvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/invoices/{invoice}/edit', [AdminInvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('/invoices/{invoice}', [AdminInvoiceController::class, 'update'])->name('invoices.update');
    Route::patch('/invoices/{invoice}/status', [AdminInvoiceController::class, 'updateStatus'])->name('invoices.status');
    Route::post('/invoices/{invoice}/payments', [AdminInvoiceController::class, 'storePayment'])->name('invoices.payments.store');

    // Razorpay Payment Integration (Phase 6C)
    Route::post('/invoices/{invoice}/razorpay/order', [AdminRazorpayPaymentController::class, 'createOrder'])->name('invoices.razorpay.order');
    Route::post('/invoices/{invoice}/razorpay/verify', [AdminRazorpayPaymentController::class, 'verifyPayment'])->name('invoices.razorpay.verify');

    // Payment History & Receipts (Phase 6D)
    Route::get('/payments', [AdminPaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [AdminPaymentController::class, 'show'])->name('payments.show');
    Route::get('/payments/{payment}/receipt', [AdminPaymentController::class, 'receipt'])->name('payments.receipt');

    // Admin Support Ticket Management (Phase 7C.1)
    Route::get('/tickets', [AdminSupportTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [AdminSupportTicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [AdminSupportTicketController::class, 'reply'])->name('tickets.reply');
    Route::post('/tickets/{ticket}/internal-note', [AdminSupportTicketController::class, 'internalNote'])->name('tickets.internal-note');
    Route::patch('/tickets/{ticket}/status', [AdminSupportTicketController::class, 'updateStatus'])->name('tickets.status');
    Route::patch('/tickets/{ticket}/assign', [AdminSupportTicketController::class, 'assign'])->name('tickets.assign');

    // Admin Change Request Management (Phase 7C.2)
    Route::get('/change-requests', [AdminChangeRequestController::class, 'index'])->name('change-requests.index');
    Route::get('/change-requests/{changeRequest}', [AdminChangeRequestController::class, 'show'])->name('change-requests.show');
    Route::put('/change-requests/{changeRequest}/review', [AdminChangeRequestController::class, 'updateReview'])->name('change-requests.review');
    Route::patch('/change-requests/{changeRequest}/approve', [AdminChangeRequestController::class, 'approve'])->name('change-requests.approve');
    Route::patch('/change-requests/{changeRequest}/reject', [AdminChangeRequestController::class, 'reject'])->name('change-requests.reject');
});

// Public Webhooks (Phase 6C)
Route::post('/webhooks/razorpay', [RazorpayWebhookController::class, 'handle'])->name('webhooks.razorpay');
