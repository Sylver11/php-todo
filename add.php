
<?php
session_start();
require_once "conn.php";

$sql2 ="CREATE TABLE list(
    id int NOT NULL AUTO_INCREMENT,
    username VARCHAR(120),
    items VARCHAR(255),
    complete int NOT NULL DEFAULT 0,
    item_id int NOT NULL DEFAULT 0,
    duedate VARCHAR(60))";

//passing the query to the established connection 
$conn->query($sql2);



if(empty(trim($_POST["val"]))){
    $username_err = "Please enter something you need to do.";
    echo $username_err;
} else {
    $date= trim($_POST["duedate"]);
    $todo = trim($_POST["val"]);
    $sql ="INSERT INTO list (username, items, duedate) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $param_username, $param_todo, $param_date);
    $param_date=$date;
    $param_todo=$todo;
    $param_username = $_SESSION['username'];
    $stmt->execute();
}   
?>