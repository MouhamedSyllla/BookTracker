<?php

class Loan extends Model {

    protected $table = 'loans';

    // Method to get all loans
    public function getAllLoans() {
        return $this->getAll($this->table);
    }

    // Method to get a loan by its ID
    public function getLoanById($id) {
        return $this->getById($this->table, $id);
    }

    public function getLoansByLenderId($id) {
        $sql = "SELECT loans.* FROM loans 
                JOIN books ON loans.book_id = books.id 
                WHERE books.owner_id = :lender_id; ";
        
        $stmt = $this->query($sql, ['lender_id' => $id]);    

        return $stmt->fetchAll();              
    }

    // Method to add a new loan
    public function addLoan($data) {
        $sql = "INSERT INTO {$this->table} (
                    book_id, 
                    borrower_name, 
                    borrower_adress, 
                    borrower_num, 
                    description,
                    return_date 
                ) 
                VALUES (
                    :book_id, 
                    :borrower_name, 
                    :borrower_adress, 
                    :borrower_num, 
                    :description,
                    :return_date
                )";
        $lastInsertId = $this->query($sql, [
            'book_id' => $data['book_id'],
            'borrower_name' => $data['borrower_name'],
            'borrower_adress' => $data['borrower_adress'],
            'borrower_num' => $data['borrower_num'],
            'description' => $data['description'],
            'return_date' => $data['return_date']
        ], true);
        // Return the id of the newly added loan
        return $lastInsertId;
    }

    // Method to update an existing loan
    public function updateLoan($id, $data) {
        $sql = "UPDATE {$this->table} 
                SET borrower_name = :borrower_name,
                    borrower_adress = :borrower_adress,
                    borrower_num = :borrower_num, 
                    description = :description,
                    return_date = :return_date 
                WHERE id = :id";
        return($this->query($sql, [
            'borrower_name' => $data['borrower_name'],
            'borrower_adress' => $data['borrower_adress'],
            'borrower_num' => $data['borrower_num'],
            'description' => $data['description'],
            'return_date' => $data['return_date'],
            'id' => $id
        ]));
    }

    // Method to delete a loan by its ID
    public function deleteLoan($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->query($sql, ['id' => $id]);
        return $stmt->rowCount() > 0;
    }

    public function isLoanForUser($loan_id, $user_id) {
        $sql = "SELECT loans.*
                FROM loans
                JOIN books ON loans.book_id = books.id
                JOIN users ON books.owner_id = users.id
                WHERE loans.id = :loan_id AND users.id = :user_id";

        // returns false if no match
        $stmt = $this->query($sql, [
            'loan_id' => $loan_id, 
            'user_id' => $user_id
        ]);

        // Use fetch to see if the query returned a row
        
        return $stmt->fetch();
    }
}
