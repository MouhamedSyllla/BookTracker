CREATE TABLE books (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    author VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    published_year YEAR(4) NOT NULL,
    genre VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    description TEXT COLLATE utf8mb4_general_ci DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
    owner_id INT(11) NOT NULL,
    cover VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    status VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    PRIMARY KEY (id),
    INDEX (owner_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE loans (
    id INT(11) NOT NULL AUTO_INCREMENT,
    book_id INT(11) NOT NULL,
    borrower_name VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    borrower_adress VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    borrower_num VARCHAR(15) COLLATE utf8mb4_general_ci NOT NULL,
    description TEXT COLLATE utf8mb4_general_ci DEFAULT NULL,
    loan_date TIMESTAMP NOT NULL DEFAULT current_timestamp(),
    return_date DATE DEFAULT NULL,
    PRIMARY KEY (id),
    INDEX (book_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    email VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    password VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
    avatar VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    PRIMARY KEY (id),
    INDEX (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
