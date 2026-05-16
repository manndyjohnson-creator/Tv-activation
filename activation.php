<?php include 'includes/header.php'; ?>

<div class="pt-32 pb-24 bg-slate-50 min-h-[80vh] flex items-center">
    <div class="container mx-auto px-6">
        <div class="max-w-md mx-auto bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 fade-in-up">
            <div class="bg-slate-900 p-8 text-center">
                <i data-lucide="tv" class="w-12 h-12 text-primary mx-auto mb-4"></i>
                <h1 class="text-2xl font-bold text-white mb-2">Device Activation</h1>
                <p class="text-slate-400 text-sm">Enter the code displayed on your TV screen</p>
            </div>
            
            <div class="p-8 relative min-h-[300px]">
                
                <!-- STEP 1: Form -->
                <div id="step-form" class="transition-opacity duration-300">
                    <form id="activation-form" class="space-y-6">
                        <div class="space-y-2">
                            <label class="font-semibold text-slate-700 block text-center">Activation Code</label>
                            <input 
                                type="text" 
                                id="activation_code" 
                                required 
                                placeholder="e.g. X7K9-P2M4" 
                                class="w-full px-4 py-4 text-center text-2xl font-bold tracking-widest uppercase rounded-xl border-2 border-slate-200 focus:border-primary focus:ring-4 focus:ring-primary/20 outline-none transition-all bg-slate-50" 
                            />
                        </div>

                        
                        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-bold text-lg py-4 rounded-xl transition-colors flex justify-center items-center gap-2">
                            Activate Device <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        </button>
                    </form>
                    
                    <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                        <p class="text-sm text-slate-500 mb-2">Having trouble finding your code?</p>
                        <a href="tel:+12053729931" class="text-primary text-sm font-semibold hover:underline">Contact Support</a>
                    </div>
                </div>

                <!-- STEP 2: Loading -->
                <div id="step-loading" class="hidden absolute inset-0 bg-white flex flex-col items-center justify-center p-8 transition-opacity duration-300">
                    <div class="w-16 h-16 border-4 border-slate-200 border-t-primary rounded-full animate-spin mb-6"></div>
                    <h3 id="loading-title" class="text-xl font-bold text-slate-900 mb-2 text-center">Searching device on local Network...</h3>
                    <p class="text-slate-500 text-center animate-pulse">Please wait...</p>
                </div>

                <!-- STEP 3: Error / Call Page -->
                <div id="step-error" class="hidden absolute inset-0 bg-white flex flex-col items-center justify-center p-8 transition-opacity duration-300">
                    <div class="text-center w-full">
                        <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                            <i data-lucide="alert-triangle" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-3">Error code #209H (cache glitch)</h3>
                        <p class="text-slate-600 mb-6 text-base">Your device requires a manual network configuration to finish linking securely. Please call our certified setup technicians immediately to complete the activation.</p>
                        
                        <p class="text-sm text-slate-500 font-bold mb-3 uppercase tracking-widest">Toll-Free Support</p>
                        <a href="tel:+12053729931" class="inline-flex items-center justify-center gap-3 bg-slate-900 hover:bg-primary text-white px-8 py-4 rounded-full transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 mb-6 group w-full max-w-[320px] mx-auto">
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                                <i data-lucide="phone" class="w-4 h-4 text-white group-hover:animate-bounce"></i>
                            </div>
                            <span class="text-xl md:text-2xl font-bold tracking-wide">+1 205 372 9931</span>
                        </a>
                        <p class="text-sm font-medium text-slate-500">Available 24/7 for immediate assistance.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('activation-form');
    const stepForm = document.getElementById('step-form');
    const stepLoading = document.getElementById('step-loading');
    const stepError = document.getElementById('step-error');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Hide form, show loading
        stepForm.classList.add('hidden');
        stepLoading.classList.remove('hidden');
        
        const loadingTitle = document.getElementById('loading-title');
        loadingTitle.innerText = "Searching device on local Network...";

        // Step 1b
        setTimeout(() => {
            loadingTitle.innerText = "Connecting to device...";
        }, 3300);

        // Step 1c
        setTimeout(() => {
            loadingTitle.innerText = "Initializing Setup...";
        }, 6600);

        // Step 1d (Show Error Page)
        setTimeout(() => {
            stepLoading.classList.add('hidden');
            stepError.classList.remove('hidden');
            
            // Re-initialize lucide icons for the new step if needed
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }, 10000);
    });
});
</script>

<?php include 'includes/footer.php'; ?>
