<?php
$servername = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'product';

$conn = new mysqli($servername, $username, $password, $dbname);







$name = "";
$price = "";

$errorMessage = "";
$succesMessage = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $price = $_POST["price"];

    do {
        if (empty($name) || empty($price)) {
            $errorMessage = "All the fields are required";
            break;
        }


        // add new product to db
        $sql = "INSERT INTO Mahsulot(name,price)" .
            "VALUES ('$name','$price')";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query:" . $conn->error;
            break;
        }



        $name = "";
        $price = "";

        $succesMessage = "Product added correctly";
        header("location: /product/index.php");
        exit;
    } while (false);
}




?>
<?php
require 'view.php';
?>

    <div class="container my-5">
        <h2>New product</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
        <div class='alert -warning alert-dismissible fade show ' role='alert'>
        <strong > $errorMessage </strong>
        <button type='button' clas='btn btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
        }

        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>

            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> Price</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="price" value="<?php echo $price; ?>">
                </div>

            </div>

            <?php

            if (!empty($succesMessage)) {

                echo "
        <div class='alert -warning alert-dismissible fade show ' role='alert'>
        <strong > $succesMessage </strong>
        <button type='button' clas='btn btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/product/index.php" role="button">Cancel</a>
                </div>

            </div>

    </div>
    </form>
    </div>
</body>

</html>