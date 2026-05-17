<?php
// router.php
// This simulates the .htaccess rewrite rules for the PHP built-in development server.
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// If the requested path exists as a regular file/directory, serve it directly
if (file_exists(__DIR__ . $path) && !is_dir(__DIR__ . $path)) {
    return false;
}

// If the path corresponds to a .php file, serve that instead (removing the need for .php in the URL)
$phpFile = __DIR__ . $path . '.php';
if (file_exists($phpFile)) {
    $_SERVER['PHP_SELF'] = $path . '.php';
    $_SERVER['SCRIPT_NAME'] = $path . '.php';
    require $phpFile;
    return true;
}

// Let the built-in server handle 404s
return false;
