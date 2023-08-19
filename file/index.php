<?php
    require_once "../connection.php";

    if(!isset($_GET['id'])){
        header("Location: ../library/");
    }

    // get method id
    $id = $_GET['id'];

    //Query
    $query = "SELECT date, title, url, courseName, CourseCode, user, batch FROM `file` WHERE `id` = '$id'";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    $escapedUrl = str_replace("/view", "/preview", $row['url']);
    $title = $row['title'];
    $courseName = $row['courseName'];
    $CourseCode = $row['CourseCode'];
    $user = $row['user'];
    $batch = $row['batch'];

    $meta =  $courseName . " - " . $CourseCode . " - " . $user . " - Batch " . $batch;


    //closing the connection
    $conn->close();

?>




<!-- html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR Mate</title>

        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        
        <!-- css -->
        <link rel="stylesheet" href="style.css">
    
        
        <!-- icons -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <?php include "../header.php"; ?>
    <div class="sh-container">
        <div class="container shuv">
            <div class="row">
                <div class="col-12">
                    <div class="spacer-50"></div>
                    <!-- php file title -->
                    <h1><?php echo $title?></h1>
                    <h6><?php echo $meta?></h6>
                    <button id="copyButton" class="btn btn-warning mt-3" onclick="copyPageLink()"><i class="uil uil-copy"></i> Copy file link to share</button>
                    <a href="<?php echo $escapedUrl; ?>" target="_blank" class="btn btn-primary mt-3"><i class="uil uil-arrow-up-right"></i> Open in New Tab</a>
                    <div id="copyMessage" class="mt-2" style="display: none;">Link copied to clipboard!</div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <iframe src="<?php echo $escapedUrl ?>" width='100%' height='800' frameborder='0' style = 'border-radius: 10px'></iframe>";
                    <div class="spacer-50"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    .spacer-50{
        height: 50px;
    }
    .shuv{
        /* min-height: 71vh; */
        display: flex;
        align-items: center;
    }
    
</style>

<script>
    function copyPageLink() {
        var dummyTextArea = document.createElement("textarea");
        dummyTextArea.value = window.location.href;
        document.body.appendChild(dummyTextArea);
        dummyTextArea.select();
        document.execCommand("copy");
        document.body.removeChild(dummyTextArea);

        // Show the message for a short duration
        var copyMessage = document.getElementById("copyMessage");
        copyMessage.style.display = "block";
        setTimeout(function() {
            copyMessage.style.display = "none";
        }, 2000);
    }

</script>