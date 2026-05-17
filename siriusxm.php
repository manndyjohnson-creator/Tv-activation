<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiriusXM Setup | Stream Activate Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sirius: {
                            blue: '#0000EB', // Bright SiriusXM blue
                            dark: '#000000', // Deep black
                            gray: '#1a1a1a', // Section backgrounds
                            light: '#ffffff'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    keyframes: {
                        vibrate: {
                            '0%, 15%, 100%': { transform: 'translateX(0)' },
                            '3%': { transform: 'translateX(-5px)' },
                            '6%': { transform: 'translateX(5px)' },
                            '9%': { transform: 'translateX(-5px)' },
                            '12%': { transform: 'translateX(5px)' }
                        }
                    },
                    animation: {
                        'vibrate': 'vibrate 3s ease-in-out infinite'
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-black text-white antialiased selection:bg-sirius-blue selection:text-white">


<!-- Custom Navbar (Mimicking SiriusXM clean header) -->
<nav class="sticky top-0 z-50 bg-black/90 backdrop-blur-md border-b border-white/10">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <a href="index" class="flex items-center gap-2 group">
            <h1 class="text-3xl font-extrabold tracking-tighter">Sirius<span class="text-sirius-blue">XM</span></h1>
        </a>
        <div class="hidden md:flex items-center gap-8 text-sm font-semibold tracking-wide">
            <a href="#subscribe" class="hover:text-sirius-blue transition-colors">SUBSCRIBE</a>
            <a href="#find-id" class="hover:text-sirius-blue transition-colors">FIND RADIO ID</a>
            <a href="#refresh" class="hover:text-sirius-blue transition-colors">REFRESH SIGNAL</a>
        </div>
        <a href="activation" class="bg-white text-black hover:bg-gray-200 px-6 py-2.5 rounded-full font-bold text-sm transition-colors">
            Activate Now
        </a>
    </div>
</nav>

<!-- Hero Section -->
<header class="relative pt-24 pb-32 overflow-hidden border-b border-white/10">
    <!-- Abstract background shape mimicking soundwaves/satellite -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-sirius-blue rounded-full opacity-20 blur-[120px] pointer-events-none"></div>
    
    <div class="container mx-auto px-6 relative z-10 text-center max-w-5xl">
        <h2 class="text-5xl md:text-8xl font-black tracking-tight mb-6 leading-none">
            Everything you <br class="hidden md:block"/>want to hear <br class="hidden md:block"/>lives here.
        </h2>
        <p class="text-xl md:text-2xl text-gray-300 mb-10 font-light max-w-3xl mx-auto">
            Music, Sports, Talk & Podcasts, Live & On Demand. Follow our setup guide to activate your satellite or digital radio instantly.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="https://www.siriusxm.com" target="_blank" class="w-full sm:w-auto bg-sirius-blue hover:bg-blue-700 text-white px-10 py-5 rounded-full font-bold text-lg transition-all shadow-[0_0_20px_rgba(0,0,235,0.4)]">
                Best Offers
            </a>
            <a href="#setup" class="w-full sm:w-auto bg-transparent border border-white hover:bg-white hover:text-black text-white px-10 py-5 rounded-full font-bold text-lg transition-colors">
                View Setup Guide
            </a>
        </div>
    </div>
</header>

<!-- Main Guide Content -->
<main id="setup" class="py-24">
    <div class="container mx-auto px-6 max-w-6xl space-y-32">
        
        <!-- Subscribe Section -->
        <div id="subscribe" class="grid md:grid-cols-2 gap-16 items-center">
            <div class="order-2 md:order-1">
                <div class="aspect-square bg-[#0f0f0f] rounded-[2rem] border border-[#222] flex flex-col items-center justify-center p-8 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-tr from-sirius-blue/10 to-transparent"></div>
                    <i data-lucide="mic-2" class="w-32 h-32 text-sirius-blue group-hover:scale-110 transition-transform duration-500 mb-6"></i>
                    <h3 class="text-2xl font-bold text-center">Exclusive Content</h3>
                </div>
            </div>
            <div class="order-1 md:order-2">
                <h3 class="text-sm font-bold text-sirius-blue uppercase tracking-widest mb-3">Step 1</h3>
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Choose Your Plan</h2>
                <p class="text-gray-400 text-xl mb-8 leading-relaxed">SiriusXM offers flexible plans, whether you're listening in your car, on the app, or both. Enjoy ad-free music, live sports, original talk shows, and exclusive comedy.</p>
                <ul class="space-y-6">
                    <li class="flex items-start gap-4">
                        <i data-lucide="check" class="w-7 h-7 text-sirius-blue shrink-0"></i>
                        <span class="text-gray-300 text-lg">Visit <a href="https://www.siriusxm.com" class="text-white underline font-medium">siriusxm.com</a> to view current promotions.</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <i data-lucide="check" class="w-7 h-7 text-sirius-blue shrink-0"></i>
                        <span class="text-gray-300 text-lg">Select between "Car + App" or "Streaming Only" packages.</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <i data-lucide="check" class="w-7 h-7 text-sirius-blue shrink-0"></i>
                        <span class="text-gray-300 text-lg">Create your account and complete the checkout process.</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Find Radio ID Section -->
        <div id="find-id" class="grid md:grid-cols-2 gap-16 items-center">
            <div>
                <h3 class="text-sm font-bold text-sirius-blue uppercase tracking-widest mb-3">Step 2</h3>
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Find Your Radio ID</h2>
                <p class="text-gray-400 text-xl mb-8 leading-relaxed">To activate a vehicle receiver, you need your 8-character Radio ID (also known as an ESN or SID). It does not contain the letters I, O, S, or F.</p>
                
                <div class="bg-[#0f0f0f] border border-[#222] p-8 rounded-3xl mb-6">
                    <div class="flex items-center gap-4 mb-3">
                        <i data-lucide="radio" class="w-8 h-8 text-sirius-blue"></i>
                        <h4 class="font-bold text-2xl">Tune to Channel 0</h4>
                    </div>
                    <p class="text-gray-400 text-lg">Turn on your radio and tune it to Channel 0. The Radio ID will instantly display on your screen.</p>
                </div>
                
                <div class="bg-[#0f0f0f] border border-[#222] p-8 rounded-3xl">
                    <div class="flex items-center gap-4 mb-3">
                        <i data-lucide="settings" class="w-8 h-8 text-sirius-blue"></i>
                        <h4 class="font-bold text-2xl">Check System Settings</h4>
                    </div>
                    <p class="text-gray-400 text-lg">On newer infotainment systems, navigate to Settings > Satellite (or Audio) > System Information.</p>
                </div>
            </div>
            <div>
                <div class="aspect-square bg-[#0f0f0f] rounded-[2rem] border border-[#222] flex flex-col items-center justify-center p-8 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-bl from-sirius-blue/10 to-transparent"></div>
                    <div class="bg-black border border-[#333] px-10 py-6 rounded-2xl text-5xl font-mono tracking-widest mb-6 group-hover:border-sirius-blue transition-colors">
                        X7K9P2M4
                    </div>
                    <p class="text-gray-500 font-mono tracking-widest">EXAMPLE RADIO ID</p>
                </div>
            </div>
        </div>

        <!-- Refresh Signal Section -->
        <div id="refresh" class="bg-sirius-gray p-10 md:p-16 rounded-[3rem] border border-[#222]">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <i data-lucide="satellite" class="w-20 h-20 text-sirius-blue mx-auto mb-8"></i>
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Send a Refresh Signal</h2>
                <p class="text-gray-400 text-xl leading-relaxed">If your radio displays "Channel Unauthorized" or you are missing channels after subscribing, send a refresh signal to reactivate your device.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-black p-8 rounded-3xl border border-[#222]">
                    <div class="w-12 h-12 bg-[#1a1a1a] rounded-full flex items-center justify-center font-bold text-xl mb-6 text-sirius-blue">1</div>
                    <h4 class="font-bold text-2xl mb-4">Park Outside</h4>
                    <p class="text-gray-400">Ensure your vehicle has a clear, unobstructed view of the sky (avoid garages).</p>
                </div>
                <div class="bg-black p-8 rounded-3xl border border-[#222]">
                    <div class="w-12 h-12 bg-[#1a1a1a] rounded-full flex items-center justify-center font-bold text-xl mb-6 text-sirius-blue">2</div>
                    <h4 class="font-bold text-2xl mb-4">Turn on Radio</h4>
                    <p class="text-gray-400">Turn your vehicle's ignition and radio ON, and tune to Channel 1.</p>
                </div>
                <div class="bg-black p-8 rounded-3xl border border-[#222]">
                    <div class="w-12 h-12 bg-[#1a1a1a] rounded-full flex items-center justify-center font-bold text-xl mb-6 text-sirius-blue">3</div>
                    <h4 class="font-bold text-2xl mb-4">Send Signal</h4>
                    <p class="text-gray-400">Visit the official SiriusXM Refresh page online, enter your Radio ID, and submit.</p>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- Footer -->
<footer class="border-t border-[#222] py-16 bg-black text-center text-gray-500">
    <div class="container mx-auto px-6">
        <h2 class="text-2xl font-bold text-white mb-6">Need Setup Assistance?</h2>
        <p class="mb-8 max-w-lg mx-auto">If you are experiencing difficulties finding your Radio ID or receiving the signal, our independent support team is available.</p>
        <a href="tel:+12053729931" class="inline-flex items-center gap-3 bg-[#111] hover:bg-[#222] border border-[#333] text-white px-8 py-4 rounded-full font-bold text-lg transition-colors">
            <i data-lucide="phone" class="w-5 h-5"></i>
            +1 205 372 9931
        </a>
        <p class="mt-12 text-sm">&copy; <?php echo date('Y'); ?> Stream Activate Hub. Not affiliated with SiriusXM.</p>
    </div>
</footer>

<!-- Official Support Popup -->
<div id="sirius-popup" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/80 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-500">
    <div class="bg-[#111] border border-[#333] rounded-3xl p-8 max-w-md w-full mx-4 shadow-[0_0_50px_rgba(0,0,235,0.2)] transform scale-95 transition-transform duration-500 relative text-center">
        
        <div class="w-24 h-24 mx-auto mb-6">
            <img src="assets/images/support_phone_icon.png" alt="Phone Icon" class="w-full h-full object-contain drop-shadow-[0_0_15px_rgba(0,0,235,0.4)]">
        </div>
        
        <h3 class="text-3xl font-extrabold text-white mb-2">Need Help?</h3>
        <p class="text-gray-400 mb-8 text-lg">Please call official SiriusXM Support for subscription or activation assistance.</p>
        
        <a href="tel:1-866-635-2349" class="block w-full bg-white hover:bg-gray-200 text-black py-4 rounded-full font-black text-2xl transition-colors mb-4 animate-vibrate">
            1-866-635-2349
        </a>
        <p class="text-sm text-gray-500">Official SiriusXM Listener Care</p>
    </div>
</div>

<script>
    lucide.createIcons();
    
    // Popup Logic
    document.addEventListener('DOMContentLoaded', () => {
        const popup = document.getElementById('sirius-popup');
        const popupContent = popup.querySelector('div');
        
        // Show popup after 3 seconds
        setTimeout(() => {
            popup.classList.remove('opacity-0', 'pointer-events-none');
            popupContent.classList.remove('scale-95');
            popupContent.classList.add('scale-100');
        }, 3000);
    });
</script>
</body>
</html>
