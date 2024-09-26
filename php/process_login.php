<?php
session_start();
include 'C:\xampp\htdocs\php\db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'C:\xampp\htdocs\php\db.php';
   // require_once 'C:\xampp\htdocs\php\amin\article.php';
   // require_once 'C:\xampp\htdocs\php\amin\author.php';
   //require_once 'C:\xampp\htdocs\php\amin\category.php';

    $username = $_POST['username'];
    $password = $_POST['password'];


    // Truy vấn để tìm user theo username
     
    $sql = "SELECT * FROM user WHERE username = ?";
    $temp = $conn->prepare($sql);
    $temp->bind_param("s", $username);
    $temp->execute();
    $result = $temp->get_result();
    
    if ($result->num_rows > 0) {
        $users = $result->fetch_assoc();        
        if ($password == $users['password']) {
            header("Location: \php\amin\index.php"); 
            exit();
        } else {
            $error = "Sai mật khẩu!";
        }
    } else {
        $error = "Không tìm thấy người dùng!";
    }

    $temp->close();
}
?>