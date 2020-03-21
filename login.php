<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body style="overflow: hidden; ">
<div style="width: 60%;" class="container ">
<h1 style="align-contetn: center;">Welcome to your personal To-Do-List</h1>
<blockquote class="blockquote">
  <p class="mb-0">Please login below.</p>
</blockquote>
<form class="form-inline" action="login.php" method="post"> 
    <label class="sr-only" for="inlineFormInputName2">Enter Username</label>
    <input  class="form-control mb-2 mr-sm-2" type="text" name="username" placeholder="Enter your username">
    <label class="sr-only" for="">Enter Password</label>
    <input class="form-control mb-2 mr-sm-2" type="password" name="password" placeholder="enter passwoord">
    <button type="submit"  value="submit" name="submit"class="btn btn-primary mb-2">Login</button>
</form>





<?php
require_once "conn.php";

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    header("location: todo.php");
    exit;
}

if($_POST){
    if(empty(trim($_POST['username']))){
        $username_err = "Please enter your username";
        echo $username_err;
    }
    elseif(empty(trim($_POST['password']))){
        $password_err ="Please enter your password";
        echo mysqli_error($conn);
    }
    else{
        $username = trim($_POST['username']);
        $password=trim($_POST['password']);
        // echo $password;
        // echo $username;
    

    $sql= "SELECT id, username, password FROM users WHERE username =?";

    if($stmt = $conn->prepare($sql)){
        // $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $param_username);
        $param_username = $username;
        // echo "line 51 is running";
        if($stmt->execute()){
            // echo "line 53 running";
            $stmt->store_result();
            if($stmt->num_rows ==1){
                // echo"line 56 running";
                $stmt->bind_result($id, $username, $hashed_password);
                if($stmt->fetch()){
                    if(password_verify($password,$hashed_password)){
                        session_start();
                        $_SESSION["loggedin"] =true;
                        $_SESSION["id"]= $id;
                        $_SESSION["username"] = $username;
                        header("location: todo.php");
                        exit;
                    }
                    else{
                        $password_err="The password you entered is invalid";
                        echo $password_err;
                    }       
                }
            }else{
            echo "Sorry your Username or Password are incorrect.";
            }
        }
    }
}
}



?>
<br>
<br>
<blockquote class="blockquote">
 
<a href="index.php">
<p class="mb-0">Not registered yet? Click here to register.</p>
</a>
</blockquote>
<img class="img-fluid" src="todo2.png" alt="">
</div>

</body>
</html>