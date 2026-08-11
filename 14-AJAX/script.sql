CREATE TABLE tbl_student(
    id int(11) primary key,
    name varchar(50),
    email varchar(255)
);

INSERT INTO tbl_student(id, name, email) VALUES
(1, 'John', 'john.doe@yahoo.com'),
(2, 'Alice', 'alice.doe@yahoo.com'),
(3, 'Bob', 'bob.doe@yahoo.com'),
(4, 'Eve', 'eve.doe@yahoo.com'),
(5, 'Charlie', 'charlie.doe@yahoo.com');