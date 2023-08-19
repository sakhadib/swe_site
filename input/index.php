<?php
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("Location: ../login/");
    }
    require_once "../connection.php";
    $uname = $_SESSION['username'];
    $batch = $_SESSION['batch'];
    $name = $_SESSION['name'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $CourseCode = $_POST['course_code'];
        $courseName = $_POST['course_name'];
        $title = $_POST['title'];
        $url = $_POST['url'];
        $user = $name;
        $date = date("Y-m-d");
    
        // Assuming you have a database connection established
        $stmt = $conn->prepare("INSERT INTO file (CourseCode, courseName, title, url, user, date, batch) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Bind parameters
        $stmt->bind_param("sssssss", $CourseCode, $courseName, $title, $url, $user, $date, $batch);
        
        // Execute the statement
        $stmt->execute();
        
        // Close statement
        $stmt->close();
    }
?>

<?php
    require_once "../connection.php";

    //Query
    $query = "SELECT id, date, title, url, CourseCode FROM `file` WHERE `batch` = '$batch' AND `user` = '$name' ORDER BY `date` DESC";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    // Generate the HTML table rows dynamically
    $rows = '';
    $ct = 1;
    while ($row = $result->fetch_assoc()) {
        $title = '<a href="../file/?id='.$row['id'].'">' . $row['title'] . '</a>';
        $dlt = '<a href="../input/dlt.php?id='.$row['id'].'" class="link-danger"><i class="uil uil-trash-alt"></i> Delete</a>';
        if($row['date'] == "0000-00-00") $row['date'] = "2023-08-09";
        $rows .= "<tr>
            <td>{$ct}</td>
            <td>{$row['date']}</td>
            <td>{$title}</td>
            <td>{$row['CourseCode']}</td>
            <td class='text-center'>{$dlt}</td>
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
    <!-- Navbar -->
    <?php include '../logheader.php'; ?>
    <div class="main-input mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Input New File</h1>
                    <form action="#" method="post">
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name = "course_code" id="floatingInput" placeholder="SWE 4101" required>
                                    <label for="floatingInput">Course Code</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name = "course_name" id="floatingInput" placeholder="SWE 4101" required>
                                    <label for="floatingInput">Course Name</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name = "title" id="floatingInput" placeholder="SWE 4101" required>
                                    <label for="floatingInput">File Title</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name = "url" id="floatingInput" placeholder="SWE 4101" required>
                                    <label for="floatingInput">File URL ( drive link recommended )</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="SWE 4101" value="<?php echo $name ?>" required readonly>
                                    <label for="floatingInput">Input By</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="SWE 4101" value="<?php echo date("Y-m-d") ?>" required readonly>
                                    <label for="floatingInput">Date</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="SWE 4101" value="<?php echo $batch ?>" required readonly>
                                    <label for="floatingInput">Batch</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-4" style="width: 100%;">Submit</button>
                    </form>
                </div>
            </div>
            <hr>
        </div>
    </div>

    

    <!-- Main Section -->
    <section class="main-table" id = "standing">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table id="stable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>Date</th>
                                <th>File Title</th>
                                <th>Course</th>
                                <th class='text-center'>Action</th>
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
