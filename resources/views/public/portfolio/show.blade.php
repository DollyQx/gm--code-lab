@extends('layouts.public')

@section('title', 'Case Study: ' . \Illuminate\Support\Str::headline($slug) . ' — GM Code Lab')
@section('meta_description', 'Detailed software development case study by GM Code Lab.')

@section('content')
    <section class="py-16 md:py-24 bg-slate-900 text-white">
        <div class="container-custom max-w-4xl">
            <a href="{{ route('portfolio.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-400 hover:text-blue-300 mb-6">
                &larr; Back to Portfolio
            </a>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-6">
                Case Study: {{ \Illuminate\Support\Str::headline($slug) }}
            </h1>
            <p class="text-xl text-slate-300 leading-relaxed">
                An end-to-end software delivery case study highlighting technical challenges, architectural solutions, and operational outcomes.
            </p>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container-custom max-w-4xl">
            <div class="prose prose-lg max-w-none text-slate-700 leading-relaxed space-y-6">
                <h2 class="text-2xl font-bold text-slate-900">Project Challenge & Context</h2>
                <p>
                    The client required a high-availability digital system capable of managing multi-role users, maintaining strict data isolation, and processing transactions with high accuracy.
                </p>

                <h2 class="text-2xl font-bold text-slate-900 mt-8">Engineering Solution</h2>
                <p>
                    GM Code Lab engineered a modular architecture featuring Eloquent domain models, automated reference number generation, server-side role validation, and structured audit logs.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-8">
                    <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl">
                        <div class="text-2xl font-black text-blue-600 mb-1">99.9%</div>
                        <div class="text-sm font-medium text-slate-600">System Uptime</div>
                    </div>
                    <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl">
                        <div class="text-2xl font-black text-blue-600 mb-1">&lt;100ms</div>
                        <div class="text-sm font-medium text-slate-600">Average API Latency</div>
                    </div>
                    <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl">
                        <div class="text-2xl font-black text-blue-600 mb-1">100%</div>
                        <div class="text-sm font-medium text-slate-600">Tenant Data Isolation</div>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-slate-200 flex items-center justify-between">
                <a href="{{ route('portfolio.index') }}" class="btn-base btn-outline">
                    &larr; View Other Projects
                </a>
                <a href="{{ route('start-project') }}" class="btn-base btn-primary">
                    Start a Similar Project
                </a>
            </div>
        </div>
    </section>

    <x-cta-section />
@endsection
