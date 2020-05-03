                    <!-- Comments Form -->
                    <div class="card my-4">
						<h5 class="card-header">Leave a Comment:</h5>
							<div class="card-body">
								<form action="includes/addcomment.inc.php" method="post">
									<div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $idea_id; ?>">
										<textarea class="form-control" name="comment_content" rows="3"></textarea>
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

                    $query = "SELECT * FROM user WHERE id = $comment_user_id";
                    $select_user_id  = mysqli_query($conn, $query);
                    
                    //Getting User Name
                    while($row = mysqli_fetch_assoc($select_user_id)){
                    $user_id_new = $row['id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];

                    $user_name = $first_name . " " . $last_name;
                    }           
                    ?>

                    <!-- Comment -->
					<div class="media mb-4">
						<img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
						<div class="media-body">
							<h5 class="mt-0">
                                <?php 
                                if ($anonymous == true) {
                                    echo "Anonymous";
                                }
                                else {
                                    echo $user_name;
                                }
                                ?>
                            </h5>
							<?php echo $comment_content; ?>
						</div>
                    </div>
                    <!-- /.Comment -->
                    
                    <?php } ?>