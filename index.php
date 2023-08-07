<?php
require 'view.php';
?>
    <div class="container my-5">
        <h2>List of products</h2>
        <a class="btn btn-primary" href="/product/create.php" role="button">New product</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>



            </thead>
            <tbody>
                <?php
                $servername = 'localhost';
                $username = 'root';
                $password = 'root';
                $dbname = 'product';
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed:" . $conn->connect_error);
                }
                $sql = "SELECT * FROM Mahsulot";
                $result = $conn->query($sql);

                if (!$result) {
                    die("Invalid query:" . $conn->error);
                }

                $rows = $result->fetch_all(MYSQLI_ASSOC);

                ?>

                <?php foreach ($rows as $key => $row) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['price'] ?></td>
                        <td>
                            <a class='btn btn-primary btn-sm' href="/product/edit.php?id=<?= $row['id'] ?>">Edit</a>
                            <a class='btn btn-primary btn-sm' href="/product/delete.php?id=<?= $row['id'] ?>">Delete</a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

</body>






</html>