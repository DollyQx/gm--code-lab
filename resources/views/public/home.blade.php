@extends('layouts.public')

@section('title', 'GM Code Lab — Custom Software Development & Enterprise Digital Solutions')
@section('meta_description', 'GM Code Lab engineers custom web development, mobile apps, LMS platforms, healthcare software, and enterprise ERP systems for ambitious organizations.')

@section('content')
    <!-- 1. HERO SECTION -->
    <section class="relative bg-slate-900 text-white pt-16 pb-24 lg:pt-24 lg:pb-32 overflow-hidden border-b border-slate-800">
        <div class="absolute inset-0 bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:16px_16px] opacity-40 pointer-events-none"></div>
        <div class="container-custom relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <span class="badge-public mb-6 inline-block bg-blue-950 text-blue-400 border border-blue-800/60 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                    Custom Digital Solutions & Engineering
                </span>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-tight mb-8">
                    Engineering Custom Software & Digital Solutions for Ambitious Businesses
                </h1>
                
                <p class="text-lg sm:text-xl text-slate-300 max-w-2xl mx-auto mb-10 leading-relaxed">
                    We design, build, and scale web applications, mobile platforms, LMS systems, healthcare tools, and enterprise management software built specifically for your operations.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
                    <a href="{{ route('start-project') }}" class="btn-base btn-primary btn-lg w-full sm:w-auto">
                        Start a Project
                    </a>
                    <a href="{{ route('portfolio.index') }}" class="btn-base btn-outline btn-lg w-full sm:w-auto text-white border-slate-700 hover:bg-slate-800">
                        View Our Work
                    </a>
                </div>

                <!-- Solution Badges -->
                <div class="pt-8 border-t border-slate-800/80 grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Web & Mobile Apps
                    </div>
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        LMS & Test Engines
                    </div>
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        ERP & Business Software
                    </div>
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Cybersecurity Standards
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. SERVICES OVERVIEW SECTION -->
    <section class="py-20 md:py-28 bg-white">
        <div class="container-custom">
            <x-section-heading 
                badge="What We Build"
                title="End-to-End Digital Engineering Capabilities"
                subtitle="We deliver robust, custom digital products crafted with enterprise-grade architecture and clean code."
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                    <x-service-card 
                        :title="$service->name" 
                        :description="$service->short_description ?? 'Custom software tailored for business efficiency and scalability.'"
                        :slug="$service->slug"
                    />
                @empty
                    <x-service-card title="Web Application Development" description="Custom web platforms built with Laravel, Vue, React, and high-performance server architectures." slug="web-development" />
                    <x-service-card title="Mobile Application Development" description="Native and cross-platform mobile apps for iOS and Android built for seamless client engagement." slug="app-development" />
                    <x-service-card title="LMS & Online Testing Systems" description="Comprehensive learning management, automated online examination, and digital library platforms." slug="lms-education" />
                    <x-service-card title="Custom ERP & Business Software" description="Integrated hostel, mess, healthcare, shop retail, and administrative management software." slug="custom-erp" />
                    <x-service-card title="Cybersecurity & Audit Services" description="Vulnerability assessments, code audits, secure session architectures, and data isolation strategies." slug="cybersecurity" />
                    <x-service-card title="E-Commerce & Digital Commerce" description="Scalable online store systems with inventory management, cart systems, and payment integration." slug="e-commerce" />
                @endforelse
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('services.index') }}" class="btn-base btn-outline btn-lg">
                    Explore All Services &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- 3. INDUSTRIES OVERVIEW SECTION -->
    <section class="py-20 md:py-28 bg-slate-50 border-y border-slate-200">
        <div class="container-custom">
            <x-section-heading 
                badge="Domain Expertise"
                title="Specialized Software for Key Vertical Industries"
                subtitle="Deep domain understanding allows us to craft tailored operational tools designed for specific business models."
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($industries as $industry)
                    <x-industry-card 
                        :title="$industry->name"
                        :description="$industry->description ?? 'Tailored digital solutions engineered specifically for industry workflows.'"
                        :slug="$industry->slug"
                    />
                @empty
                    <x-industry-card title="Education & Academic Institutes" description="Student portals, examination engines, digital notes libraries, and institute management." slug="education" />
                    <x-industry-card title="Healthcare & Hospitals" description="Patient records, appointment scheduling, billing modules, and clinic management software." slug="healthcare" />
                    <x-industry-card title="Hostel, Mess & Canteen Operations" description="Automated room allocation, mess meal tracking, inventory control, and billing receipts." slug="hostel-mess" />
                    <x-industry-card title="Retail & Shop Management" description="Point of sale (POS), stock tracking, barcode management, and customer CRM tools." slug="retail" />
                    <x-industry-card title="Enterprise Business & Operations" description="Custom workflow automation, financial ledgers, document repositories, and staff access control." slug="enterprise" />
                    <x-industry-card title="Hospitality & Services" description="Booking engines, guest service tracking, and staff management systems." slug="hospitality" />
                @endforelse
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('industries.index') }}" class="btn-base btn-secondary btn-lg">
                    Explore All Industries &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- 4. FEATURED WORK SECTION -->
    <section class="py-20 md:py-28 bg-white">
        <div class="container-custom">
            <x-section-heading 
                badge="Proven Deliveries"
                title="Featured Software Case Studies"
                subtitle="Explore recent digital transformation projects engineered by GM Code Lab."
            />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
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
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('portfolio.index') }}" class="btn-base btn-outline btn-lg">
                    View Full Portfolio &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- 5. HOW IT WORKS SECTION -->
    <section class="py-20 md:py-28 bg-slate-900 text-white">
        <div class="container-custom">
            <x-section-heading 
                badge="Development Process"
                title="Our Structured Software Delivery Workflow"
                subtitle="From requirement gathering to production deployment, we maintain absolute transparency and engineering rigor."
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="p-6 rounded-xl bg-slate-800/60 border border-slate-700/60">
                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center mb-6 text-lg">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Discovery & Scope</h3>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        We analyze your operational requirements, user workflows, and technical parameters to draft a clear spec.
                    </p>
                </div>

                <div class="p-6 rounded-xl bg-slate-800/60 border border-slate-700/60">
                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center mb-6 text-lg">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Architecture & Quote</h3>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        We design modular database schemas, security rules, milestone schedules, and transparent financial quotes.
                    </p>
                </div>

                <div class="p-6 rounded-xl bg-slate-800/60 border border-slate-700/60">
                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center mb-6 text-lg">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Agile Engineering</h3>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        We write clean, well-tested code with incremental milestone reviews and dedicated client dashboard tracking.
                    </p>
                </div>

                <div class="p-6 rounded-xl bg-slate-800/60 border border-slate-700/60">
                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center mb-6 text-lg">
                        4
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Deploy & Support</h3>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        We execute production deployment, environment optimization, security hardening, and ongoing maintenance.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. WHY GM CODE LAB SECTION -->
    <section class="py-20 md:py-28 bg-white">
        <div class="container-custom">
            <x-section-heading 
                badge="Engineering Integrity"
                title="Why Leading Businesses Choose GM Code Lab"
                subtitle="We do not build generic templates. We engineer custom, scalable software assets tailored to your business."
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-8 rounded-xl bg-slate-50 border border-slate-200">
                    <div class="w-12 h-12 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mb-6 font-bold text-xl">
                        01
                    </div>
                    <h3 class="h3 mb-3">Custom Architecture</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Every system is engineered from the database schema up to match your operational logic precisely without bloat.
                    </p>
                </div>

                <div class="p-8 rounded-xl bg-slate-50 border border-slate-200">
                    <div class="w-12 h-12 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mb-6 font-bold text-xl">
                        02
                    </div>
                    <h3 class="h3 mb-3">Strict Security & RBAC</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Server-side role-based authorization, account status checks, rate limiting, and tenant data isolation.
                    </p>
                </div>

                <div class="p-8 rounded-xl bg-slate-50 border border-slate-200">
                    <div class="w-12 h-12 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mb-6 font-bold text-xl">
                        03
                    </div>
                    <h3 class="h3 mb-3">Milestone Transparency</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Clear quotation line items, milestone tracking, formal invoices, and automated payment receipts.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. PROMOTIONAL / OFFER AREA -->
    <section class="py-12 bg-slate-100 border-t border-slate-200">
        <div class="container-custom max-w-5xl">
            <x-promotional-banner :offer="$activeOffer" />
        </div>
    </section>

    <!-- 8. FINAL CTA SECTION -->
    <x-cta-section />
@endsection
