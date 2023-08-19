<?php
// Check if the "name" session is set
session_start();
if(isset($_SESSION['name'])) {
    // Include the database connection file
    require_once('../connection.php');

    // Check if the id parameter is present in the GET request
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // Prepare and execute the SQL DELETE statement
        $sql = "DELETE FROM file WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: ../heyboss/");
        } else {
            //echo "Error deleting record: " . $stmt->error;
            header("Location: ../");
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        header("Location: ../");
    }

    // Close the database connection
    $conn->close();
} else {
    header("Location: ../");
}
?>