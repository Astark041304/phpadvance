<?php
session_start();

if (!isset($_SESSION['form_data'])) {
    header("Location: index.php");
    exit();
}

$formData = $_SESSION['form_data'];
unset($_SESSION['form_data']);

// Extract Personal Information
$lastName = isset($formData['personal_lastname']) ? $formData['personal_lastname'] : '';
$firstName = isset($formData['personal_firstname']) ? $formData['personal_firstname'] : '';
$middleName = isset($formData['personal_middle']) ? $formData['personal_middle'] : '';
$dateOfBirth = isset($formData['dob']) ? $formData['dob'] : '';
$age = isset($formData['age']) ? $formData['age'] : '';
$sex = isset($formData['sex']) ? $formData['sex'] : '';
$civilStatus = isset($formData['civilStatus']) ? $formData['civilStatus'] : '';
$taxId = isset($formData['taxId']) ? $formData['taxId'] : '';
$religion = isset($formData['religion']) ? $formData['religion'] : '';
$nationality = isset($formData['nationality']) ? $formData['nationality'] : '';

// Extract Birthplace
$birth = $formData['birth'] ?? [];
$birthunit = $birth['bldg'] ?? '';
$birthblk = $birth['blk'] ?? '';
$birthstreetName = $birth['sn'] ?? '';
$birthsubdivision = $birth['subdivision'] ?? '';
$birthbarangay = $birth['barangay'] ?? '';
$birthcity = $birth['city'] ?? 'N/A';
$birthprovince = $birth['province'] ?? 'N/A';
$birthcountry = $birth['country'] ?? 'N/A';
$birthzipCode = $birth['bzip'] ?? '';

// Extract Home Address
$address = $formData['address'] ?? [];
$unit = $address['hbldg'] ?? '';
$blk = $address['hblk'] ?? '';
$streetName = $address['hsn'] ?? '';
$subdivision = $address['hsubdivision'] ?? '';
$barangay = $address['hbarangay'] ?? '';
$city = $address['hcity'] ?? 'N/A';
$province = $address['hprovince'] ?? 'N/A';
$country = $address['hcountry'] ?? 'N/A';
$zipCode = $address['hzip'] ?? '';

// Extract Contact Information
$contact = $formData['contact'] ?? [];
$mobile = $contact['number'] ?? '';
$telephone = $contact['tel'] ?? '';
$email = $contact['email'] ?? '';

// Extract Parents' Information
$fatherlastName = isset($formData['father_lastname']) ? $formData['father_lastname'] : '';
$fatherfirstName = isset($formData['father_firstname']) ? $formData['father_firstname'] : '';
$fathermiddleName = isset($formData['father_middle']) ? $formData['father_middle'] : '';

$motherlastName = isset($formData['mother_lastname']) ? $formData['mother_lastname'] : '';
$motherfirstName = isset($formData['mother_firstname']) ? $formData['mother_firstname'] : '';
$mothermiddleName = isset($formData['mother_middle']) ? $formData['mother_middle'] : '';

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
        <table class="info-table">
            <tr><th>Field</th><th>Information</th></tr>
            <tr><td>Name</td><td><?php echo "$lastName, $firstName $middleName"; ?></td></tr>
            <tr><td>Date of Birth</td><td><?php echo $dateOfBirth; ?></td></tr>
            <tr><td>Sex</td><td><?php echo $sex; ?></td></tr>
            <tr><td>Civil Status</td><td><?php echo $civilStatus; ?></td></tr>
            <tr><td>Tax ID</td><td><?php echo $taxId; ?></td></tr>
            <tr><td>Religion</td><td><?php echo $religion; ?></td></tr>
            <tr><td>Nationality</td><td><?php echo $nationality; ?></td></tr>
        </table>

        <h2>Place of Birth</h2>
        <table class="info-table">
            <tr><th>Field</th><th>Information</th></tr>
            <tr><td>Unit No. & Bldg. Name</td><td><?php echo $birthunit; ?></td></tr>
            <tr><td>House/Lot & Blk. No</td><td><?php echo $birthblk; ?></td></tr>
            <tr><td>Street Name</td><td><?php echo $birthstreetName; ?></td></tr>
            <tr><td>Subdivision</td><td><?php echo $birthsubdivision; ?></td></tr>
            <tr><td>Brgy/District/Locality</td><td><?php echo $birthbarangay; ?></td></tr>
            <tr><td>City/Municipality</td><td><?php echo $birthcity; ?></td></tr>
            <tr><td>Country</td><td><?php echo $birthcountry; ?></td></tr>
            <tr><td>Province</td><td><?php echo $birthprovince; ?></td></tr>
            <tr><td>Zip Code</td><td><?php echo $birthzipCode; ?></td></tr>
        </table>

        
        <h2>Home Address</h2>
        <table class="info-table">
            <tr><th>Field</th><th>Information</th></tr>
            <tr><td>Unit No. & Bldg. Name</td><td><?php echo $unit; ?></td></tr>
            <tr><td>House/Lot & Blk. No</td><td><?php echo $blk; ?></td></tr>
            <tr><td>Street Name</td><td><?php echo $streetName; ?></td></tr>
            <tr><td>Subdivision</td><td><?php echo $subdivision; ?></td></tr>
            <tr><td>Brgy/District/Locality</td><td><?php echo $barangay; ?></td></tr>
            <tr><td>City/Municipality</td><td><?php echo $city; ?></td></tr>
            <tr><td>Country</td><td><?php echo $country; ?></td></tr>
            <tr><td>Province</td><td><?php echo $province; ?></td></tr>
            <tr><td>Zip Code</td><td><?php echo $zipCode; ?></td></tr>
            <tr><td>Mobile Number</td><td><?php echo $mobile; ?></td></tr>
            <tr><td>Email</td><td><?php echo $email; ?></td></tr>
            <tr><td>Telephone Number</td><td><?php echo $telephone; ?></td></tr>
        </table>

        <h2>Parents' Information</h2>
        <table class="info-table">
            <tr><th>Field</th><th>Information</th></tr>
            <tr><td>Father's Name</td><td><?php echo "$fatherlastName, $fatherfirstName $fathermiddleName"; ?></td></tr>
            <tr><td>Mother's Name</td><td><?php echo "$motherlastName, $motherfirstName $mothermiddleName"; ?></td></tr>
        </table>
        
        

        </section>
    </div>
</div>

</body>
</html>
