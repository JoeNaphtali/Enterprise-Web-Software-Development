<div class="col-md-4">

    <!-- Search Widget -->
    

    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <form action="search.php" method="post">
        <div class="card-body">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." name="search">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit" name="submit">Go!</button>
                </span>
            </div>
        </div>
        </form>
    </div>

    <!-- Search Widget -->

    <!-- Categories Widget -->

    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <?php
                // Select all the categories from the 'category' table
                $query = "SELECT * FROM category";
                $select_all_query = mysqli_query($conn, $query);                       
                while($row = mysqli_fetch_assoc($select_all_query)){
                $category_name = $row['category_name'];
                $category_id = $row['id'];               
            ?>
            <a href="category.php?c_id=<?php echo $category_id; ?>"> | <?php echo $category_name ?></a>
            <?php } ?>
        </div>
    </div>

    <!-- Categories Widget -->

    <!-- Popular Ideas Widget -->

    <div class="card my-4">
        <h5 class="card-header">Popular Ideas</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="index.php">Latest Ideas</a>
                        </li>
                        <li>
                            <a href="#">Most Viewed</a>
                        </li>
                        <li>
                            <a href="#">Recent Activity</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#">Most Upvotes</a>
                        </li>
                        <li>
                            <a href="#">Most Comments</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Ideas Widget -->

</div>