@extends('layouts.app')

@section('title', 'Client Dashboard')

@section('content')
    <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem;">Client Portal</h1>
            <p style="color: var(--text-muted); font-size: 0.875rem;">
                Welcome back, <strong>{{ $client->name }}</strong>
                @if($profile && $profile->company_name)
                    ({{ $profile->company_name }})
                @endif
            </p>
        </div>
        <a href="{{ route('client.profile') }}" style="display: inline-block; padding: 0.625rem 1.25rem; background: rgba(59, 130, 246, 0.15); border: 1px solid rgba(59, 130, 246, 0.3); color: #60a5fa; border-radius: 8px; font-weight: 600; font-size: 0.875rem; text-decoration: none;">
            Edit Client Profile
        </a>
    </div>

    <div class="grid-stats">
        <div class="stat-card">
            <div class="stat-title">Account Status</div>
            <div class="stat-value" style="color: #34d399; text-transform: capitalize;">
                {{ $client->status->label() }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-title">Email Verification</div>
            <div class="stat-value" style="font-size: 1.125rem; color: {{ $client->hasVerifiedEmail() ? '#34d399' : '#f87171' }};">
                {{ $client->hasVerifiedEmail() ? 'Verified' : 'Pending Verification' }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-title">Last Login Activity</div>
            <div class="stat-value" style="font-size: 1rem; color: var(--text-main);">
                {{ $client->last_login_at ? $client->last_login_at->diffForHumans() : 'First session' }}
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Active Projects & Solutions</h3>
            <span style="font-size: 0.75rem; color: var(--text-muted);">Phase Foundation</span>
        </div>
        <div style="padding: 2rem 1rem; text-align: center; border: 2px dashed var(--border-color); border-radius: 8px; color: var(--text-muted);">
            <p style="font-size: 1rem; font-weight: 500; margin-bottom: 0.5rem; color: var(--text-main);">No active project modules deployed yet.</p>
            <p style="font-size: 0.875rem;">Your client account is active. Project requirement submissions and project tracking modules will appear here in upcoming releases.</p>
        </div>
    </div>
@endsection
