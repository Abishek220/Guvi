<?php 
include("config.php");
if(isset($_POST['save_reg']))
{
    $namee = mysqli_real_escape_string($db, $_POST['nam']);
    $name = mysqli_real_escape_string($db, $_POST['mail']);
    $pass = mysqli_real_escape_string($db, $_POST['pass']);
    
    if($name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    
    $query = "INSERT INTO user (nam,mail,pass) VALUES('$namee','$name','$pass')";
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
