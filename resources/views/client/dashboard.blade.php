@extends('layouts.client')

@section('title', 'Client Dashboard')

@section('content')
<div class="space-y-8">

    <!-- Welcome Header Banner -->
    <div class="bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-900 text-white p-6 sm:p-8 rounded-2xl shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
        <div class="space-y-2 relative z-10">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-500/20 text-blue-300 text-xs font-bold rounded-full border border-blue-400/30">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Client Workspace Portal
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                Welcome back, {{ auth()->user()->name }}
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-2xl">
                Overview of your software development projects, milestone roadmaps, and account billing summary.
            </p>
        </div>

        <div class="flex items-center gap-3 relative z-10">
            <a href="{{ route('client.projects.index') }}" class="bg-white hover:bg-slate-100 text-slate-900 font-bold text-xs px-4 py-2.5 rounded-xl transition-all shadow-md">
                View All Projects &rarr;
            </a>
        </div>

        <!-- Decorative background glow -->
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <!-- Quick Action Banners for Pending Commercial Items -->
    @if($pendingQuotationsCount > 0 || $unpaidInvoicesCount > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @if($pendingQuotationsCount > 0)
                <div class="bg-blue-50/80 border border-blue-200 p-4 rounded-2xl flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-slate-900">{{ $pendingQuotationsCount }} Pending Quotation Proposal{{ $pendingQuotationsCount > 1 ? 's' : '' }}</span>
                            <span class="block text-xs text-slate-500">Review and approve project estimates</span>
                        </div>
                    </div>
                    <a href="{{ route('client.quotations.index', ['status' => 'sent']) }}" class="px-3.5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-all shadow-sm">
                        Review Proposals &rarr;
                    </a>
                </div>
            @endif

            @if($unpaidInvoicesCount > 0)
                <div class="bg-amber-50/80 border border-amber-200 p-4 rounded-2xl flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-600 text-white flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-slate-900">{{ $unpaidInvoicesCount }} Invoice{{ $unpaidInvoicesCount > 1 ? 's' : '' }} Awaiting Settlement</span>
                            <span class="block text-xs text-slate-500">View statement and pay online</span>
                        </div>
                    </div>
                    <a href="{{ route('client.invoices.index') }}" class="px-3.5 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold transition-all shadow-sm">
                        View Invoices &rarr;
                    </a>
                </div>
            @endif
        </div>
    @endif

    <!-- Project Summary Cards Grid -->
    <div class="space-y-3">
        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400">Project Overview</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            
            <!-- Total Projects -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Total Projects</span>
                    <div class="text-3xl font-extrabold text-slate-900">{{ number_format($totalProjects) }}</div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>

            <!-- Active Projects -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Active Projects</span>
                    <div class="text-3xl font-extrabold text-blue-600">{{ number_format($activeProjects) }}</div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>

            <!-- Completed Projects -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Completed Projects</span>
                    <div class="text-3xl font-extrabold text-slate-900">{{ number_format($completedProjects) }}</div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>

        </div>
    </div>

    <!-- Financial Summary Cards Grid -->
    <div class="space-y-3">
        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400">Financial Position Summary</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

            <!-- Total Invoiced -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500 block">Total Invoiced</span>
                <div class="text-2xl font-extrabold text-slate-900 font-mono">
                    ₹{{ number_format($totalInvoiced, 2) }}
                </div>
                <p class="text-[11px] text-slate-500">Total commercial invoices issued</p>
            </div>

            <!-- Total Paid -->
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50/50 p-5 rounded-2xl border border-emerald-200/70 shadow-sm space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-800 block">Total Paid</span>
                <div class="text-2xl font-extrabold text-emerald-900 font-mono">
                    ₹{{ number_format($totalPaid, 2) }}
                </div>
                <p class="text-[11px] text-emerald-700">Verified payment receipts</p>
            </div>

            <!-- Outstanding Balance -->
            <div class="bg-gradient-to-br from-amber-50 to-orange-50/50 p-5 rounded-2xl border border-amber-200/70 shadow-sm space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-800 block">Outstanding Amount</span>
                <div class="text-2xl font-extrabold text-amber-900 font-mono">
                    ₹{{ number_format($outstandingAmount, 2) }}
                </div>
                <p class="text-[11px] text-amber-700">Remaining amount due across active invoices</p>
            </div>

        </div>
    </div>

    <!-- Recent Projects List -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="font-bold text-slate-900 text-lg tracking-tight">Recent Projects</h3>
                <p class="text-xs text-slate-500 mt-0.5">Active software development initiatives</p>
            </div>
            <a href="{{ route('client.projects.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors">
                View All Directory &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200/70">
                    <tr>
                        <th class="px-6 py-3.5">Reference</th>
                        <th class="px-6 py-3.5">Project Title</th>
                        <th class="px-6 py-3.5">Service</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5">Progress</th>
                        <th class="px-6 py-3.5 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($recentProjects as $proj)
                        @php
                            $totalM = $proj->milestones->count();
                            $compM = $proj->milestones->filter(fn($m) => $m->status === \App\Enums\MilestoneStatus::COMPLETED || (is_string($m->status) && $m->status === 'completed'))->count();
                            $pPercent = $totalM > 0 ? (int)round(($compM / $totalM) * 100) : ($proj->status === \App\Enums\ProjectStatus::COMPLETED ? 100 : 0);
                        @endphp
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4 font-mono font-bold text-blue-600">
                                {{ $proj->reference_number }}
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900">
                                {{ $proj->title }}
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ $proj->service->name ?? 'Software' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2.5 py-0.5 text-[11px] font-bold rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                    {{ is_object($proj->status) && method_exists($proj->status, 'label') ? $proj->status->label() : Str::headline($proj->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-24 h-2 bg-slate-100 rounded-full overflow-hidden border border-slate-200/60">
                                        <div class="h-full bg-blue-600 rounded-full" style="width: {{ $pPercent }}%"></div>
                                    </div>
                                    <span class="font-mono text-[11px] font-bold text-slate-700">{{ $pPercent }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('client.projects.show', $proj->id) }}" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-700 hover:underline">
                                    <span>Workspace</span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-xs text-slate-500">
                                No active projects yet. Your assigned software development projects will appear here.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
