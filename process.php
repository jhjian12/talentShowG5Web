<?php

session_start();

$mysqli = new mysqli('localhost','root','','test') or die(mysqli_error($mysqli));
$name = '';
$quantity = '';
$update = false;
$_SESSION['upd'] = '0';
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    if($name == "" || $quantity == ""){
        print_r("data missing.");
    }else{
        $mysqli -> query("INSERT INTO product (name, quantity) VALUES('$name', '$quantity')") 
        or die($mysqli -> error);
        $_SESSION['message'] = "record has been saved";
        $_SESSION['msg_type'] = "danger";
        header("location:index.php");
    }
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli -> query("DELETE FROM product WHERE id = $id") 
    or die($mysqli -> error);
    $_SESSION['message'] = "record has been deleted";
    $_SESSION['msg_type'] = "danger";
    header("location:index.php");
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli -> query("SELECT * FROM product WHERE id = $id") 
    or die($mysqli -> error);
    if($result != null){
        $row = $result -> fetch_array();
        $name = $row['name'];
        $quantity = $row['quantity'];
    }

    //header("location:index.php");//這邊換頁會出問題
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    print_r($name, $quantity);
    $result = $mysqli -> query("UPDATE product SET name='$name', quantity='$quantity' WHERE id = $id") 
    or die($mysqli -> error);
    $_SESSION['message'] = "record has been updated";
    $_SESSION['msg_type'] = "danger";
    $name = '';
    $quantity = '';
    header("location:index.php");
}
?>