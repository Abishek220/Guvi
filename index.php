
<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $myusername = mysqli_real_escape_string($db,$_POST['mail']);
    $mypassword = mysqli_real_escape_string($db,$_POST['pass']); 
    
    $sql = "SELECT * FROM user WHERE mail = '$myusername' and pass = '$mypassword'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    
  
    if($count == 1) {
  $_SESSION['loggedin'] = TRUE;
      $_SESSION['login_user'] = $myusername;
      
echo "<script>alert('Login Successful');window.location.href='main.php';</script>";


}
  else
  {
      echo "<script>alert('Your Login E-mail or Password is invalid');window.location.href='index.php';</script>";
  exit();
    }
}
?>

<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
    <link rel="stylesheet" href="sheet.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
</head>
<body>
<div class="g" style="margin-left: 20px; margin-top: 20px; display: flex; font-size: 50px; color:green; margin-top: 20px;">
<img src="https://images.g2crowd.com/uploads/product/image/large_detail/large_detail_b2b52bf26a769b861fae19c5f65643cf/guvi.png" alt="Logo" style="width: 70px; height:70px; margin-right: 10px;">
        Guvi
    </div>
<div class="container">
    <div class="row">
    <div class="col">
    <center>
        <h3 id="formTitle">Login</h3>
    </center>
    <form id="authForm" method="post" action="index.php" class="form-container">
                <div class="mb-3">
                 <label for="exampleFormControlInput1" class="form-label">Email address</label>
                 <input type="email" name="mail" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required="">
                </div>
                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" id="exampleFormControlInput1"  required="">
                </div>
                <input type="submit" class="btn btn-outline-secondary" name="login" id="loginButton" value="Login">
            </form>
            <form id="reg" style="display: none;" class="form-container">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="name" name="nam" class="form-control" id="exampleFormControlInput1" placeholder="Enter your Name" required="">
                  </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input type="email" name="mail" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required="">
                  </div>
                  <div class="mb-3">  
                    <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                    <input type="password"  name="pass" class="form-control" id="exampleFormControlInput1"  required="">
                  </div>
                  <input type="submit" class="btn btn-outline-success" id="registerButton" value="Register">
    </form>
    <p id="toggleFormText">New to Guvi? <a href="#" id="toggleFormLink">Register</a></p>
</div>
    </div>
    <div class="col">
            <div id="successMessage" class="text-success d-none">Registered Successfully</div>
        </div>
</div>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
$(document).on('submit', '#reg', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("save_reg", true);

    $.ajax({
        type: "POST",
        url: "insert.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
              $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

            }
            else if(res.status == 200){
                $('#errorMessage').addClass('d-none');
                $('#reg')[0].reset();
                
                $('#successMessage').removeClass('d-none'); 
                setTimeout(function() {
                    $('#successMessage').addClass('d-none'); 
                }, 3000);
            }
            else if(res.status == 500) {
              $('#errorMessage').addClass('d-none');
                        $('#reg')[0].reset();
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
            }
        }
    });

});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        // Use event delegation to handle the click event for the link
        $(document).on('click', '#toggleFormLink', function (e) {
            e.preventDefault();
            $("#authForm, #reg").toggle();
            $("#formTitle").text($("#formTitle").text() === "Login" ? "Register" : "Login");
            
            // Update the text of the link using text()
            if ($("#formTitle").text() === "Login") {
                $("#toggleFormText").html("New to Guvi? <a href='#' id='toggleFormLink'>Register</a>");
            } else {
                $("#toggleFormText").html("Already have an account? <a href='#' id='toggleFormLink'>Login</a>");
            }
        });
    });
</script>

</body>
</html>
