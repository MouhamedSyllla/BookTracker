<?php

class Book extends Model {

    protected $table = 'books';

    // Method to get all books
    public function getAllBooks() {
        return $this->getAll($this->table);
    }

    // Method to get books by owner's id
    public function getBooksByOwnerId($id) {
        $sql = "SELECT * FROM {$this->table} WHERE owner_id = :owner_id";
        // $stmt = $this->query($sql, ['owner_id' => $id]);
        
        return $this->query($sql, ['owner_id' => $id])->fetchAll();
    }


    // Method to get a book by its ID
    public function getBookById($id) {
        return $this->getById($this->table, $id);
    }

    // Method to add a new book
    public function addBook($data) {
        $sql = "INSERT INTO {$this->table} (
                    title, 
                    author, 
                    published_year, 
                    genre, 
                    description, 
                    owner_id,
                    cover
                ) 
                VALUES (
                    :title, 
                    :author, 
                    :published_year, 
                    :genre, 
                    :description, 
                    :owner_id,
                    :cover
                )";
                    
        $lastInsertId = $this->query($sql, [
            'title' => $data['title'],
            'author' => $data['author'],
            'published_year' => $data['published_year'],
            'genre' => $data['genre'],
            'description' => $data['description'],
            'owner_id' => $data['owner_id'],
            'cover' => $data['cover']
        ], true);
        // Return the ID of the newly added book
        return $lastInsertId;
    }

    // Method to update an existing book
    public function updateBook($id, $data) {
        $sql = "UPDATE {$this->table} SET 
                    title = :title, 
                    author = :author, 
                    published_year = :published_year, 
                    genre = :genre, 
                    description = :description,
                    cover = :cover
                WHERE id = :id";
        return ($this->query($sql, [
            'title' => $data['title'],
            'author' => $data['author'],
            'published_year' => $data['published_year'],
            'genre' => $data['genre'],
            'description' => $data['description'],
            'cover' => $data['cover'],
            'id' => $id
        ]));
    }

    // Method to delete a book by its ID
    public function deleteBook($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->query($sql, ['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
