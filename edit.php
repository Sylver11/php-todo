<?php
session_start();
require_once "conn.php";
$editnum =trim($_POST["editnum"]);
$edit = trim($_POST["edit"]);
$param_username=$_SESSION["username"];
$param_edit = $edit;
$param_editnum=$editnum;
$sql = "UPDATE list SET items ='$param_edit' WHERE item_id='$param_editnum' AND username='$param_username'";
$result = mysqli_query($conn, $sql);
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("sss", $param_username, $param_edit, $param_editnum);

// $stmt->execute();

// $result = mysqli_query($conn, $sql);


//     if()){
//         $row = $result->fetch_row();
        
//     }


//     $date= trim($_POST["duedate"]);
//     $todo = trim($_POST["val"]);
//     // $_SESSION['username'];
//     // $username=$_SESSION['username'];
//     $sql ="INSERT INTO list (username, items, duedate) VALUES (?,?,?)";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("sss", $param_username, $param_todo, $param_date);
//     $param_date=$date;
//     $param_todo=$todo;
//     $param_username = $_SESSION['username'];
//     // $param_username=$username;
//     $stmt->execute();

// echo json_encode($done);
?>