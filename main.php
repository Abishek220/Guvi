<?php
    include("config.php");
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" style="color: white;" href="https://www.guvi.in/">
                <img src="https://images.g2crowd.com/uploads/product/image/large_detail/large_detail_b2b52bf26a769b861fae19c5f65643cf/guvi.png" alt="" width="32" height="29" class="d-inline-block align-text-top">
                Guvi
            </a>
            <div class="profile-details">
    <p id="profileNameDisplay"></p>
    <p id="profileEmailDisplay"></p>
</div>

            <ul class="nav justify-content-end">
                <ul class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" data-bs-target="#profileModal" aria-expanded="false"  style="color: grey;">
            Profile
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li class="nav-item">
                    <a class="dropdown-item" aria-current="page" href="#" style="color: black;"  data-bs-toggle="modal" data-bs-target="#profileModal">Update Profile</a>
                </li>
            <li><a class="dropdown-item" href="get_profile.php">Show My Profile</a></li>
          </ul>
        </li>
      </ul>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.guvi.in/courses/" style="color: grey;">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php" style="color: grey;">Log out</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Update your Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
               <div class="modal-body">
    <form id="de" class="">
        <div class="mb-3">
            <label for="age" class="form-label">Age:</label>
            <input type="text" class="form-control" id="age" name="age" required>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob" required>
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Contact:</label>
            <input type="text" class="form-control" id="contact" name="contact" required>
        </div>
</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save changes</button>
                </div>
            </form>
            </div>
            <div id="successMessage" class="alert alert-success d-none" role="alert">
    Details Updated Successfully
</div>
        </div>
    </div>


    
    
            <div class="bg p-4">
                <div class="bg p-4">
                    <h1 style="text-align:center">WELCOME</h1>
                </div>
            </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



    <script>

        $(document).on('submit', '#de', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_de", true);

            $.ajax({
                type: "POST",
                url: "details.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        // ... your existing code for error handling ...
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);
                    } else if (res.status == 200) {
                        $('#errorMessage').addClass('d-none');
                        $('#de')[0].reset();

                        $('#successMessage').removeClass('d-none'); // Show success message
                        setTimeout(function() {
                            $('#successMessage').addClass('d-none'); // Hide success message after a few seconds
                        }, 3000);
                    } else if (res.status == 500) {
                        // ... your existing code for error handling ...
                        $('#errorMessage').addClass('d-none');
                        $('#reg')[0].reset();
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });
        });
    </script>


                <footer class="bg-light p-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <img src="https://images.g2crowd.com/uploads/product/image/large_detail/large_detail_b2b52bf26a769b861fae19c5f65643cf/guvi.png" alt="Guvi Logo" width="100" class="mx-auto d-block mb-3">
                    <h3 class="text-center">About Guvi</h3>
                    <p>Guvi is an online learning platform that offers a wide range of courses in programming, technology, and more. With interactive learning materials, hands-on projects, and expert instructors, Guvi provides a dynamic learning experience for individuals looking to enhance their skills.</p>
                    <p>Whether you're a beginner or an experienced professional, Guvi's courses cater to various skill levels. Join our community today to embark on a journey of continuous learning and skill development!</p>
                    <a href="https://www.guvi.in/" class="btn btn-primary btn-block mt-3">Learn More</a>
                </div>
            </div>
        </div>
    </footer>

    </body>
</html>


