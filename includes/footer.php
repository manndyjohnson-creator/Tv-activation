    </main>
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-8">
        <div class="container mx-auto px-6">
            <?php if ($currentPage != 'activation.php'): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                
                <!-- Brand -->
                <div class="space-y-6">
                    <a href="index" class="flex items-center gap-2 group">
                        <div class="bg-primary p-2 rounded-lg text-white">
                            <i data-lucide="tv" class="w-6 h-6"></i>
                        </div>
                        <span class="text-xl font-bold text-white">
                            Stream Activate <span class="text-primary">Hub</span>
                        </span>
                    </a>
                    <p class="text-sm leading-relaxed">
                        Providing premium local TV wall mounting, secure bracket installation, and home theater placement services.
                    </p>

                </div>

                <!-- Services -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-lg">Our Services</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="services" class="hover:text-primary transition-colors">TV Wall Mounting</a></li>
                        <li><a href="services" class="hover:text-primary transition-colors">In-Wall Wire Concealment</a></li>
                        <li><a href="services" class="hover:text-primary transition-colors">Soundbar Mounting</a></li>
                        <li><a href="services" class="hover:text-primary transition-colors">Home Theater Setup</a></li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-lg">Quick Links</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="index" class="hover:text-primary transition-colors">Home</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">About Us</a></li>
                        <li><a href="blog" class="hover:text-primary transition-colors">Blog & Guides</a></li>
                        <li><a href="contact" class="hover:text-primary transition-colors">Contact Support</a></li>
                        <li><a href="index.php#faq" class="hover:text-primary transition-colors">FAQ</a></li>
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
            <?php endif; ?>

            <div class="border-t border-slate-800 pt-8 pb-8 text-sm text-slate-400 text-center">
                <strong>Disclaimer:</strong> Stream Activate Hub is a professional marketing and lead-referral platform. We connect homeowners with local, independent, and licensed TV mounting and audiovisual installation professionals. We do not directly provide contracting or physical installation services ourselves.
            </div>

            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                <p>&copy; 2026 Stream Activate Hub. All Rights Reserved.</p>
                <div class="flex gap-6">
                    <a href="privacy" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="terms" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="disclaimer" class="hover:text-white transition-colors">Disclaimer</a>
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
