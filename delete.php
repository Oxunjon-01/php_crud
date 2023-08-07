<?php

   $servername='localhost';
   $username='root';
   $password='root';
   $dbname='product';

   $conn=new mysqli($servername,$username,$password,$dbname);

   

   $id=$_GET["id"];
   $sql="DELETE FROM Mahsulot WHERE id = $id";
   $result=mysqli_query($conn,$sql);
   if($result){
      header("Location: index.php?msg=Record deleted succesfully ");

   }
   else{
      echo "Failed:" . mysqli_error($conn);
   }
