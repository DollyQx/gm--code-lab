<footer class="bg-slate-950 text-slate-400 border-t border-slate-900 pt-16 pb-12">
    <div class="container-custom">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-900">
            <!-- Brand Column -->
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center gap-3 text-white font-extrabold text-xl tracking-wider">
                    <div class="w-8 h-8 rounded bg-blue-600 flex items-center justify-center text-white font-black text-base shadow-sm">
                        GM
                    </div>
                    <span>GM CODE LAB</span>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed max-w-sm">
                    Engineering custom software, high-performance web applications, mobile platforms, and enterprise digital solutions tailored for growing businesses.
                </p>
                <div class="pt-2 flex items-center gap-4 text-xs font-semibold text-slate-400">
                    <!-- Social Link Placeholders -->
                    <span class="hover:text-blue-400 cursor-pointer">LinkedIn</span>
                    <span>&bull;</span>
                    <span class="hover:text-blue-400 cursor-pointer">GitHub</span>
                    <span>&bull;</span>
                    <span class="hover:text-blue-400 cursor-pointer">Twitter / X</span>
                </div>
            </div>

            <!-- Services Links Column -->
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-4">Core Solutions</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('services.index') }}" class="hover:text-white transition-colors">Web Development</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-white transition-colors">App Development</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-white transition-colors">Custom ERP & CRM</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-white transition-colors">LMS & Education</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-white transition-colors">Cybersecurity</a></li>
                </ul>
            </div>

            <!-- Industries Column -->
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-4">Industries Served</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('industries.index') }}" class="hover:text-white transition-colors">Education & Academics</a></li>
                    <li><a href="{{ route('industries.index') }}" class="hover:text-white transition-colors">Healthcare Systems</a></li>
                    <li><a href="{{ route('industries.index') }}" class="hover:text-white transition-colors">Hostel & Mess</a></li>
                    <li><a href="{{ route('industries.index') }}" class="hover:text-white transition-colors">Retail & E-commerce</a></li>
                    <li><a href="{{ route('industries.index') }}" class="hover:text-white transition-colors">Enterprise Business</a></li>
                </ul>
            </div>

            <!-- Company & Portals Column -->
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-4">Quick Portals</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About GM Code Lab</a></li>
                    <li><a href="{{ route('portfolio.index') }}" class="hover:text-white transition-colors">Portfolio & Work</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact Us</a></li>
                    <li><a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium">Client Login Portal</a></li>
                    <li><a href="{{ route('start-project') }}" class="text-blue-400 hover:text-blue-300 font-medium">Start a Project</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Copyright Row -->
        <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-slate-400">
            <p>&copy; {{ date('Y') }} GM Code Lab. All rights reserved. Custom Software Solutions.</p>
            <div class="flex items-center gap-6">
                <span class="hover:text-slate-300 cursor-pointer">Privacy Policy</span>
                <span class="hover:text-slate-300 cursor-pointer">Terms of Service</span>
                <span class="hover:text-slate-300 cursor-pointer">Security</span>
            </div>
        </div>
    </div>
</footer>
