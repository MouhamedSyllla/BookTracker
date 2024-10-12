<?php

class HomeController extends Controller {

    public function index() {
        $isLoggedIn = isLoggedIn();
    
        // If the user is logged in, fetch relevant data
        $bookModel = $this->model('Book');
        $loanModel = $this->model('Loan');

        // Fetch data from models
        $books = $bookModel->getAllBooks();
        $loans = $loanModel->getAllLoans();
        
        $availableBooks = $this->getAvailableBooks($books,$loans);

        // Pass data to the view
        $this->view('home/index', [
            'books' => $availableBooks,
            'loans' => $loans
        ]);
    }

    public function about(){        
        $this->view('home/about');
    }
}
