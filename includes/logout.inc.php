<?php

session_start();
session_unset();
session_destroy();

// Return user to login page
header("Location: ../login.php");