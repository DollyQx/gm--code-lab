@extends('layouts.public')

@section('title', 'About GM Code Lab — Digital Engineering & Custom Software')
@section('meta_description', 'Learn about GM Code Lab philosophy, software engineering methodology, and commitment to custom digital solutions.')

@section('content')
    <section class="py-16 md:py-24 bg-slate-900 text-white">
        <div class="container-custom text-center max-w-3xl">
            <span class="badge-public mb-4 bg-blue-950 text-blue-400 border border-blue-800 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                Engineering Integrity
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-6">
                About GM Code Lab
            </h1>
            <p class="text-lg text-slate-300 leading-relaxed">
                We are a custom software development company dedicated to building robust, secure, and scalable digital solutions for growing organizations.
            </p>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container-custom max-w-4xl">
            <div class="prose prose-lg max-w-none text-slate-700 leading-relaxed space-y-6">
                <h2 class="text-3xl font-bold text-slate-900">Our Mission</h2>
                <p>
                    GM Code Lab was founded to bridge the gap between complex business requirements and modern software architecture. We believe software should be custom-tailored to operational logic, ensuring speed, security, and long-term maintainability.
                </p>

                <h2 class="text-3xl font-bold text-slate-900 mt-12">Core Principles</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-8">
                    <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Clean Architecture</h3>
                        <p class="text-sm text-slate-600">
                            Strict separation of concerns into HTTP, Service, Repository, Policy, and Persistence layers.
                        </p>
                    </div>
                    <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Zero Floating-Point Error</h3>
                        <p class="text-sm text-slate-600">
                            Financial integrity through strict <code>decimal(12,2)</code> column standards and server-side calculations.
                        </p>
                    </div>
                    <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Strict Data Isolation</h3>
                        <p class="text-sm text-slate-600">
                            Client data isolation enforced at both model relationship and authorization policy levels.
                        </p>
                    </div>
                    <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Production Performance</h3>
                        <p class="text-sm text-slate-600">
                            Lightweight footprint designed to run blazingly fast on standard server environments.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-cta-section />
@endsection
