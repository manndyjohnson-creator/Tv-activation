<?php include 'includes/header.php'; ?>

<div class="pt-32 pb-24 bg-light">
    <div class="container mx-auto px-6 max-w-7xl">
        <div class="text-center mb-16 fade-in-up">
            <h1 class="text-5xl font-extrabold text-slate-900 mb-6">Tech Guides & News</h1>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto">Expert tips, troubleshooting guides, and the latest news in home entertainment.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Main Content -->
            <div class="lg:w-2/3 space-y-12">
                <!-- Post 1 -->
                <article class="bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 flex flex-col sm:flex-row group hover:shadow-md transition-shadow fade-in-up">
                    <div class="sm:w-2/5 aspect-video sm:aspect-auto overflow-hidden relative">
                        <img src="assets/images/tv_installation.png" alt="Guide" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div class="absolute top-4 left-4 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">Guides</div>
                    </div>
                    <div class="p-8 sm:w-3/5 flex flex-col justify-center">
                        <h2 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors cursor-pointer">How to Setup a Smart TV: A Beginner's Guide</h2>
                        <p class="text-slate-600 mb-6 line-clamp-2">Just bought a new Smart TV? Here is everything you need to know to get it unboxed and mounted.</p>
                        <a href="#" class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all mt-auto w-fit">Read Article &rarr;</a>
                    </div>
                </article>
                <!-- Post 2 -->
                <article class="bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 flex flex-col sm:flex-row group hover:shadow-md transition-shadow fade-in-up delay-100">
                    <div class="sm:w-2/5 aspect-video sm:aspect-auto overflow-hidden relative">
                        <img src="assets/images/streaming_setup.png" alt="Troubleshooting" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div class="absolute top-4 left-4 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">Troubleshooting</div>
                    </div>
                    <div class="p-8 sm:w-3/5 flex flex-col justify-center">
                        <h2 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors cursor-pointer">Common TV Activation Problems</h2>
                        <p class="text-slate-600 mb-6 line-clamp-2">Stuck on the activation screen? Screen frozen? Read our troubleshooting guide.</p>
                        <a href="#" class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all mt-auto w-fit">Read Article &rarr;</a>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3 space-y-8 fade-in-up delay-200">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-lg mb-4 text-slate-900">Categories</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="flex justify-between items-center text-slate-600 hover:text-primary transition-colors pb-3 border-b border-slate-100">Guides</a></li>
                        <li><a href="#" class="flex justify-between items-center text-slate-600 hover:text-primary transition-colors pb-3 border-b border-slate-100">Troubleshooting</a></li>
                        <li><a href="#" class="flex justify-between items-center text-slate-600 hover:text-primary transition-colors">Networking</a></li>
                    </ul>
                </div>

                <div class="bg-slate-900 text-white p-8 rounded-3xl">
                    <h3 class="font-bold text-xl mb-3">Need Immediate Help?</h3>
                    <p class="text-slate-300 mb-6 text-sm">Can't find the answer you're looking for? Our certified technicians are available.</p>
                    <a href="contact" class="block text-center w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 rounded-xl transition-colors">Contact Support</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
