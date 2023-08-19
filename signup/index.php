<?php
// Check if the form has been submitted
    $error = "no error";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once "../connection.php";
        // Retrieve form data using $_POST
        $name = $_POST['name'];
        $uname = $_POST['username'];
        $batch = $_POST['batch']; 
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $confirmPassword = $_POST['repass'];

        $ucheck = "SELECT name FROM `shuser` WHERE `username` = '$uname'";
        $result = $conn->query($ucheck);
        if ($result->num_rows > 0) {
            $error = "Username already exists";
        }
        else{
            if ($pass != $confirmPassword) {
                $error = "Passwords do not match";
            } 
            else {
                // Prepare an insert statement
                $sql = "INSERT INTO `shuser` (`name`, `username`, `batch`, `email`, `password`) VALUES (?, ?, ?, ?, ?)";
    
                if ($stmt = $conn->prepare($sql)) {
                    // Bind variables to the prepared statement as parameters
                    $stmt->bind_param("sssss", $param_name, $param_username, $param_batch, $param_email, $param_password);
    
                    // Set parameters
                    $param_name = $name;
                    $param_username = $uname;
                    $param_batch = $batch;
                    $param_email = $email;
                    $param_password = password_hash($pass, PASSWORD_DEFAULT); // Creates a password hash
                    
    
                    // Attempt to execute the prepared statement
                    if ($stmt->execute()) {
                        // Redirect to login page
                        $error = "Account created successfully <a href='../login/'>Login</a>";
                    } else {
                        $error = "Something went wrong. Please try again later.";
                    }
                }
    
                // Close statement
                $stmt->close();
            }
        }
        
        
    }

    $currentYear = date('Y'); // Get current year
    $lastTwoDigits = substr($currentYear, -2); // Extract last two digits
    $options = "";
    for($i = $lastTwoDigits-4; $i <= $lastTwoDigits; $i++){
        $options .= '<option value="'.$i.'">Batch '.$i.'</option>';
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- Style -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../style.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <div class="sh-login-sec">
        <div class="container">
            <div class="row">
                <div class="col-10 col-lg-4 offset-lg-4 offset-1">
                    <h1 class="text-center">sign up</h1>
                    
                        <?php 
                            if($error != "no error")
                            {
                                echo '<div class="alert alert-info mt-3 mb-3" role="alert">'.$error.'</div>';
                            }
                        ?>
                    <form action="../signup/" method="post">
                        <div class="form-floating mt-4">
                            <input type="text" class="form-control" id="floatingInput" name="name" placeholder="name@example.com" required>
                            <label for="floatingInput">Name</label>
                        </div>
                        <div class="form-floating mt-4">
                            <input type="text" class="form-control" id="floatingInput" name="username" placeholder="name@example.com" required>
                            <label for="floatingInput">username</label>
                        </div>
                        <select class="form-select mt-4" aria-label="Default select example" name="batch" required>
                            <option selected disabled>Batch</option>
                            <?php echo $options; ?>
                        </select>
                        <div class="form-floating mt-4">
                            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mt-4">
                            <input type="password" class="form-control" id="floatingPassword" name="pass" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-floating mt-4">
                            <input type="password" class="form-control" id="floatingPassword" name = "repass" placeholder="Password" required>
                            <label for="floatingPassword">Confirm Password</label>
                        </div>
                        <button type="submit" class="btn btn-danger mt-4" style="width: 100%;">signup</button>
                    </form>
                    <div class="back-link text-center mt-3">
                        <a href="../">Back to home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- footer -->
    <div class="container-fluid mt-4 sh-footer">
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                <a href="https://sakhawatadib.com" class="link-danger" style="font-size: 25px;"><i class="uil uil-copyright"></i>Adib Sakhawat <span id="yr"></span></a>
                <ul class="list-unstyled foot-list">
                    <li><a href="https://github.com/sakhadib" class="link-success">github</a></li>
                    <li><i class="uil uil-stop-circle"></i></li>
                    <li><a href="https://facebook.com/adib.sakhawat" class="link-success">facebook</a></li>
                    <li><i class="uil uil-stop-circle"></i></li>
                    <li><a href="mailto:adibsakhawat@iut-dhaka.edu" class="link-success">email</a></li>
                    <li><i class="uil uil-stop-circle"></i></li>
                    <li><a href="https://portfolio.sakhawatadib.com" class="link-success">portfolio</a></li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Get the current year
        var currentYear = new Date().getFullYear();

        // Find the element with the ID "yr"
        var yearSpan = document.getElementById("yr");

        // Set the content of the span to the current year
        yearSpan.textContent = currentYear;
    </script>
</body>
</html>