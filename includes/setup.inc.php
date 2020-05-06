<?php

//Create a connection

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}

//Create a connection

//Create Database

$sql = "CREATE DATABASE web_app";
//Display result if database is created successfully
if ($conn->query($sql) == TRUE) {
	echo "Database created successfully | ";
}
//Otherwise, display output error
else {
	echo "Error creating database: " . $conn->error;
}
mysqli_select_db($conn, "web_app");

//Create Database

//Create Department Table

$sql1 = "CREATE TABLE department(
    id INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    department_name VARCHAR(255) NOT NULL
    )";
//Display result if connection is successful
if($conn->query($sql1) === TRUE) { 
echo "Department table created successfully | ";
}
//Otherwise, show output error
else {
echo "Error creating department table: ".$conn->error;
}

//Create Department Table

//Create User Table

$sql1 = "CREATE TABLE user(
    id INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    department_id INT(3) NOT NULL,
    gender VARCHAR(6) NOT NULL,
    user_role VARCHAR(50) NOT NULL,
    FOREIGN KEY (department_id) REFERENCES department(id)
    )";
//Display result if connection is successful
if($conn->query($sql1) === TRUE) { 
echo "User table created successfully | ";
}
//Otherwise, show output error
else {
echo "Error creating user table: ".$conn->error;
}

//Create User Table

//Create Category Table

$sql1 = "CREATE TABLE category(
    id INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(255) NOT NULL
    )";
//Display result if connection is successful
if($conn->query($sql1) === TRUE) { 
echo "Category table created successfully | ";
}
//Otherwise, show output error
else {
echo "Error creating category table: ".$conn->error;
}

//Create Category Table

//Create Idea Table

$sql1 = "CREATE TABLE idea(
    id INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idea_title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    attachment BLOB NOT NULL,
    category_id INT(3) NOT NULL,
    user__id INT(3) NOT NULL,
    department_id INT(3) NOT NULL,
    post_date DATETIME NOT NULL,
    comment_count int(11) NOT NULL,
    view_count int(11) NOT NULL,
    upvote_count int(11) NOT NULL,
    downvote_count int(11) NOT NULL,
    anonymous boolean NOT NULL,
    FOREIGN KEY (category_id) REFERENCES category(id),
    FOREIGN KEY (user__id) REFERENCES user(id),
    FOREIGN KEY (department_id) REFERENCES department(id)
    )";
//Display result if connection is successful
if($conn->query($sql1) === TRUE) { 
echo "Idea table created successfully | ";
}
//Otherwise, show output error
else {
echo "Error creating idea table: ".$conn->error;
}

//Create Idea Table

//Create Vote Info Table

$sql1 = "CREATE TABLE vote_info(
    idea_id INT(3) NOT NULL,
    user__id INT(3) NOT NULL,
    vote VARCHAR(255) NOT NULL,
    FOREIGN KEY (idea_id) REFERENCES idea(id),
    FOREIGN KEY (user__id) REFERENCES user(id),
    CONSTRAINT PK_vote_info PRIMARY KEY (idea_id, user__id)
    )";
//Display result if connection is successful
if($conn->query($sql1) === TRUE) { 
echo "Vote Info table created successfully | ";
}
//Otherwise, show output error
else {
echo "Error creating vote info table: ".$conn->error;
}

//Create Vote Info Table

//Create Comment Table

$sql1 = "CREATE TABLE comment(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idea_id INT(3) NOT NULL,
    user__id INT(3) NOT NULL,
    content TEXT NOT NULL,
    comment_date DATETIME NOT NULL,
    anonymous boolean NOT NULL,
    FOREIGN KEY (idea_id) REFERENCES idea(id),
    FOREIGN KEY (user__id) REFERENCES user(id)
    )";
//Display result if connection is successful
if($conn->query($sql1) === TRUE) { 
echo "Comment table created successfully | ";
}
//Otherwise, show output error
else {
echo "Error creating comment table: ".$conn->error;
}

//Create Comment Table

// DEFAULT DATA //

//Insert into Department Table

$sql1 = "INSERT INTO department (department_name) 
VALUES ('Accounts'), ('Finance'), ('Examinations'), ('IT'), 
('Quality Assurance'), ('Academics')";
//Display result if connection is successful
if($conn->query($sql1) === TRUE) { 
echo "Departments added successfully | ";
}
//Otherwise, show output error
else {
echo "Error adding departments: ".$conn->error;
}

//Insert into Department Table

//Insert into Category Table

$sql1 = "INSERT INTO category (category_name) VALUES 
('Financial'), ('Ethical'), ('Strategic'), ('Academics'), ('Extracurricular'), ('Administrative')";
//Display result if connection is successful
if($conn->query($sql1) === TRUE) { 
echo "Categories added successfully | ";
}
//Otherwise, show output error
else {
echo "Error adding categories: ".$conn->error;
}

//Insert into Category Table

//Insert into User Table

$password = "Joseph1234";
$josephpwd = password_hash($password, PASSWORD_DEFAULT);
$password = "Kondwani1234";
$kondwanipwd = password_hash($password, PASSWORD_DEFAULT);
$password = "Thandizani1234";
$thandizanipwd = password_hash($password, PASSWORD_DEFAULT);
$password = "Paul1234";
$paulpwd = password_hash($password, PASSWORD_DEFAULT);
$password = "John1234";
$johnpwd = password_hash($password, PASSWORD_DEFAULT);
$password = "Jane1234";
$janepwd = password_hash($password, PASSWORD_DEFAULT);
$password = "Admin1234";
$adminpwd = password_hash($password, PASSWORD_DEFAULT);
$password = "QA1234";
$qapwd = password_hash($password, PASSWORD_DEFAULT);


$sql1 = "INSERT INTO user (first_name, last_name, email, user_password, department_id, gender, user_role) 
VALUES ('Joseph', 'Wamulume', 'josephwamulume201196@ideas.com', '$josephpwd', 1, 'other', 'qacoordinator'),
('Kondwani', 'Ngombo', 'kondwaningombo201196@ideas.com', '$kondwanipwd', 2, 'male', 'qacoordinator'),
('Thandizani', 'Zulu', 'thandizulu201196@ideas.com', '$thandizanipwd', 3, 'female', 'qacoordinator'),
('Paul', 'Chibamba', 'paulchibamba201196@ideas.com', '$paulpwd', 4, 'male', 'qacoordinator'),
('John', 'Doe', 'johndoe201196@ideas.com', '$johnpwd', 5, 'male', 'qacoordinator'),
('Jane', 'Doe', 'janedoe201196@ideas.com', '$janepwd', 6, 'female', 'qacoordinator'),
('Admin', 'Admin', 'admin201196@ideas.com', '$adminpwd', 4, 'other', 'admin'),
('QA', 'Manager', 'qamanager201196@ideas.com', '$qapwd', 5, 'other', 'qamanager')";
//Display result if connection is successful
if($conn->query($sql1) === TRUE) { 
echo "Users added successfully | ";
}
//Otherwise, show output error
else {
echo "Error adding users: ".$conn->error;
}

//Insert into User Table

//Insert into Idea Table

$sql1 = "INSERT INTO idea (idea_title, content, category_id, user__id, department_id, post_date, anonymous) 
VALUES ('First Idea', 'This is the first idea', 1, 1, 1, now(), false),
('Second Idea', 'This is the second idea', 2, 2, 2, now(), false),
('Third Idea', 'This is the third idea', 3, 3, 3, now(), false),
('Fourth Idea', 'This is the fourth idea', 4, 4, 4, now(), false),
('Fifth Idea', 'This is the fifth idea', 5, 5, 5, now(), false),
('Sixth Idea', 'This is the sixth idea', 6, 6, 6, now(), false),
('Seventh Idea', 'This is the seventh idea', 1, 7, 1, now(), true),
('Eight Idea', 'This is the eight idea', 2, 8, 2, now(), false)";
//Display result if connection is successful
if($conn->query($sql1) === TRUE) { 
echo "Ideas added successfully | ";
}
//Otherwise, show output error
else {
echo "Error adding ideas: ".$conn->error;
}

//Insert into Idea Table

$conn->close();

?>