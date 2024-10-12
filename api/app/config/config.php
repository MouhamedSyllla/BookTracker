<?php
// Base URL of the application
define('BASE_URL', 'http://localhost/BookTracker/api');
// define('BASE_URL', 'http://192.168.1.57/BookTracker');



// Enable or disable error reporting
define('DEBUG', true);

if (DEBUG) { 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}

// Specify the error log file
ini_set('log_errors', 1);  // Enable logging
ini_set('error_log', 'app/views/errors.php');  // Path to the log file

// Default timezone
date_default_timezone_set('Africa/Dakar');


// Other global configurations
define('SITE_NAME', 'BookTracker'); // Name of the site
define('ADMIN_EMAIL', 'mouhamedsyllla60@gmail.com'); // Admin email for notifications

