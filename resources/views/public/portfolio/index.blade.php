@extends('layouts.public')

@section('title', 'Portfolio & Delivered Software Projects — GM Code Lab')
@section('meta_description', 'Browse featured software case studies and digital transformation projects delivered by GM Code Lab.')

@section('content')
    <section class="py-16 md:py-24 bg-slate-900 text-white">
        <div class="container-custom text-center max-w-3xl">
            <span class="badge-public mb-4 bg-blue-950 text-blue-400 border border-blue-800 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                Proven Deliveries
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-6">
                Featured Software Case Studies
            </h1>
            <p class="text-lg text-slate-300 leading-relaxed">
                Explore how GM Code Lab helps organizations launch custom digital platforms, automate operations, and scale tech architecture.
            </p>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container-custom">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <x-portfolio-card 
                    category="EdTech Platform"
                    title="Enterprise LMS & Testing System"
                    description="A scalable online test engine handling thousands of concurrent exam sessions with real-time scoring and analytics."
                    :tags="['Laravel 12', 'Vue.js', 'PostgreSQL', 'Tailwind']"
                    slug="enterprise-lms"
                />
                <x-portfolio-card 
                    category="Healthcare Management"
                    title="Integrated Clinic & Pharmacy Solution"
                    description="Patient queue management, prescription tracking, and digital medical billing built for multi-location clinics."
                    :tags="['Custom PHP', 'MySQL', 'REST API', 'Docker']"
                    slug="healthcare-suite"
                />
                <x-portfolio-card 
                    category="Hostel & Mess Operations"
                    title="Automated Mess & Hostel Management"
                    description="Digital meal punch cards, fee receipt generation, room inventory, and student dispute resolution platform."
                    :tags="['Laravel', 'Blade', 'Redis', 'PDF Engine']"
                    slug="hostel-mess-system"
                />
                <x-portfolio-card 
                    category="E-Commerce & Retail"
                    title="Multi-Store Inventory & POS Platform"
                    description="Barcoded inventory management, multi-branch stock transfers, and automated cashier settlement."
                    :tags="['Laravel', 'Livewire', 'MySQL', 'Tailwind']"
                    slug="retail-pos-system"
                />
                <x-portfolio-card 
                    category="Digital Library"
                    title="Notes & Study Material Library"
                    description="Secure PDF document streaming platform with DRM prevention and tiered subscription access."
                    :tags="['Next.js', 'Prisma', 'Supabase', 'TypeScript']"
                    slug="digital-notes-library"
                />
                <x-portfolio-card 
                    category="Cybersecurity"
                    title="Role-Based Security & Audit Gateway"
                    description="Enterprise API proxy gateway enforcing strict tenant data isolation, session invalidation, and threat detection."
                    :tags="['PHP 8.3', 'Redis', 'OAuth2', 'Security Audit']"
                    slug="security-audit-gateway"
                />
            </div>
        </div>
    </section>

    <x-cta-section />
@endsection
