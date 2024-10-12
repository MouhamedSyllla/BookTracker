<?php

class LoanController extends Controller {

    public function index($error=null) {
        $this->requireLogin();

        $loanModel = $this->model('Loan');
        $loans = $loanModel->getLoansByLenderId($_SESSION['user_id']);
        $error = $loans ? null : "Aucun prêt trouvé";

        $data = ['loans' => $loans, 'error' => $error];
        $this->view('loans/index', $data);
    }

    public function show($params) {
        $this->requireLogin();

        $params = (array)$params;
        if (empty($params) || !is_numeric($params[0])) {
            $this->view('loans/index', ['error' => 'Invalid loan ID']);
            return;
        }

        $loanModel = $this->model('Loan');
        $loan = $loanModel->getLoanById($params[0]);
        

        if (!$loan) {
            $this->index('Loan not found');
        } else {
            $this->view('loans/show', ['loan' => $loan]);
        }
    }

    public function create($params) {
        $this->requireLogin();

        $params = (array)($params);
        $bookId = $params[0];

        if (empty($bookId) || !is_numeric($bookId)) {
            $this->view('loans/index', ['error' => 'Invalid loan ID']);
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'book_id' => $bookId,
                'borrower_name' => trim($_POST['borrower_name']),
                'borrower_adress' => trim($_POST['borrower_adress']),
                'borrower_num' => trim($_POST['borrower_num']),
                'return_date' => trim($_POST['return_date']),
                'description' => trim($_POST['description']),
                'book_id_err' => '',
                'borrower_name_err' => '',
                'borrower_adress_err' => '',
                'borrower_num_err' => '',
            ];
            
    
            // Validate inputs
            if (empty($data['book_id']) || !is_numeric($data['book_id'])) 
                $data['book_id_err'] = 'Valid Book ID is required';
            if (empty($data['borrower_name'])) 
                $data['borrower_name_err'] = "Nom de l'empreinteur est requis";
            if (empty($data['borrower_adress']))   
                $data['borrower_adress_err'] = "L'address de l'empreinteur est requis";
            if (empty($data['borrower_num'])) 
                $data['borrower_num_err'] = "Le numéro de l'empreinteur est requis";

    
            // Check if there are any errors
            if (empty($data['book_id_err']) 
                && empty($data['borrower_name_err']) 
                && empty($data['borrower_adress_err']) 
                && empty($data['borrower_num_err']) 
            ) {
                $loanModel = $this->model('Loan');
                $loanId = $loanModel->addLoan($data);
                
                if ($loanId) {
                    $this->show([$loanId]);
                } else {
                    $this->view('loans/create', ['error' => "L'opératon de prêt a échoue"]);
                }
            } else {
                $this->view('loans/create', $data);
            }

        } else {
            $data = ['book_id' => $bookId];
            $this->view('loans/create', $data);
        }

    }

    public function edit($params) {
        $this->requireLogin();
        

        $params = (array)$params;
        // Ensure loan ID is valid
        if (empty($params) || !is_numeric($params[0])) {
            $this->view('loans/index', ['error' => 'Invalid loan ID']);
            return;
        }

        $loanModel = $this->model('Loan');
        $loan = $loanModel->getLoanById($params[0]);


        if (!$loan) {
            $this->view('loans/index', ['error' => 'Loan not found']);
        } else {
            $this->checkLoan($loan['id']);
            // If form was submitted (POST request)
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = [
                    'book_id' => $params[0],
                    'borrower_name' => trim($_POST['borrower_name']),
                    'borrower_adress' => trim($_POST['borrower_adress']),
                    'borrower_num' => trim($_POST['borrower_num']),
                    'description' => trim($_POST['description']),
                    'return_date' => trim($_POST['return_date']),
                    'book_id_err' => '',
                    'borrower_name_err' => '',
                    'borrower_adress_err' => '',
                    'borrower_num_err' => '',
                ];

                // Validate inputs
                if (empty($data['book_id']) || !is_numeric($data['book_id'])) 
                    $data['book_id_err'] = 'Valid Book ID is required';
                if (empty($data['borrower_name'])) 
                    $data['borrower_name_err'] = "Nom de l'empreinteur est requis";
                if (empty($data['borrower_adress']))   
                    $data['borrower_adress_err'] = "L'address de l'empreinteur est requis";
                if (empty($data['borrower_num'])) 
                    $data['borrower_num_err'] = "Le numéro de l'empreinteur est requis";

                // If no validation errors, proceed to update
                if (empty($data['book_id_err']) 
                    && empty($data['borrower_name_err']) 
                    && empty($data['borrower_adress_err']) 
                    && empty($data['borrower_num_err']) 
                ) {
                    // Call the update method
                    if ($this->update($params[0], $data)) {
                        // Redirect to loan details or list after successful update
                        $this->show([$params[0]]);
                    } else {
                        // Handle failure
                        $this->view('loans/edit', ['error' => "La mise à jour a échouée", 'loan' => $loan]);
                    }
                } else {
                    // If there are validation errors, reload the form with errors
                    $this->view('loans/edit', $data);
                }
            } else {
                // Display the loan edit form
                $this->view('loans/edit', ['loan' => $loan]);
            }
        }
    }

    public function update($loanId, $data) {
        $this->requireLogin();

        $loanModel = $this->model('Loan');
        // Return true if update was successful, false otherwise
        return $loanModel->updateLoan($loanId, $data);
    }

    
    public function delete($params) {
        $params = (array)$params;
        $this->requireLogin();
        $this->checkLoan($params[0]); 
        if (empty($params) || !is_numeric($params[0])) {
            $this->view('loans/index', ['error' => 'Invalid loan ID']);
            return;
        }

        $loanModel = $this->model('Loan');

        if ($loanModel->deleteLoan($params[0])) {
            $this->index();
        } else {
            $this->index("La suppression a echoué");
        }
    }

    public function checkLoan($loan_id) {
        $user_id = $_SESSION['user_id'];
        $loanModel = $this->model('Loan');
        $result = $loanModel->isLoanForUser($loan_id, $user_id);
        if (!$result) {
            $this->view('errors/404');
            exit;
        }
    }
}
