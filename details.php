<?php
session_start();

if (!isset($_SESSION['form_data'])) {
    header("Location: index.php");
    exit();
}

$formData = $_SESSION['form_data'];
unset($_SESSION['form_data']);

function displayData($label, $value) {
    echo "<p><strong>$label:</strong> " . htmlspecialchars($value) . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information</title>
    <link rel="stylesheet" href="main.css">
</head>


<body>

<div class="wrapper">
    <header class="header">
        <h2>Test_<span>Form</span></h2>
    </header>
    <div class="main">
        <section class="container">

        <h1>Submitted <span>Details</span></h1>
        
        <div class="button">
   <button onclick="window.location.href='index.php'" class="backBtn">Back</button>
   </div>

        <h2>Personal Information</h2>
    <?php
    displayData("Name", $formData['fullName']);
    displayData("Date of Birth", $formData['dob']);
    displayData("Age", $formData['age']);
    displayData("Sex", $formData['sex']);
    displayData("Civil Status", $formData['civilStatus']);
    displayData("Tax ID", $formData['taxId']);
    displayData("Nationality", $formData['nationality']);
    displayData("Religion", $formData['religion']);
    ?>

    <h2>Place of Birth</h2>
    <?php
    displayData("Unit No. & Bldg. Name", $formData['birth']['bldg']);
    displayData("House/Lot & Blk. No", $formData['birth']['blk']);
    displayData("Street Name", $formData['birth']['sn']);
    displayData("Subdivision", $formData['birth']['subdivision']);
    displayData("Brgy/District/Locality", $formData['birth']['barangay']);
    displayData("City/Municipality", $formData['birth']['city']);
    displayData("Province", $formData['birth']['province']);
    displayData("Zip Code", $formData['birth']['bzip']);
    displayData("Country", $formData['birth']['country']);
    ?>

    <h2>Home Address</h2>
    <?php
    displayData("Unit No. & Bldg. Name", $formData['address']['hbldg']);
    displayData("House/Lot & Blk. No", $formData['address']['hblk']);
    displayData("Street Name", $formData['address']['hsn']);
    displayData("Subdivision", $formData['address']['hsubdivision']);
    displayData("Brgy/District/Locality", $formData['address']['hbarangay']);
    displayData("City/Municipality", $formData['address']['hcity']);
    displayData("Province", $formData['address']['hprovince']);
    displayData("Zip Code", $formData['address']['hzip']);
    displayData("Country", $formData['address']['hcountry']);
    ?>

    <h2>Contact Information</h2>
    <?php
    displayData("Mobile Number", $formData['contact']['number']);
    displayData("Telephone Number", $formData['contact']['tel']);
    displayData("Email", $formData['contact']['email']);
    ?>

    <h2>Parents' Information</h2>
    <?php
    displayData("Father's Name", $formData['father_lastname'] . ", " . $formData['father_firstname'] . " " . $formData['father_middle']);
    displayData("Mother's Name", $formData['mother_lastname'] . ", " . $formData['mother_firstname'] . " " . $formData['mother_middle']);
    ?>


        </section>
    </div>
</div>



</body>
</html>