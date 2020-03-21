<?php
session_start();
require_once "conn.php";
// class daysBooked{

//     private $datetime1;
//     private $datetime2;

//     function dateTime($date1, $date2){
//         $datetime1 = new DateTime($date1);
//         $datetime2 = new DateTime($date2);
//         $interval= $datetime1->diff($datetime2);
//         $daysBooked= $interval->format('%R%a');
//         return $daysBooked;
//     }
// }

// $daysBookedInstance = new daysBooked();
// $daysBooked = $daysBookedInstance->dateTime($_SESSION['fromdate'], $_SESSION['todate']);
// $_SESSION['daysBooked']=$daysBooked;

$param_username = $_SESSION['username'];
$sql = "SELECT * FROM list WHERE username='$param_username' ORDER BY item_id ASC";
// $result=mysqli_query($conn,$sql);
echo "<div class='row justify-content-center'><ul>";
if ($result=mysqli_query($conn,$sql)){
    // echo "this runs";
    while($row = $result->fetch_row()){
        $datetime1 = new DateTime(date('Y-m-d'));
        $datetime2 = new DateTime($row[5]);
        $interval= $datetime1->diff($datetime2);
        $daysBooked= $interval->format('%R%a');
// echo $daysBooked;
        echo "<li style=\"text-decoration: none;\">" . $row[2] . "<div id=\"duedate\"> Time left: " . $daysBooked . " Days</li>";
    }
}
echo "</ul></div>";
?>
