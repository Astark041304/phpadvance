DELETE.PHP

<?php
session_start();
include 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare the delete statement for tbl_formation
    $stmt = $conn->prepare("DELETE FROM tbl_formation WHERE u_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // You can add similar delete statements for other related tables if needed
    // Example for tbl_birth
    $stmt = $conn->prepare("DELETE FROM tbl_birth WHERE b_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();


    $stmt = $conn->prepare("DELETE FROM tbl_address WHERE h_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();


    $stmt = $conn->prepare("DELETE FROM tbl_contact WHERE c_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();


    $stmt = $conn->prepare("DELETE FROM tbl_parents WHERE p_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();


    // Redirect back to the submit page
    header("Location: submit.php");
    exit();
}

$conn->close();
?>