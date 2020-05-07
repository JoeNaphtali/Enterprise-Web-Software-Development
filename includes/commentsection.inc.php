                    <!-- Comments Form -->
                    <div class="card my-4">
						<h5 class="card-header">Leave a Comment:</h5>
							<div class="card-body">
								<form action="includes/addcomment.inc.php" method="post">
									<div class="form-group">
                                    <input type="hidden" name="author_id" value="<?php echo $user_id; ?>">
                                    <input type="hidden" name="id" value="<?php echo $idea_id; ?>">
                                    <input type="hidden" name="idea_title" value="<?php echo $idea_title; ?>">
										<textarea class="form-control" name="comment_content" rows="3" required></textarea>
                                    </div>
                                    <div class="custom-control custom-checkbox form-group">
                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="anonymous">
                                        <label class="custom-control-label" for="customCheck">Comment anonymously?</label>
                                    </div>
									<button type="submit" name="submit_comment" class="btn btn-primary">Submit</button>
								</form>
							</div>
                    </div>
                    <!-- /.Comments Form -->

					
					<?php
                    $idea_id = $_GET['i_id'];

                    $query = "SELECT * FROM comment WHERE idea_id = $idea_id ";
                    $query .= "ORDER BY id DESC ";

                    $results = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($results)) { 
                    $comment_content = $row['content'];
                    $comment_user_id = $row['user__id'];
                    $anonymous = $row['anonymous'];

                    $time = new DateTime($row['comment_date']);
                    $date = $time->format('F jS');
                    $time = $time->format('H:i');

                    $query = "SELECT * FROM user WHERE id = $comment_user_id";
                    $select_user_id  = mysqli_query($conn, $query);
                    
                    //Getting User Name
                    while($row = mysqli_fetch_assoc($select_user_id)){
                    $user_id_new = $row['id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];

                    if ($anonymous == true) {
                        $user_name = "Anonymous";
                    }
                    else {
                        $user_name = $first_name . " " . $last_name;
                    }

                    }           
                    ?>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5><?php echo $user_name ?></h5>
                            <p><i class="far fa-clock"></i> On <?php echo $date ?> at <?php echo $time ?></p>
                            <p class="card-text"><?php echo $comment_content ?></p>
                        </div>
                    </div>
                    
                    <?php } ?>