<?php
require 'view.php';
?>
    <div class="container">
        <div class="row">
            <!-- Product list  -->
            <div class="col-md-3">
                <form action="" method="GET">


                    <div class="card shadow mt-3">
                        <div class="card header">
                            <h5> Filter
                                <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
                            </h5>

                        </div>
                        <div class="card-body">
                            <h6>Product list</h6>
                            <hr>
                            <?php
                            $conn = mysqli_connect("localhost", "root", "root", "product");
                            $product_query = "SELECT * FROM Mahsulot";
                            $product_query_run = mysqli_query($conn, $product_query);

                            if (mysqli_num_rows($product_query_run) > 0) {
                                foreach ($product_query_run as $productlist) {
                                    //  echo $productlist['name'];
                                    $checked = [];
                                    if (isset($_GET['products'])) {
                                        $checked = $_GET['products'];
                                    }
                            ?>
                                    <div>
                                        <input type="checkbox" name="products[]" value="<?= $productlist['id']; ?>" <?php if (in_array($productlist['id'], $checked)) {echo "checked";}  ?> />
                                        <?= $productlist['name']; ?>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "No product";
                            }
                            ?>
                        </div>

                    </div>
                </form>
            </div>
      </div>
    </div>




    <div class="container">
        <div class="row">
            <div class="col-md-3 mt-3">
                <div class="card header">
                    <div style="text-align:center">
                        <h4>Price filter</h4>
                    </div>
                    <div class="card-body">

                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="">Start price</label>
                                    <input type="text" name="start_price" value="<?php if (isset($_GET['start_price'])) {  echo $_GET['start_price'];  } else { echo "1000";} ?>" class="form-control">
                                                                                      
                                </div>
                                <div class="col-md-4">
                                    <label for="">End price</label>
                                    <input type="text" name="end_price" value="<?php if (isset($_GET['end_price'])) { echo $_GET['end_price'];} else {echo "10000";} ?>" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for=""></label> </br>
                                    <button type="submit" class="btn btn-primary px-4">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- 2ta jadval -->
            <div class="col-md-9 mt-3">
                <div class="card">
                    <div style="text-align:center">
                        <h5>Product details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            if (isset($_GET['products'])) {
                                $prodchecked = [];
                                $prodchecked = $_GET['products'];
                                foreach ($prodchecked as $rowprod) {
                                    // echo $rowprod;
                                    $products = "SELECT * FROM Mahsulot WHERE id IN ($rowprod)";
                                    $products_run = mysqli_query($conn, $products);
                                    if (mysqli_num_rows($products_run) > 0) {
                                        foreach ($products_run as $productlist) :
                                        ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="border p-2">
                                                    <h5> <?= $productlist['name']; ?></h5>
                                                    <h6>PRICE: <?= $productlist['price']; ?></h6>
                                                </div>
                                            </div>
                                        <?php
    
                                        endforeach;
                                    }
                                }
                            } 
                                         $conn = mysqli_connect('localhost', 'root', 'root', 'product');

                                        if (isset($_GET['start_price']) && isset($_GET['end_price'])) {
                                            $startprice = $_GET['start_price'];
                                            $endprice = $_GET['end_price'];

                                            $query = "SELECT * FROM Mahsulot WHERE price BETWEEN $startprice AND $endprice";
                                            $query_run = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $productlist) {
                                                     
                                            ?>
                                                    <div class="col-md-4 mb-3">
                                                        <div class="border p-2">
                                                            <h5><?php echo $productlist['name']; ?></h5>
                                                            <h6>PRICE:<?php echo $productlist['price']; ?></h6>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            } else {
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


                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

</body>






</html>


