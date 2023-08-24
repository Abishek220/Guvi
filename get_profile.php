<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
</head>
<body>
    <nav class="navbar navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" style="color: white;" href="https://www.guvi.in/">
                <img src="https://images.g2crowd.com/uploads/product/image/large_detail/large_detail_b2b52bf26a769b861fae19c5f65643cf/guvi.png" alt="" width="32" height="29" class="d-inline-block align-text-top">
                Guvi
            </a>
        
            <ul class="nav justify-content-end">
           <li class="nav-item">
                    <a class="nav-link" href="main.php" style="color: grey;">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.guvi.in/courses/" style="color: grey;">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php" style="color: grey;">Log out</a>
                </li>
            </ul>
        </div>
    </nav>
</body>
    </html>
    <?php
include("config.php");
session_start();

if(isset($_SESSION['login_user'])) {
    $as = $_SESSION['login_user'];
    $query = "SELECT nam, mail, age, dob, contact FROM user WHERE mail='$as'";
    $result = mysqli_query($db, $query);

    
    if($row = mysqli_fetch_assoc($result)) {
        $profileDetails = '
        <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <h3 style="text-align:center">Your Profile</h3>
                <form id="profileForm">
                    <div class="mb-3">
                        <label for="profileName" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="profileName" value="' . $row['nam'] . '" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="profileEmail" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="profileEmail" value="' . $row['mail'] . '" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="profileAge" class="form-label">Age:</label>
                        <input type="text" class="form-control" id="profileAge" value="' . $row['age'] . '" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="profileDob" class="form-label">Date of Birth:</label>
                        <input type="text" class="form-control" id="profileDob" value="' . $row['dob'] . '" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="profileContact" class="form-label">Contact:</label>
                        <input type="text" class="form-control" id="profileContact" value="' . $row['contact'] . '" disabled>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Edit</button>
                    <a class="btn btn-primary" href="main.php" style="color: white">Done</a>
                </div>
                </form>
            </div>
    </div>
        ';
        echo $profileDetails;
    } else {
        echo "Profile details not found.";
    }
}
?>
 