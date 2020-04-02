<div class="col-md-4">

    <!-- Search Widget -->

    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." name="">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Go!</button>
                </span>
            </div>
        </div>
    </div>

    <!-- Search Widget -->

    <!-- Categories Widget -->

    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">

                        <?php 
                        $query = "SELECT * FROM category";
                        $select_all_query = mysqli_query($conn, $query);
                        
                         while($row = mysqli_fetch_assoc($select_all_query)){
                            $category_name = $row['category_name'];
                            echo "<li><a href='#'>{$category_name}</a></li>";
                         }                      
                        ?>


                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">

                        <!-- Todo-->
                        <li>
                            <a href="#">Category</a>
                        </li>
                        <li>
                            <a href="#">Category</a>
                        </li>
                        <li>
                            <a href="#">Category</a>
                        </li>
                        <!-- /.Todo-->

                    </ul>
                </div>
            </div>
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
                            <a href="#">Latest Ideas</a>
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