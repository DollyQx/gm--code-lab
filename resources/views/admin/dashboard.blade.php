@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem;">Admin Control Dashboard</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">
            Welcome back, <strong>{{ $adminUser->name }}</strong> ({{ $adminUser->role->label() }}).
        </p>
    </div>

    <div class="grid-stats">
        <div class="stat-card">
            <div class="stat-title">Registered Clients</div>
            <div class="stat-value" style="color: #60a5fa;">{{ $stats['total_clients'] }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-title">Active Administrators</div>
            <div class="stat-value" style="color: #f87171;">{{ $stats['total_admins'] }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-title">System Status</div>
            <div class="stat-value" style="color: #34d399;">{{ $stats['system_status'] }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-title">Environment / Runtime</div>
            <div class="stat-value" style="font-size: 1.125rem; font-weight: 600;">PHP {{ $stats['php_version'] }}</div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;">Laravel {{ $stats['laravel_version'] }}</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Administrative Actions</h3>
            <span class="role-pill role-admin">Root Control</span>
        </div>
        <p style="font-size: 0.875rem; color: var(--text-muted); line-height: 1.6;">
            The authentication and role-based access foundation is active. Administrative command <code>php artisan admin:create</code> is available to provision new internal staff accounts securely.
        </p>
    </div>
@endsection
