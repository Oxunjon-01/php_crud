<?php
require 'view.php';
?>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card mt-5">
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="id" value="<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <?php
                                    $conn=mysqli_connect('localhost','root','root','product');
                                    if(isset($_GET['id']))
                                    {
                                        $id=$_GET['id'];
                                        $query= "SELECT * FROM Mahsulot WHERE id='$id' ";
                                        $query_run=mysqli_query($conn,$query);
                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row){
                                            //    
                                              ?>
                                                <div class="form-group mb-3">
                                                    <label for="">Name</label>
                                                    <input type="text" value="<?php echo $row['name']; ?>" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">Price</label>
                                                    <input type="number" value="<?php echo $row['price'];?>" class="form-control">
                                                </div>
                                              <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "No record found";
                                        }
                                    }
                                    
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

</body>

</html>