<?php
class BookController extends Controller {
    
    //  method that lists all books
    public function index() {
        $this->requireLogin(); // Ensure the user is logged in
     
        $bookModel = $this->model('Book');
        $loanModel = $this->model('Loan');

        $books = $bookModel->getBooksByOwnerId($_SESSION['user_id']);
        $loans = $loanModel->getLoansByLenderId($_SESSION['user_id']);

        $availableBooks = $this->getAvailableBooks($books, $loans);

        $this->view('books/index', ['books' => $availableBooks]);
    }

    //  method that shows a specific book
    public function show($params) {

        if (empty($params[0]) || !is_numeric($params[0])) {
            $this->view('books/index', ['error' => 'Invalid book ID']);
            return;
        }

        $bookModel = $this->model('Book');
        $book = $bookModel->getBookById($params[0]);

        if (!$book) {
            $this->view('books/index', ['error' => 'Livre non trouvé']);
        } else {
            $this->view('books/show', ['book' => $book]);
        }
    }

    //  method for creating a book
    public function create() {
        $this->requireLogin(); // Ensure the user is logged in

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => trim($_POST['title']),
                'author' => trim($_POST['author']),
                'published_year' => trim($_POST['published_year']),
                'genre' => trim($_POST['genre']),
                'description' => trim($_POST['description']),
                'cover' => '',
                'owner_id' => trim($_SESSION['user_id']),
                'title_err' => '',
                'author_err' => '',
                'published_year_err' => '',
                'genre_err' => '',
                'description_err' => '',
                'cover_err' => '',
            ];

            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageTmpName = $_FILES['image']['tmp_name'];
                $imageName = basename($_FILES['image']['name']);

                // Use a local path to save to the image not a url path like we would do with BASE_URL.
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/BookTracker/app/assets/images/uploads/' . $imageName; 

                // Move the uploaded image to 'uploads' directory
                if (move_uploaded_file($imageTmpName, $imagePath)) {
                    $data['cover'] = '/app/assets/images/uploads/' . $imageName;
                } else {
                    $data['cover_err'] = 'Erreur lors du téléchargement de l image. Ressayez SVP'; 
                    error_log("Erreur lors du téléchargement de l'image. Code d'erreur : " . $_FILES['image']['error']);
                    exit();
                }
            } 


            // Validate inputs
            if (empty($data['title'])) 
                $data['title_err'] = 'Titre est requis';
            if (empty($data['author'])) 
                $data['author_err'] = 'auteur est requis';
            if (empty($data['published_year']) || !is_numeric($data['published_year'])) 
                $data['published_year_err'] = 'Année de publication est requise et doit etre un nombre';
            if (empty($data['genre'])) 
                $data['genre_err'] = 'Genre est requis';
            if (empty($data['description'])) 
                $data['description_err'] = 'Description est requise';
            if (empty($data['cover'])) 
                $data['cover_err'] = 'image est requise';


            // If no validation errors, proceed to create the book
            if (empty($data['title_err']) && empty($data['author_err']) && empty($data['published_year_err']) && empty($data['genre_err']) && empty($data['description_err']) && empty($data['cover_err'])) {
                $bookModel = $this->model('Book');
                $bookId = $bookModel->addBook($data);

                if ($bookId) {
                    // Redirect to the book details page after successful creation
                    $this->show([$bookId]);
                } else {
                    $this->view('books/create', ['error' => 'L ajout du livre a echoué']);
                }
            } else {
                // Display the form with errors
                $this->view('books/create', $data);
            }
        } else {
           
            $this->view('books/create');
        }
    }

    //  method for editing a book
    public function edit($params) {
        $this->requireLogin(); // Ensure the user is logged in

        if (empty($params) || !is_numeric($params[0])) {
            $this->view('books/index', ['error' => 'Invalid book ID']);
            return;
        }

        $bookModel = $this->model('Book');
        $book = $bookModel->getBookById($params[0]);


        if (!$book) {
            $this->view('books/index', ['error' => "Livre non trouvé"]);
        } else {
            // If form was submitted (POST request)
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $data = [
                    'title' => trim($_POST['title']),
                    'author' => trim($_POST['author']),
                    'published_year' => trim($_POST['published_year']),
                    'genre' => trim($_POST['genre']),
                    'description' => trim($_POST['description']),
                    'cover' => $book['cover'],
                    'id' => $params[0],
                    'title_err' => '',
                    'author_err' => '',
                    'published_year_err' => '',
                    'genre_err' => '',
                    'description_err' => '',
                    'cover_err' => ''
                ];    

                // Handle image upload
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $imageTmpName = $_FILES['image']['tmp_name'];
                    $imageName = basename($_FILES['image']['name']);

                    // Use a local path to save to the image not a url path like we would do with BASE_URL.
                    $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/BookTracker/app/assets/images/uploads/' . $imageName; 

                    // Move the uploaded image to 'uploads' directory
                    if (move_uploaded_file($imageTmpName, $imagePath)) {
                        $data['cover'] = '/app/assets/images/uploads/' . $imageName;
                    } else {
                        $data['cover_err'] = 'Erreur lors du téléchargement de l image. Ressayez SVP'; 
                        error_log("Erreur lors du téléchargement de l'image. Code d'erreur : " . $_FILES['image']['error']);
                        exit();
                    }
                }
                // Validate inputs
                if (empty($data['title'])) 
                $data['title_err'] = 'Titre est requis';
                if (empty($data['author'])) 
                    $data['author_err'] = 'auteur est requis';
                if (empty($data['published_year']) || !is_numeric($data['published_year'])) 
                    $data['published_year_err'] = 'Année de publication est requise et doit etre un nombre';
                if (empty($data['genre'])) 
                    $data['genre_err'] = 'Genre est requis';
                if (empty($data['description'])) 
                    $data['description_err'] = 'Description est requise';
                if (empty($data['cover'])) 
                    $data['cover_err'] = 'image est requise';

                // If no validation errors, proceed to update
                if (
                        empty($data['title_err']) 
                        && empty($data['author_err']) 
                        && empty($data['published_year_err']) 
                        && empty($data['genre_err']) 
                        && empty($data['description_err']) 
                        && empty($data['cover_err'])
                    ) {
                    if ($bookModel->updateBook($params[0], $data)) {
                        // Redirect to the book details page after successful update
                        $this->show([$params[0]]);
                        
                    } else {
                        $this->view('books/edit', ['error' => "La modification du livre a échoué", 'book' => $book]);
                       
                    }
                } else {
                    // If there are validation errors, reload the form with errors
                    $this->view('books/edit', ['book' => $data]);
                    
                }
            } else {
                // Display the book edit form
                $this->view('books/edit', ['book' => $book]);
            }
        }
    }

    //  method for deleting a book
    public function delete($params) {
        $this->requireLogin(); // Ensure the user is logged in

        if (empty($params[0]) || !is_numeric($params[0])) {
            $this->view('books/index', ['error' => 'Invalid book ID']);
            return;
        }

        $bookModel = $this->model('Book');
        if ($bookModel->deleteBook($params[0])) {
            $this->index();
        } else {
            $this->view('books/index', ['error' => "La suppression du livre a échoué"]);
        }
    }

    

    public function search($params) {
        $term = $params[0];
        $bookModel = $this->model('Book');
        $loanModel = $this->model('Loan');
    
        // Fetch all books first
        $books = $bookModel->getAllBooks();
        $loans = $loanModel->getAllLoans();
    
        // Search for books by title or author in the fetched books
        $bookSearchResult = array_filter(
            $books, 
            function ($book) use ($term) {
                return (
                    stripos($book['title'], $term) !== false
                    || 
                    stripos($book['author'], $term) !== false
                );
            }
        );
    
        // If no books were found
        if (empty($bookSearchResult)) {
            $this->view('home/search', ['error' => 'Aucun livre trouvé']);
        } else {
            // Check if the user is logged in
            if (isLoggedIn()) {
                $loanModel = $this->model('Loan');
    
                // Get the loans for the current user
                $loans = $loanModel->getLoansByLenderId($_SESSION['user_id']);

                // Filter loans to check if loan['book_id'] is in $bookSearchResult
                $loanSearchResult = array_filter($loans, function ($loan) use ($bookSearchResult) {
                    return in_array($loan['book_id'], array_column($bookSearchResult, 'id'));
                });
    
                if (empty($loanSearchResult)) {
                    $bookSearchResult = $this->getAvailableBooks($bookSearchResult, $loans);
                    $this->view('home/search', ['books' => $bookSearchResult]);
                } else {
                    // Return both books and loans if user is logged in
                    $bookSearchResult = $this->getAvailableBooks($bookSearchResult, $loans);
                    $this->view('home/search', [
                        'books' => $bookSearchResult,
                        'loans' => $loanSearchResult
                    ]);
                }
                
            } else {
                // For visitors, return only books (no loans)
                $bookSearchResult = $this->getAvailableBooks($bookSearchResult, $loans);
                if (!empty($bookSearchResult)) {
                    $this->view('home/search', ['books' => $bookSearchResult]);
                } else {
                    $this->view('home/search', ['error' => 'Aucun livre trouvé']);
                }
            }
        }
    }
}




