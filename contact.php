<?php
$submitted = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form data here
    $submitted = true;
}
include 'includes/header.php'; 
?>

<div class="pt-32 pb-24 bg-light">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="text-center mb-16 fade-in-up">
            <h1 class="text-5xl font-extrabold text-slate-900 mb-6">Contact Us</h1>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto">Get in touch with our expert technicians. We're here to help you set up, mount, and configure your home entertainment systems.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div class="space-y-8 fade-in-up delay-100">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                    <h3 class="text-2xl font-bold text-slate-900 mb-6">Contact Information</h3>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center shrink-0">
                                <i data-lucide="phone" class="text-primary w-6 h-6"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">Phone</p>
                                <p class="text-slate-600">+1 205 675 0579</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center shrink-0">
                                <i data-lucide="mail" class="text-primary w-6 h-6"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">Email</p>
                                <p class="text-slate-600">support@streamactivatehub.com</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center shrink-0">
                                <i data-lucide="map-pin" class="text-primary w-6 h-6"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">Address</p>
                                <p class="text-slate-600">901 N Smith Rd<br/>Bloomington, IN 47408</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white p-8 md:p-10 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 fade-in-up delay-200">
                <h3 class="text-2xl font-bold text-slate-900 mb-2">Send Us a Message</h3>
                <p class="text-slate-600 mb-8">Fill out the form below and we'll get back to you within 24 hours.</p>

                <?php if ($submitted): ?>
                <div class="bg-green-50 text-green-800 p-6 rounded-2xl border border-green-200 text-center">
                    <h4 class="text-xl font-bold mb-2">Message Sent!</h4>
                    <p>Thank you for reaching out. A technician will contact you shortly.</p>
                </div>
                <?php else: ?>
                <form method="POST" action="contact.php" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="font-semibold text-slate-700">First Name</label>
                            <input type="text" name="firstName" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all bg-slate-50" />
                        </div>
                        <div class="space-y-2">
                            <label class="font-semibold text-slate-700">Last Name</label>
                            <input type="text" name="lastName" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all bg-slate-50" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="font-semibold text-slate-700">Email Address</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all bg-slate-50" />
                    </div>
                    <div class="space-y-2">
                        <label class="font-semibold text-slate-700">Message</label>
                        <textarea name="message" rows="4" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all bg-slate-50 resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-bold text-lg py-4 rounded-xl transition-colors">
                        Send Message
                    </button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
