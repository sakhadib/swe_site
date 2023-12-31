<?php
    require_once "../connection.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $uname = $_POST['username'];
        $pass = $_POST['password'];

        $sql = "SELECT name, batch, password FROM `shuser` WHERE `username` = '$uname'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($pass, $row['password'])) {
                session_start();
                $_SESSION['username'] = $uname;
                $_SESSION['name'] = $row['name'];
                $_SESSION['batch'] = $row['batch'];
                header("Location: ../input/");
            } else {
                echo "Wrong password";
            }
        } else {
            echo "No user found";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
                    <h1 class="text-center">login</h1>
                    <form action="../login/" method="post">
                        <div class="form-floating mb-3 mt-4">
                            <input type="text" class="form-control" id="floatingInput" name = "username" placeholder="name@example.com">
                            <label for="floatingInput">username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" name = "password" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <button type="submit" class="btn btn-danger mt-4" style="width: 100%;">login</button>
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