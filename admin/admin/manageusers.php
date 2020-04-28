<?php include "../includes/dbh.inc.php"; ?>
<?php include "includes/header.php"; ?>
<div id="wrapper">
        <!-- Navigation -->
 <?php include "includes/navigation.php"; ?>  
 <div id="page-wrapper">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Manage Users
                <small>Users</small>
            </h1>     
                               
<?php 
    if(isset($_GET['source'])){
        $source = $_GET['source'];
        
    }else{
        $source = '';
    }
        
        switch($source){
                case '24';
                echo "";
                break;
                
                case '26';
                echo "";
                break;
                
                case '98';
                echo "";
                break;
                
            default:
                include "includes/display_users.php";
                break;
        }
    
?>
                       
       

<?php include "includes/footer.php"; ?>