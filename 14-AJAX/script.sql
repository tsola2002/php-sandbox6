CREATE TABLE tbl_student (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL
);

INSERT INTO tbl_student(id, name, email) VALUES
(1, 'John', 'john.doe@yahoo.com'),
(2, 'Alice', 'alice.doe@yahoo.com'),
(3, 'Bob', 'bob.doe@yahoo.com'),
(4, 'Eve', 'eve.doe@yahoo.com'),
(5, 'Charlie', 'charlie.doe@yahoo.com');