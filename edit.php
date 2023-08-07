<?php

$servername = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'product';
$conn = new mysqli($servername, $username, $password, $dbname);

$id = "";
$name = "";
$price = "";

$errorMessage = "";
$succesMessage = "";

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    if (!isset($_GET['id'])) {
        header("location: /product/index.php");
        exit;
    }



    $sql = "SELECT * FROM Mahsulot WHERE id=$id";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();



    if (!$row) {
        header("location:/product/index.php");
        exit;
    }
    $name = $row["name"];
    $price = $row["price"];
} else {
    $name = $_POST["name"];
    $price = $_POST["price"];

    do {
        if (empty($name) || empty($price)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE Mahsulot SET price = $price, name = '$name' WHERE id=$id";

        $result = $conn->query($sql);
        if (!$result) {
            $errorMessage = "Invalid query:" . $conn->error;
            break;
        }
        $succesMessage = "Product updated correctly";
        header("location:/product/index.php");
        exit;
    } while (true);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
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
            <input type="hidden" value="<?php echo $id; ?>">
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