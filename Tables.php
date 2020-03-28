<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to create tables
$sql_department = "CREATE TABLE `department` (
    dep_id INT(10) NOT NULL AUTO_INCREMENT,
    department_name VARCHAR(30) NOT NULL,
    PRIMARY KEY(dep_id)
    )";
if (mysqli_query($conn, $sql_department)) {
    echo "Table department successfully created";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
$sql_role = "CREATE TABLE `role` (
    role_id INT(10) NOT NULL AUTO_INCREMENT,
    role_name VARCHAR(30) NOT NULL,
    description VARCHAR(30) NOT NULL,
    PRIMARY KEY(role_id)
    )";
    if (mysqli_query($conn, $sql_role)) {
        echo "Table role successfully created";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
$sql_user = "CREATE TABLE `user` (
    user_id INT(10) NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    dep_id VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    role_id VARCHAR(6) NOT NULL,
    PRIMARY KEY(user_id),
    FOREIGN KEY(dep_id) references department,
    FOREIGN KEY(role_id) references role
    )";
    if (mysqli_query($conn, $sql_user)) {
        echo "Table user successfully created";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
$sql_idea= "CREATE TABLE `idea` (
    idea_id INT(10) NOT NULL AUTO_INCREMENT,
    user_id VARCHAR(6) NOT NULL,
    email VARCHAR(50) NOT NULL,
    time_posted TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(idea_id),
    FOREIGN KEY(user_id) references user
    )";  
    if (mysqli_query($conn, $sql_idea)) {
        echo "Table idea successfully created";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }         
$sql_comment = "CREATE TABLE `comment` (
comment_id INT(10) NOT NULL AUTO_INCREMENT,
idea_id VARCHAR(6) NOT NULL,
user_id VARCHAR(6) NOT NULL,
time_posted TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY(comment_id),
FOREIGN KEY(idea_id) references idea,
FOREIGN KEY(user_id) references user
)";
if (mysqli_query($conn, $sql_comment)) {
    echo "Table comment successfully created";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>