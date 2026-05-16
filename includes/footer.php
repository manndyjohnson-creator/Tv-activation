    </main>
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-8">
        <div class="container mx-auto px-6">
            <?php if ($currentPage != 'activation.php'): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                
                <!-- Brand -->
                <div class="space-y-6">
                    <a href="index.php" class="flex items-center gap-2 group">
                        <div class="bg-primary p-2 rounded-lg text-white">
                            <i data-lucide="tv" class="w-6 h-6"></i>
                        </div>
                        <span class="text-xl font-bold text-white">
                            Prime<span class="text-primary">Setups</span>
                        </span>
                    </a>
                    <p class="text-sm leading-relaxed">
                        Premium home entertainment installation, smart TV setup, and network configuration services. Fast, professional, and reliable.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Services -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-lg">Our Services</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="services.php" class="hover:text-primary transition-colors">Smart TV Setup</a></li>
                        <li><a href="services.php" class="hover:text-primary transition-colors">Home Theater Installation</a></li>
                        <li><a href="services.php" class="hover:text-primary transition-colors">Streaming Device Activation</a></li>
                        <li><a href="services.php" class="hover:text-primary transition-colors">Wi-Fi & Network Setup</a></li>
                        <li><a href="services.php" class="hover:text-primary transition-colors">Audio Calibration</a></li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-lg">Quick Links</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="index.php" class="hover:text-primary transition-colors">Home</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">About Us</a></li>
                        <li><a href="blog.php" class="hover:text-primary transition-colors">Blog & Guides</a></li>
                        <li><a href="contact.php" class="hover:text-primary transition-colors">Contact Support</a></li>
                        <li><a href="index.php#faq" class="hover:text-primary transition-colors">FAQ</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-lg">Contact Us</h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="text-primary shrink-0 mt-0.5 w-4 h-4"></i>
                            <span>123 Tech Avenue, Suite 400<br/>San Francisco, CA 94105</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" class="text-primary shrink-0 w-4 h-4"></i>
                            <span>+1 (800) 123-4567</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="mail" class="text-primary shrink-0 w-4 h-4"></i>
                            <span>support@primesetups.com</span>
                        </li>
                    </ul>
                </div>

            </div>
            <?php endif; ?>

            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                <p>&copy; <?php echo date("Y"); ?> PrimeSetups. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-white transition-colors">Disclaimer</a>
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
