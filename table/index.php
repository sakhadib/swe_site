<?php
    // Database Connection
    require_once "../connection.php";
    
    if(!isset($_GET['b'])){
        header("Location: ../library/");
    }

    // get method b = ?
    $batch = $_GET['b'];

    

    //Query
    $query = "SELECT id, date, title, url, CourseCode FROM `file` WHERE `batch` = '$batch' ORDER BY `date` DESC";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    // Generate the HTML table rows dynamically
    $rows = '';
    $ct = 1;
    while ($row = $result->fetch_assoc()) {
        $title = '<a href="../file/?id='.$row['id'].'">' . $row['title'] . '</a>';
        if($row['date'] == "0000-00-00") $row['date'] = "2023-08-09";
        $rows .= "<tr>
            <td>{$ct}</td>
            <td>{$row['date']}</td>
            <td>{$title}</td>
            <td>{$row['CourseCode']}</td>
        </tr>";
        $ct++;
    }
    //closing the connection
    $conn->close()

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files</title>

    <!-- Custom CSS files -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../style.css">
    <!-- BootStrap CSS files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <!-- Online Icons CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="icon" type="image/x-icon" href="../rsx/logo.ico">
    <script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="script.js"></script>
</head>
<body>
    <?php include_once "../header.php"; ?>

    <!-- Main Section -->
    <section class="main-table mt-5" id = "standing" style = "min-height: 75vh;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table id="stable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>date</th>
                                <th>title</th>
                                <th>course</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- Automatic Code injected by PHP -->
                        <?php echo $rows; ?>
                        </tbody>
                    </table>
                            
                            
                </div>
            </div>
        </div>
    </section>



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



    <!-- script for table -->
    <script>
        new DataTable('#stable');
    </script>
</body>
</html>
