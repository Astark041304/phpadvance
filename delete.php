
<?php
session_start();
include 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    // Determine which table to delete from based on the hidden input
    $table = isset($_POST['table']) ? $_POST['table'] : '';

    // Prepare the delete statement for the appropriate table
    if ($table === 'personal') {
        $stmt = $conn->prepare("DELETE FROM tbl_personal WHERE p_id = ?");
    } elseif ($table === 'placeofbirth') {
        $stmt = $conn->prepare("DELETE FROM tbl_placeofbirth WHERE pob_id = ?");
    } elseif ($table === 'hadress') {
        $stmt = $conn->prepare("DELETE FROM tbl_hadress WHERE ha_id = ?");
    } elseif ($table === 'finfo') {
        $stmt = $conn->prepare("DELETE FROM tbl_finfo WHERE f_id = ?");
    } elseif ($table === 'minfo') {
        $stmt = $conn->prepare("DELETE FROM tbl_minfo WHERE m_id = ?");
    } else {
        // Invalid table specified
        header("Location: details.php");
        exit();
    }

    // Bind the ID and execute the statement
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Successfully deleted
        $stmt->close();
        header("Location: details.php"); // Redirect back to details page
        exit();
    } else {
        // Handle error
        error_log("Error deleting record: " . $stmt->error);
        $stmt->close();
        header("Location: details.php"); // Redirect back to details page
        exit();
    }
}

$conn->close();
?>