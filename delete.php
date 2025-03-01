
<?php
session_start();
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    
    $table = isset($_POST['table']) ? $_POST['table'] : '';

   
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
      
        header("Location: details.php");
        exit();
    }

    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
       
        $stmt->close();
        header("Location: details.php"); 
        exit();
    } else {
     
        error_log("Error deleting record: " . $stmt->error);
        $stmt->close();
        header("Location: details.php"); 
        exit();
    }
}

$conn->close();
?>