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
    department_name VARCHAR(255) NOT NULL PRIMARY KEY
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

//Insert into Department Table

$sql1 = "INSERT INTO department (department_name) VALUES ('accounts'), ('finance'), ('examinations')";
//Display result if connection is successful
if($conn->query($sql1) === TRUE) { 
echo "Departments added successfully | ";
}
//Otherwise, show output error
else {
echo "Error adding departments: ".$conn->error;
}

//Insert into Department Table

//Create User Table

$sql1 = "CREATE TABLE user(
    id INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    gender VARCHAR(6) NOT NULL,
    user_role VARCHAR(50) NOT NULL
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
    category_name VARCHAR(255) NOT NULL PRIMARY KEY
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
    category VARCHAR(255) NOT NULL,
    idea_title VARCHAR(255) NOT NULL,
    user__id INT(3) NOT NULL,
    post_user VARCHAR(255) NOT NULL,
    post_date DATE NOT NULL,
    attachment BLOB,
    content TEXT NOT NULL,
    tags VARCHAR(255) NOT NULL,
    comment_count int(11) NOT NULL,
    view_count int(11) NOT NULL,
    upvote_count int(11) NOT NULL,
    downvote_count int(11) NOT NULL,
    FOREIGN KEY (user__id) REFERENCES user(id),
    FOREIGN KEY (category) REFERENCES category(category_name)
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

//Create Comment Table

$sql1 = "CREATE TABLE comment(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idea_id INT(3) NOT NULL,
    user__id INT(3) NOT NULL,
    content TEXT NOT NULL,
    comment_date DATE NOT NULL,
    FOREIGN KEY (idea_id) REFERENCES idea(id),
    FOREIGN KEY (user__id) REFERENCES user(id)
    )";
//Display result if connection is successful
if($conn->query($sql1) === TRUE) { 
echo "Comment table created successfully";
}
//Otherwise, show output error
else {
echo "Error creating comment table: ".$conn->error;
}

//Create Comment Table

$conn->close();

?>