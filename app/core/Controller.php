<?php

class Controller {

    // Method to generate a model object
    public function model($model) {

        // Require the model file
        $modelFile = APPROOT . 'app/models/' . $model . '.php';

        try {
            if(!file_exists($modelFile)) {
                throw new Exception("File not found: $modelFile");
            }
            require_once($modelFile);
            return new $model();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    // Method to generate a view object
    public function view($view, $data = []) {
        // Check if the view file exists
        $viewFile = APPROOT . 'app/views/' . $view . '.php';

        if (file_exists($viewFile)) {
            // Extract the data array into variables
            extract($data);
            require_once $viewFile;
        } else {
            // Directly load the error view with appropriate message
            $data = [
                'title' => 'View Not Found',
                'message' => "The view file '$viewFile' does not exist.",
                'backUrl' => '/'
            ];
            $this->view('errors', $data);
            exit;
        }
    }

    // Method to require login, checks if user is logged in
    protected function requireLogin() {
        if (!isLoggedIn()) {
            // Set HTTP 404 status code
            http_response_code(404);

            // Redirect to the 404 page
            $this->view('errors/404');
            exit; 
        }
    }
    // Method to get books that are not loaned out
    protected function getAvailableBooks($books, $loans) {
        // Ensure $loans is an array and extract the book IDs that are loaned
        $loanedBookIds = array_column($loans, 'book_id');
        
        // Filter the $books array to only include books that are not loaned
        $availableBooks = array_filter($books, function($book) use ($loanedBookIds) {
            return !in_array($book['id'], $loanedBookIds);
        });
        
        return $availableBooks;
    }
}
    