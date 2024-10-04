<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define the root path of the application
define('APPROOT', dirname(__FILE__) . '/');

// Session settings
define('SESSION_LIFETIME', 3600); // Session lifetime in seconds
session_set_cookie_params(SESSION_LIFETIME);
// Start the Session
session_start();

// Include necessary files
require_once APPROOT . 'app/config/config.php';
require_once APPROOT . 'app/config/database.php';
require_once APPROOT . 'app/helpers/functions.php';
require_once APPROOT . 'app/core/Model.php';
require_once APPROOT . 'app/core/Controller.php';
require_once APPROOT . 'app/core/App.php';

// Initialize the app
$app = new App();
