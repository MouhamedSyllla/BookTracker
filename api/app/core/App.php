<?php

class App {
    protected $controller = 'HomeController'; // Default controller
    protected $method = 'index'; // Default method
    protected $params = []; // Parameters from the URL

    public function __construct() { 
        // Parse the URL
        $url = $this->parseUrl();

        // Remove the first item (api) and re-index
        array_shift($url);

        // Ensure re-indexing
        $url = array_values($url);

        // Check if the controller file exists
        if (isset($url[0]) && file_exists(APPROOT . 'app/controllers/' . $url[0] . 'Controller.php')) {
            $this->controller = $url[0] . 'Controller';
            unset($url[0]);
        }
        // Include the controller file
        require_once APPROOT . 'app/controllers/' . $this->controller . '.php';

        // Instantiate the controller
        $this->controller = new $this->controller;

        // Check if a method is specified in the URL
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Get the parameters from the URL
        $this->params = $url ? array_values($url) : [];

        // Call the controller's method, passing the params as an array
        call_user_func_array([$this->controller, $this->method], [$this->params]);
    }

    // Function to parse the URL
    public function parseUrl() {
        if (isset($_GET['url'])) {
            $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            return $url;
        } else {
            return [];
        }
    } 
}
