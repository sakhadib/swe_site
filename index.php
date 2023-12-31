<?php
    // Include the database connection file
    require_once('connection.php');
    $element = '';
    $sql = "SELECT DISTINCT batch FROM `shuser` ORDER BY `batch` ASC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $batch = $row['batch'];
        $element .= '<div class="col-lg-6 col-10 offset-lg-0 offset-1 mt-3">
                        <div class="sh-batch mt-2">
                            <p>SWE '. $batch .'</p>
                            <a href="table/?b='.$batch.'" class="mt-3">Go to files</a>
                        </div>
                    </div>';
    }

    //closing the connection
    $conn->close()


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUT SWE Files</title>

    <!-- Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- NavBAR -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">IUT SWE Files</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="library/">All file Library</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about/">About</a>
                </li>
                </ul>
                <ul class="navbar-nav me-0 mb-2 mb-lg-0">
                    <?php
                        session_start();
                        if(isset($_SESSION['name'])){
                            echo '<li class="nav-item">
                                <a class="nav-link" href="input/">input</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout/">logout</a>
                            </li>';
                        }
                        else{
                            echo '<li class="nav-item">
                                <a class="nav-link" href="signup/">Signup</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login/">Login</a>
                            </li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header End -->

    <!-- Hero -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 sh-hero">
                <p class="sh-hero-txt">
                    IUT SWE FILES
                </p>
            </div>
        </div>
    </div>
    <!-- Hero -->
    


    <!-- Main Section -->
    <div class="container mt-3 sh-main">
        <div class="row">
            <?php echo $element; ?>
            <!-- <div class="col-lg-6 col-10 offset-lg-0 offset-1 mt-3">
                <div class="sh-batch mt-2">
                    <p>SWE 21</p>
                    <a href="table/?b=21" class="mt-3">Go to files</a>
                </div>
            </div>
            <div class="col-lg-6 col-10 offset-lg-0 offset-1 mt-3">
                <div class="sh-batch mt-2">
                    <p>SWE 22</p>
                    <a href="table/?b=22" class="mt-3">Go to files</a>
                </div>
            </div> -->
        </div>
    </div>


    <!-- Footer -->
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