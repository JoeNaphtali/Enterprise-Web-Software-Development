<?php include "includes/header.php"; ?>
<?php include "../includes/dbh.inc.php"; ?>
    <div id="wrapper">
        
        

        <!-- Navigation -->
 <?php include "includes/navigation.php"; ?>       
            
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Reports
                            <small>Statistical and Exceptional</small>
                        </h1>
                       

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
                                      
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
                include "includes/display_reports.php";
                break;
        }
    
?>
                       

    <?php include "includes/footer.php"; ?>