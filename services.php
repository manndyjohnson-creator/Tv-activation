<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-18168224492"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'AW-18168224492');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream Activate Hub | Professional TV Mounting & Home Theater Installation</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (CDN for simple PHP setup) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#2563eb', light: '#3b82f6', dark: '#1d4ed8' },
                        dark: '#0f172a', light: '#f8fafc',
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-light text-slate-800 antialiased flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 py-5 bg-slate-900 shadow-xl">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <a href="index.php" class="flex items-center gap-2 group">
                    <div class="bg-primary p-2 rounded-lg text-white group-hover:bg-primary-dark transition-colors">
                        <i data-lucide="tv" class="w-6 h-6"></i>
                    </div>
                    <span id="nav-logo-text" class="text-xl font-bold text-white transition-colors duration-300">
                        Stream Activate <span class="text-primary">Hub</span>
                    </span>
                </a>
                <div class="hidden lg:flex items-center gap-8">
                    <a href="index.php" class="nav-link font-medium text-white/90 hover:text-primary transition-colors">Home</a>
                    <a href="services.php" class="nav-link font-medium text-primary transition-colors">Services</a>
                    <a href="blog.php" class="nav-link font-medium text-white/90 hover:text-primary transition-colors">Blog</a>
                    <a href="contact.php" class="nav-link font-medium text-white/90 hover:text-primary transition-colors">Contact</a>
                    <a href="contact.php" class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-full font-semibold transition-all shadow-lg shadow-primary/30">Get Started</a>
                </div>
            </div>
        </div>
    </nav>
    <main class="flex-grow">
        <div class="pt-32 pb-0 bg-white">
            <!-- Hero Section -->
            <div class="container mx-auto px-6 max-w-6xl mb-20 fade-in-up">
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <div class="w-full lg:w-1/2 text-left">
                        <h1 class="text-5xl font-extrabold text-slate-900 mb-6 leading-tight">Professional TV Mounting & Home Theater Installation</h1>
                        <p class="text-xl text-slate-600 mb-8">Secure, level, and clean. Expert wall mounting, wire concealment, and complete audio setup for your ultimate home entertainment experience.</p>
                        <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-full font-bold text-lg shadow-xl transition-all">Get a Free Estimate</a>
                    </div>
                    <div class="w-full lg:w-1/2">
                        <div class="rounded-3xl overflow-hidden shadow-2xl relative">
                            <img src="assets/images/tv_mounting_hero.png" alt="Professional TV Mounting in Modern Living Room" class="w-full h-auto object-cover" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- SERVICES SECTION -->
            <div class="container mx-auto px-6 mb-24 space-y-24">
                
                <!-- Service 1: TV Wall Mounting -->
                <div class="flex flex-col lg:flex-row gap-12 items-center fade-in-up">
                    <div class="w-full lg:w-1/2">
                        <div class="rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]">
                            <img src="assets/images/tv_installation.png" alt="TV Wall Mounting" class="object-cover w-full h-full" />
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                                <i data-lucide="tv" class="w-6 h-6"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-slate-900">TV Wall Mounting</h2>
                        </div>
                        <p class="text-lg text-slate-600 mb-6 leading-relaxed">Secure attachment of displays to drywall, brick, stone, or wood studs (Fixed, Tilt, Full-Motion).</p>
                        <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
                    </div>
                </div>

                <!-- Service 2: In-Wall Wire Concealment -->
                <div class="flex flex-col lg:flex-row-reverse gap-12 items-center fade-in-up">
                    <div class="w-full lg:w-1/2">
                        <div class="rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]">
                            <img src="assets/images/cable_management.png" alt="In-Wall Wire Concealment" class="object-cover w-full h-full" />
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                                <i data-lucide="zap" class="w-6 h-6"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-slate-900">In-Wall Wire Concealment</h2>
                        </div>
                        <p class="text-lg text-slate-600 mb-6 leading-relaxed">Hiding power cords and HDMI cables safely behind walls or inside premium track conduit covers.</p>
                        <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
                    </div>
                </div>

                <!-- Service 3: Soundbar & Audio Placement -->
                <div class="flex flex-col lg:flex-row gap-12 items-center fade-in-up">
                    <div class="w-full lg:w-1/2">
                        <div class="rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]">
                            <img src="assets/images/device_installation.png" alt="Soundbar & Audio Placement" class="object-cover w-full h-full" />
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                                <i data-lucide="volume-2" class="w-6 h-6"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-slate-900">Soundbar & Audio Placement</h2>
                        </div>
                        <p class="text-lg text-slate-600 mb-6 leading-relaxed">Structural mounting of surround-sound speakers and soundbars relative to the TV layout.</p>
                        <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
                    </div>
                </div>

                <!-- Service 4: Home Theater Configuration -->
                <div class="flex flex-col lg:flex-row-reverse gap-12 items-center fade-in-up">
                    <div class="w-full lg:w-1/2">
                        <div class="rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]">
                            <img src="assets/images/home_theater.png" alt="Home Theater Configuration" class="object-cover w-full h-full" />
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                                <i data-lucide="layout-dashboard" class="w-6 h-6"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-slate-900">Home Theater Configuration</h2>
                        </div>
                        <p class="text-lg text-slate-600 mb-6 leading-relaxed">Physical hardware placement and wire-routing of gaming consoles, cable boxes, and media devices.</p>
                        <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
                    </div>
                </div>

            </div>

            <!-- CTA -->
            <section class="py-20 relative overflow-hidden fade-in-up">
                <div class="absolute inset-0 bg-primary"></div>
                <div class="container mx-auto px-6 relative z-10 text-center">
                    <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6">Ready for a Professional Installation?</h2>
                    <p class="text-xl text-primary-100 mb-10 text-white/90">Reach out to our local AV installation team to schedule your on-site service today.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="contact.php" class="bg-white text-primary hover:bg-slate-50 px-8 py-4 rounded-full font-bold text-lg shadow-xl">Contact Us Online</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="bg-slate-900 text-slate-300 pt-16 pb-8">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="space-y-6">
                    <a href="index.php" class="flex items-center gap-2 group">
                        <div class="bg-primary p-2 rounded-lg text-white">
                            <i data-lucide="tv" class="w-6 h-6"></i>
                        </div>
                        <span class="text-xl font-bold text-white">
                            Stream Activate <span class="text-primary">Hub</span>
                        </span>
                    </a>
                    <p>Providing premium local TV wall mounting, secure bracket installation, and home theater placement services.</p>
                </div>

                <!-- Services -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-lg">Our Services</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="services.php" class="hover:text-primary transition-colors">TV Wall Mounting</a></li>
                        <li><a href="services.php" class="hover:text-primary transition-colors">In-Wall Wire Concealment</a></li>
                        <li><a href="services.php" class="hover:text-primary transition-colors">Soundbar Mounting</a></li>
                        <li><a href="services.php" class="hover:text-primary transition-colors">Home Theater Setup</a></li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-lg">Quick Links</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="index.php" class="hover:text-primary transition-colors">Home</a></li>
                        <li><a href="blog.php" class="hover:text-primary transition-colors">Blog & Guides</a></li>
                        <li><a href="contact.php" class="hover:text-primary transition-colors">Contact Support</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-lg">Contact Us</h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="text-primary shrink-0 mt-0.5 w-4 h-4"></i>
                            <span>901 N Smith Rd<br/>Bloomington, IN 47408</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" class="text-primary shrink-0 w-4 h-4"></i>
                            <span>+1 8775130191</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="mail" class="text-primary shrink-0 w-4 h-4"></i>
                            <span>support@streamactivatehub.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-800 pt-8 pb-8 text-sm text-slate-400 text-center">
                <strong>Disclaimer:</strong> Stream Activate Hub is a professional marketing and lead-referral platform. We connect consumers with local, independent, and licensed TV mounting and audiovisual installation professionals. We do not directly provide contracting, physical labor, or manual installation services ourselves.
            </div>

            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                <p>&copy; <?php echo date("Y"); ?> Stream Activate Hub. All Rights Reserved.</p>
                <div class="flex gap-6">
                    <a href="privacy.php" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="terms.php" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="disclaimer.php" class="hover:text-white transition-colors">Disclaimer</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Initialize Scripts -->
    <script src="assets/script.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
