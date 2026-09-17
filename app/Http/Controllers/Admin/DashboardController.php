<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the basic admin dashboard.
     */
    public function index(Request $request): View
    {
        $adminUser = $request->user();

        $stats = [
            'total_clients' => User::where('role', UserRole::CLIENT->value)->count(),
            'total_admins' => User::whereIn('role', [UserRole::ADMIN->value, UserRole::SUPER_ADMIN->value])->count(),
            'system_status' => 'Operational',
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
        ];

        return view('admin.dashboard', compact('adminUser', 'stats'));
    }
}
