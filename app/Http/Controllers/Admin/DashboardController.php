<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LeadStatus;
use App\Enums\ProjectStatus;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the comprehensive admin CRM dashboard.
     */
    public function index(Request $request): View
    {
        $adminUser = $request->user();

        $stats = [
            'total_clients' => User::where('role', UserRole::CLIENT->value)->count(),
            'active_clients' => User::where('role', UserRole::CLIENT->value)
                ->where('status', UserStatus::ACTIVE->value)
                ->count(),
            'total_leads' => Lead::count(),
            'new_leads' => Lead::where('status', LeadStatus::NEW->value)->count(),
            'contacted_leads' => Lead::where('status', LeadStatus::CONTACTED->value)->count(),
            'qualified_leads' => Lead::where('status', LeadStatus::QUALIFIED->value)->count(),
            'quotation_sent_leads' => Lead::where('status', LeadStatus::QUOTATION_SENT->value)->count(),
            'negotiation_leads' => Lead::where('status', LeadStatus::NEGOTIATION->value)->count(),
            'won_leads' => Lead::where('status', LeadStatus::WON->value)->count(),
            'lost_leads' => Lead::where('status', LeadStatus::LOST->value)->count(),
            
            // Project Metrics (Phase 5B)
            'total_projects' => Project::count(),
            'active_projects' => Project::whereIn('status', [
                ProjectStatus::PLANNING->value,
                ProjectStatus::APPROVED->value,
                ProjectStatus::IN_PROGRESS->value,
                ProjectStatus::TESTING->value,
                ProjectStatus::CLIENT_REVIEW->value,
                ProjectStatus::DEPLOYMENT->value,
            ])->count(),
            'completed_projects' => Project::where('status', ProjectStatus::COMPLETED->value)->count(),
            'overdue_projects' => Project::whereNotIn('status', [
                ProjectStatus::COMPLETED->value,
                ProjectStatus::CANCELLED->value,
            ])
            ->whereNotNull('expected_completion_date')
            ->where('expected_completion_date', '<', now()->toDateString())
            ->count(),
        ];

        $recentLeads = Lead::with('assignedUser')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $recentClients = User::where('role', UserRole::CLIENT->value)
            ->with('clientProfile')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $recentProjects = Project::with('client')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('adminUser', 'stats', 'recentLeads', 'recentClients', 'recentProjects'));
    }
}
