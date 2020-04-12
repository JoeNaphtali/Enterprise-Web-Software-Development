                    <?php 

					if(isset($_GET['i_id'])){

						$idea_id = $_GET['i_id'];

					}

					$results = mysqli_query($conn, "SELECT * FROM idea WHERE id=$idea_id");

					while ($row = mysqli_fetch_array($results)) { 
						
					?>

                    <!-- Title -->
                    
                    <h1 class="mt-4"><?php echo $row['idea_title']; ?></h1>

                    <!-- /.Title -->

                    <!-- Author -->
                    
					<p class="lead">
                    Proposed by
                    <?php                   
                    $user_id = $row['user__id'];
                    // Retrieve user from 'user' table
                    $user_result = mysqli_query($conn, "SELECT * FROM user WHERE id=$user_id");
                    while ($row2 = mysqli_fetch_array($user_result)) {                    
                    ?>
					<a href="#">
                        <?php 
                        // Concatenate user firstname and lastname into 'author' variable and display author name
                        $author = $row2['first_name'] . ' ' . $row2['last_name'];
                        echo $author;
                        ?>
                    </a>
                    </p>
                    <!-- Closing While loop -->
                    <?php } ?>

                    <!-- /.Author -->

                    <!-- Category -->

                    <p>
                    <?php                   
                    $category_id = $row['category_id'];
                    // Retrieve catergory name from 'category' table
                    $category_result = mysqli_query($conn, "SELECT * FROM category WHERE id=$category_id");
                    while ($row1 = mysqli_fetch_array($category_result)) {                    
                    ?>
					Category:
					<a href="#"><?php echo $row1['category_name']; ?></a>
                    </p>
                    <!-- Closing While loop -->
                    <?php } ?>
                    
                    <!-- /.Category -->

                    <!-- Date -->
                    
                    <p>On <?php echo $row['post_date']; ?> </p>
                    
                    <!-- /.Date -->

		            <hr>

                    <!-- Idea Content -->
                    
                    <?php echo $row['content']; ?>

                    <!-- /.Idea Content -->

					<!-- Closing While loop -->
					<?php } ?>