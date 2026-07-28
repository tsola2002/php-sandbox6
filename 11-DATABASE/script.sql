-- THIS WILL CREATE A DATABASE 
CREATE DATABASE DB_JOB;


-- THIS WILL SWITCH TO A SPECIFIC DATABASE 
USE DB_JOB;


-- THIS WILL CREATE A TABLE
CREATE TABLE TBL_USER(
    userid int(11) primary key,
    name varchar(50),
    qualification varchar(50),
    experience int(11)
);

-- THIS WILL INSERT DATA INTO THE TABLE
INSERT INTO TBL_USER(userid, name, qualification, experience) VALUES
(1, 'John', 'B.Tech', 5),
(2, 'Alice', 'M.Tech', 3),
(3, 'Bob', 'B.Sc', 2),
(4, 'Eve', 'Ph.D', 7),
(5, 'Charlie', 'M.Sc', 4);

-- THIS WILL SELECT ALL DATA FROM THE TABLE
SELECT * FROM TBL_USER;

-- THIS WILL UPDATE DATA IN THE TABLE
UPDATE TBL_USER SET qualification = 'MMS' WHERE userid = 1;


-- THIS WILL DELETE DATA FROM THE TABLE
DELETE FROM TBL_USER WHERE userid = 1;