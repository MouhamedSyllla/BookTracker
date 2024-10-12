<?php

class UserController extends Controller {

    public function index() {
        $this->requireLogin();

        $bookModel = $this->model('Book');
        $loanModel = $this->model('Loan');

        $books = $bookModel->getBooksByOwnerId($_SESSION['user_id']);
        $loans = $loanModel->getLoansByLenderId($_SESSION['user_id']);

        $availableBooks = $this->getAvailableBooks($books, $loans);

        $this->view('users/index', 
            ['books' => $availableBooks, 
            'loans' => $loans]);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            foreach ($_POST as $key => $value) {
                $_POST[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Entrer l'email";
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Entrer un email valid';
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Entrer le mot de passe';
            }

            // Make sure errors are empty before proceeding
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Load User model
                $userModel = $this->model('User');

                // Attempt to log in the user
                $loggedInUser = $userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // Create a user session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Email ou Mot de passe incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            // Initialize data for GET request
            $data = [
                'email' => '',
                'password' => '', 
                'email_err' => '', 
                'password_err' => ''
            ];
            $this->view('users/login', $data);
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            foreach ($_POST as $key => $value) {
                $_POST[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'avatar' => '/app/assets/icons/userAvatarOutline.svg',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'avatar_err' => ''
            ];

            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageTmpName = $_FILES['image']['tmp_name'];
                $imageName = basename($_FILES['image']['name']);

                // Use a local path to save to the image not a url path like we would do with BASE_URL.
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/BookTracker/app/assets/images/uploads/' . $imageName; 
                
                // Move the uploaded image to 'uploads' directory
                if (move_uploaded_file($imageTmpName, $imagePath)) {
                    $data['avatar'] = '/app/assets/images/uploads/' . $imageName;
                } else {
                    $data['avatar_err'] = "Erreur lors du téléchargement de l'image";
                    error_log("Erreur lors du téléchargement de l'image. Code d'erreur : " . $_FILES['image']['error']);
                    exit();
                }
            }

            // Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Entrer le nom';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Entrer l'email";
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Entrer un email valid';
            } else {
                // Check if email already exists
                $userModel = $this->model('User');
                if ($userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email existe deja';
                }
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Entrer le mot de passe';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Le mot de doit etre au moins 6 characrteres';
            }

            // Validate confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Confirmer le mot de passe';
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Mots de passe non conformes';
            }

            // Make sure errors are empty before proceeding
            if (empty($data['name_err']) 
                && empty($data['email_err']) 
                && empty($data['password_err']) 
                && empty($data['confirm_password_err'])
            ) {
                // Register user
                if ($userModel->register($data)) {
                    redirectTo('/User/login');
                } else {
                    $this->view('users/register', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }
        } else {
            // Initialize data for GET request
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            $this->view('users/register', $data);
        }
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_avatar'] = $user['avatar'];
        redirectTo('/home');
    }

    public function logout() {
        $this->requireLogin();
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_avatar']);
        session_destroy();
        redirectTo('/');
    }
}
