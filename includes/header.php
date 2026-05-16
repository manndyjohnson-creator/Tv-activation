<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeSetups | Smart TV Setup & Activation Services</title>
    
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
                        primary: {
                            DEFAULT: '#2563eb',
                            light: '#3b82f6',
                            dark: '#1d4ed8'
                        },
                        dark: '#0f172a',
                        light: '#f8fafc',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-light text-slate-800 antialiased flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 py-5 bg-transparent">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <a href="index.php" class="flex items-center gap-2 group">
                    <div class="bg-primary p-2 rounded-lg text-white group-hover:bg-primary-dark transition-colors">
                        <i data-lucide="tv" class="w-6 h-6"></i>
                    </div>
                    <span id="nav-logo-text" class="text-xl font-bold text-white transition-colors duration-300">
                        Prime<span class="text-primary">Setups</span>
                    </span>
                </a>

                <?php if ($currentPage != 'activation.php'): ?>
                <!-- Desktop Nav -->
                <div class="hidden lg:flex items-center gap-8">
                    <a href="index.php" class="nav-link font-medium hover:text-primary transition-colors <?php echo $currentPage == 'index.php' ? 'text-primary' : 'text-white/90 hover:text-white'; ?>">Home</a>
                    <a href="services.php" class="nav-link font-medium hover:text-primary transition-colors <?php echo $currentPage == 'services.php' ? 'text-primary' : 'text-white/90 hover:text-white'; ?>">Services</a>
                    <a href="blog.php" class="nav-link font-medium hover:text-primary transition-colors <?php echo $currentPage == 'blog.php' ? 'text-primary' : 'text-white/90 hover:text-white'; ?>">Blog</a>
                    <a href="contact.php" class="nav-link font-medium hover:text-primary transition-colors <?php echo $currentPage == 'contact.php' ? 'text-primary' : 'text-white/90 hover:text-white'; ?>">Contact</a>
                    
                    <a href="contact.php" class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-full font-semibold transition-all shadow-lg shadow-primary/30">
                        Get Started
                    </a>
                </div>
                <?php endif; ?>

                <?php if ($currentPage != 'activation.php'): ?>
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden text-white transition-colors duration-300">
                    <i data-lucide="menu" class="w-7 h-7"></i>
                </button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Mobile Nav -->
        <div id="mobile-menu" class="hidden lg:hidden absolute top-full left-0 w-full bg-white shadow-xl py-4 flex flex-col px-6 gap-4 border-t border-slate-100">
            <a href="index.php" class="text-slate-700 font-medium py-2 border-b border-slate-100">Home</a>
            <a href="services.php" class="text-slate-700 font-medium py-2 border-b border-slate-100">Services</a>
            <a href="blog.php" class="text-slate-700 font-medium py-2 border-b border-slate-100">Blog</a>
            <a href="contact.php" class="text-slate-700 font-medium py-2 border-b border-slate-100">Contact</a>
            <a href="contact.php" class="bg-primary text-white text-center px-6 py-3 rounded-xl font-semibold mt-2">Get Started</a>
        </div>
    </nav>
    <main class="flex-grow">
