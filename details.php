<?php 
include("config.php");
session_start();

if(isset($_POST['save_de']))
{
    $ag = mysqli_real_escape_string($db, $_POST['age']);
    $do = mysqli_real_escape_string($db, $_POST['dob']);
    $con = mysqli_real_escape_string($db, $_POST['contact']);
    $as=$_SESSION['login_user'];
    $query = "UPDATE user set age='$ag', dob='$do', contact='$con' where mail='$as'" ;
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }   
}

?>
