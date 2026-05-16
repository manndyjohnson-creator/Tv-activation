document.addEventListener('DOMContentLoaded', () => {
    
    // Navbar Scroll Effect
    const navbar = document.getElementById('navbar');
    const navLogoText = document.getElementById('nav-logo-text');
    const navLinks = document.querySelectorAll('.nav-link');
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 10) {
            navbar.classList.remove('bg-transparent', 'py-5');
            navbar.classList.add('bg-white', 'shadow-md', 'py-3');
            navLogoText.classList.remove('text-white');
            navLogoText.classList.add('text-slate-900');
            if (mobileMenuBtn) {
                mobileMenuBtn.classList.remove('text-white');
                mobileMenuBtn.classList.add('text-slate-900');
            }
            
            navLinks.forEach(link => {
                if(!link.classList.contains('text-primary')) {
                    link.classList.remove('text-white/90', 'lg:text-white/90', 'hover:text-white');
                    link.classList.add('text-slate-600');
                }
            });
        } else {
            navbar.classList.add('bg-transparent', 'py-5');
            navbar.classList.remove('bg-white', 'shadow-md', 'py-3');
            navLogoText.classList.add('text-white');
            navLogoText.classList.remove('text-slate-900');
            if (mobileMenuBtn) {
                mobileMenuBtn.classList.add('text-white');
                mobileMenuBtn.classList.remove('text-slate-900');
            }

            
            navLinks.forEach(link => {
                if(!link.classList.contains('text-primary')) {
                    link.classList.add('text-white/90', 'hover:text-white');
                    link.classList.remove('text-slate-600');
                }
            });
        }
    });

    // Mobile Menu Toggle
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Intersection Observer for scroll animations
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.15
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('appear');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in-up').forEach(el => {
        observer.observe(el);
    });

    // FAQ Accordion
    const faqBtns = document.querySelectorAll('.faq-btn');
    faqBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const content = btn.nextElementSibling;
            const icon = btn.querySelector('.lucide-chevron-down');
            
            // Toggle current
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
                icon.classList.remove('rotate-180');
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
                icon.classList.add('rotate-180');
            }
        });
    });
});
