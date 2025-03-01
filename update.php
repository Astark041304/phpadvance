<?php
session_start();
include 'db.php'; // Include the database connection

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch the existing data for the record to be edited
$stmt = $conn->prepare("SELECT * FROM tbl_personal WHERE p_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$personalResult = $stmt->get_result();
$record = $personalResult->fetch_assoc();
$stmt->close();

// Fetch related data from other tables
$stmt = $conn->prepare("SELECT * FROM tbl_placeofbirth WHERE pob_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$birthResult = $stmt->get_result();
$birthRecord = $birthResult->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM tbl_hadress WHERE ha_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$addressResult = $stmt->get_result();
$addressRecord = $addressResult->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM tbl_minfo WHERE m_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$contactResult = $stmt->get_result();
$contactRecord = $contactResult->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM tbl_finfo WHERE f_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$parentsResult = $stmt->get_result();
$parentsRecord = $parentsResult->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect updated data with checks
    $lastName = isset($_POST['personal_lastname']) ? trim($_POST['personal_lastname']) : '';
    $firstName = isset($_POST['personal_firstname']) ? trim($_POST['personal_firstname']) : '';
    $middleName = isset($_POST['personal_middle']) ? trim($_POST['personal_middle']) : '';
    $dateOfBirth = isset($_POST['date']) ? $_POST['date'] : '';
    $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
    $civilStatus = isset($_POST['civil_status']) ? $_POST['civil_status'] : '';
    $taxId = isset($_POST['tax']) ? trim($_POST['tax']) : '';
    $nationality = isset($_POST['nationality']) ? trim($_POST['nationality']) : '';
    $religion = isset($_POST['religion']) ? trim($_POST['religion']) : '';
    
    // Update the record in the tbl_personal table
    $updatePersonalStmt = $conn->prepare("UPDATE tbl_personal SET p_lname = ?, p_fname = ?, p_middle = ?, p_bdate = ?, p_sex = ?, p_civilstatus = ?, p_taxno = ?, p_nationality = ?, p_religion = ? WHERE p_id = ?");
    $updatePersonalStmt->bind_param("sssssssssi", $lastName, $firstName, $middleName, $dateOfBirth, $sex, $civilStatus, $taxId, $nationality, $religion, $id);
    
    if (!$updatePersonalStmt->execute()) {
        error_log("Error updating tbl_personal: " . $updatePersonalStmt->error);
    }
    $updatePersonalStmt->close();

    // Update the record in the tbl_placeofbirth table
    $birthunit = isset($_POST['bldg']) ? $_POST['bldg'] : '';
    $birthblk = isset($_POST['blk']) ? $_POST['blk'] : '';
    $birthstreetName = isset($_POST['sn']) ? $_POST['sn'] : '';
    $birthsubdivision = isset($_POST['subdivision']) ? $_POST['subdivision'] : '';
    $birthbarangay = isset($_POST['barangay']) ? $_POST['barangay'] : '';
    $birthcity = isset($_POST['city']) ? $_POST['city'] : '';
    $birthprovince = isset($_POST['province']) ? $_POST['province'] : '';
    $birthcountry = isset($_POST['country']) ? $_POST['country'] : '';
    $birthzipCode = isset($_POST['bzip']) ? $_POST['bzip'] : '';

    $updateBirthStmt = $conn->prepare("UPDATE tbl_placeofbirth SET pob_unitno = ?, pob_blk = ?, pob_sn = ?, pob_subdivision = ?, pob_barangay = ?, pob_city = ?, pob_province = ?, pob_country = ?, pob_zipcode = ? WHERE pob_id = ?");
    $updateBirthStmt->bind_param("issssssssi", $birthunit, $birthblkno, $birthstreetName, $birthsubdivision, $birthbarangay, $birthcity, $birthprovince, $birthcountry, $birthzipCode, $id);
    
    if (!$updateBirthStmt->execute()) {
        error_log("Error updating tbl_placeofbirth: " . $updateBirthStmt->error);
    }
    $updateBirthStmt->close();

    // Update the record in the tbl_hadress table
    $unit = isset($_POST['hbldg']) ? $_POST['hbldg'] : '';
    $blk = isset($_POST['hblk']) ? $_POST['hblk'] : '';
    $streetName = isset($_POST['hsn']) ? $_POST['hsn'] : '';
    $subdivision = isset($_POST['hsubdivision']) ? $_POST['hsubdivision'] : '';
    $barangay = isset($_POST['hbarangay']) ? $_POST['hbarangay'] : '';
    $city = isset($_POST['hcity']) ? $_POST['hcity'] : '';
    $province = isset($_POST['hprovince']) ? $_POST['hprovince'] : '';
    $country = isset($_POST['hcountry']) ? $_POST['hcountry'] : '';
    $zipCode = isset($_POST['hzip']) ? $_POST['hzip'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $telephone = isset($_POST['tel']) ? $_POST['tel'] : '';
    $mobile = isset($_POST['number']) ? $_POST['number'] : '';

    $updateHomeAddressStmt = $conn->prepare("UPDATE tbl_hadress SET ha_unitno = ?, ha_blkno = ?, ha_sn = ?, ha_subdivision = ?, ha_barangay = ?, ha_city = ?, ha_province = ?, ha_country = ?, ha_zipcode = ?, ha_email = ?, ha_telno = ?, ha_mobileno = ? WHERE ha_id = ?");
    $updateHomeAddressStmt->bind_param("issssssssssi", $unit, $blk, $streetName, $subdivision, $barangay, $city, $province, $country, $zipCode, $email, $telephone, $mobile, $id);
    
    if (!$updateHomeAddressStmt->execute()) {
        error_log("Error updating tbl_hadress: " . $updateHomeAddressStmt->error);
    }
    $updateHomeAddressStmt->close();

    // Update the record in the tbl_finfo table
    $fatherlastName = isset($_POST['father_lastname']) ? $_POST['father_lastname'] : '';
    $fatherfirstName = isset($_POST['father_firstname']) ? $_POST['father_firstname'] : '';
    $fathermiddleName = isset($_POST['father_middle']) ? $_POST['father_middle'] : '';

    $updateFathersInfoStmt = $conn->prepare("UPDATE tbl_finfo SET f_lname = ?, f_fname = ?, f_middle = ? WHERE f_id = ?");
    $updateFathersInfoStmt->bind_param("sssi", $fatherlastName, $fatherfirstName, $fathermiddleName, $id);
    
    if (!$updateFathersInfoStmt->execute()) {
        error_log("Error updating tbl_finfo: " . $updateFathersInfoStmt->error);
    }
    $updateFathersInfoStmt->close();

    // Update the record in the tbl_minfo table
    $motherlastName = isset($_POST['mother_lastname']) ? $_POST['mother_lastname'] : '';
    $motherfirstName = isset($_POST['mother_firstname']) ? $_POST['mother_firstname'] : '';
    $mothermiddleName = isset($_POST['mother_middle']) ? $_POST['mother_middle'] : '';

    $updateMothersInfoStmt = $conn->prepare("UPDATE tbl_minfo SET m_lname = ?, m_fname = ?, m_middle = ? WHERE m_id = ?");
    $updateMothersInfoStmt->bind_param("sssi", $motherlastName, $motherfirstName, $mothermiddleName, $id);
    
    if (!$updateMothersInfoStmt->execute()) {
        error_log("Error updating tbl_minfo: " . $updateMothersInfoStmt->error);
    }
    $updateMothersInfoStmt->close();

    // Redirect back to the details page
    header("Location: details.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Personal Data</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="container">
    
    <form action="" method="POST">
        <div class="form first">
            <div class="details personal">
                <h1>Edit Personal Data</h1>

                <div class="fields">
                    <div class="input-box">
                        <label>Last Name</label>
                        <input type="text" name="personal_lastname" placeholder="Enter last Name" required value="<?= htmlspecialchars($record['p_lname']) ?>">
                    </div>
                    <div class="input-box">
                        <label>First Name</label>
                        <input type="text" name="personal_firstname" placeholder="Enter First Name" required value="<?= htmlspecialchars($record['p_fname']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Middle Initial</label>
                        <input type="text" name="personal_middle" placeholder="Enter Middle Initial" required value="<?= htmlspecialchars($record['p_middle']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="date">Date of Birth:</label>
                        <input type="date" id="date" name="date" required value="<?= htmlspecialchars($record['p_bdate']) ?>">
                    </div>
                </div>

                <div class="radio">
                <label>Sex:</label>
                <label for="Male">Male</label>  
                <input type="radio" id="Male" name="sex" value="Male" required <?= ($record['p_sex'] == 'Male') ? 'checked' : '' ?>>
                <label for="Female">Female</label>
                <input type="radio" id="Female" name="sex" value="Female" required <?= ($record['p_sex'] == 'Female') ? 'checked' : '' ?>>
                <label for="Female">Female</label>
                </div>
                

                <div class="Select">
                    <label for="civil_status">Civil Status:</label>
                    <select id="civil_status" name="civil_status">
                        <option value="">--Select--</option>
                        <option value="Single" <?= ($record['p_civilstatus'] == 'Single') ? 'selected' : '' ?>>Single</option>
                        <option value="Married" <?= ($record['p_civilstatus'] == 'Married') ? 'selected' : '' ?>>Married</option>
                        <option value="Widowed" <?= ($record['p_civilstatus'] == 'Widowed') ? 'selected' : '' ?>>Widowed</option>
                        <option value="Divorced" <?= ($record['p_civilstatus'] == 'Divorced') ? 'selected' : '' ?>>Divorced</option>
                        <option value="Separated" <?= ($record['p_civilstatus'] == 'Separated') ? 'selected' : '' ?>>Separated</option>
                        <option value="Others" <?= ($record['p_civilstatus'] == 'Others') ? 'selected' : '' ?>>Others</option>
                    </select>
                </div>

                <div class="type">
                    <div class="input-box">
                        <label>Tax Identification Number</label>
                        <input type="text" name="tax" id="tax" required value="<?= htmlspecialchars($record['p_taxno']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Nationality</label>
                        <input type="text" name="nationality" placeholder="Enter Nationality" required value="<?= htmlspecialchars($record['p_nationality']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Religion</label>
                        <input type="text" name="religion" placeholder="Enter Religion" value="<?= htmlspecialchars($record['p_religion']) ?>">
                    </div>
                </div>

                <h2>Place of Birth</h2>
                <div class="place">
                    <div class="input-box">
                        <label>Unit No. & Bldg. Name:</label>
                        <input type="text" name="bldg" value="<?= htmlspecialchars($birthRecord['pob_unitno']) ?>">
                    </div>
                    <div class="input-box">
                        <label>House/Lot & Blk. No:</label>
                        <input type="text" name="blk" value="<?= htmlspecialchars($birthRecord['pob_blk']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Street Name:</label>
                        <input type="text" name="sn" value="<?= htmlspecialchars($birthRecord['pob_sn']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Subdivision:</label>
                        <input type="text" name="subdivision" value="<?= htmlspecialchars($birthRecord['pob_subdivision']) ?>">
                    </div>
                </div>

                <div class="home">
                    <div class="input-box">
                        <label>Barangay/District:</label>
                        <input type="text" name="barangay" value="<?= htmlspecialchars($birthRecord['pob_barangay']) ?>">
                    </div>
                    <div class="input-box">
                        <label>City:</label>
                        <input type="text" name="city" value="<?= htmlspecialchars($birthRecord['pob_city']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Province:</label>
                        <input type="text" name="province" value="<?= htmlspecialchars($birthRecord['pob_province']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Zipcode:</label>
                        <input type="text" name="bzip" value="<?= htmlspecialchars($birthRecord['pob_zipcode']) ?>">
                    </div>
                </div>

                <div class="input-box">
                    <label>Country</label>
                    <select name="country" id="hcountry" required>
                        <option value="" disabled selected>Select</option>
                        <?php
                        $countries = ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", 
                        "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas (the)", "Bahrain", 
                        "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia (Plurinational State of)", 
                        "Bonaire, Sint Eustatius and Saba", "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory (the)", 
                        "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Cayman Islands (the)", 
                        "Central African Republic (the)", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands (the)", "Colombia", "Comoros (the)", 
                        "Congo (the Democratic Republic of the)", "Congo (the)", "Cook Islands (the)", "Costa Rica", "Croatia", "Cuba", "Curaçao", "Cyprus", "Czechia",
                        "Côte d'Ivoire", "Denmark", "Djibouti", "Dominica", "Dominican Republic (the)", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", 
                        "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Falkland Islands (the) [Malvinas]", "Faroe Islands (the)", "Fiji", "Finland", "France", 
                        "French Guiana", "French Polynesia", "French Southern Territories (the)", "Gabon", "Gambia (the)", "Georgia", "Germany", "Ghana", 
                        "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", 
                        "Haiti", "Heard Island and McDonald Islands", "Holy See (the)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", 
                        "Iran (Islamic Republic of)", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", 
                        "Kenya", "Kiribati", "Korea (the Democratic People's Republic of)", "Korea (the Republic of)", "Kuwait", "Kyrgyzstan", 
                        "Lao People's Democratic Republic (the)", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", 
                        "Macao", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands (the)", "Martinique", "Mauritania", "Mauritius", 
                        "Mayotte", "Mexico", "Micronesia (Federated States of)", "Moldova (the Republic of)", "Monaco", "Mongolia", "Montenegro", "Montserrat", 
                        "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands (the)", "New Caledonia", "New Zealand", "Nicaragua", 
                        "Niger (the)", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands (the)", "Norway", "Oman", "Pakistan", "Palau", "Palestine, State of", 
                        "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines (the)", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", 
                        "Republic of North Macedonia", "Romania", "Russian Federation (the)", "Rwanda", "Réunion", "Saint Barthélemy", "Saint Helena, Ascension and Tristan da Cunha", 
                        "Saint Kitts and Nevis", "Saint Lucia", "Saint Martin (French part)", "Saint Pierre and Miquelon", "Saint Vincent and the Grenadines", "Samoa", 
                        "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Sint Maarten (Dutch part)", 
                        "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "South Sudan", "Spain", 
                        "Sri Lanka", "Sudan (the)", "Suriname", "Svalbard and Jan Mayen", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", 
                        "Tanzania, United Republic of", "Thailand", "Timor-Leste", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", 
                        "Turks and Caicos Islands (the)", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates (the)", "United Kingdom of Great Britain and Northern Ireland (the)", 
                        "United States Minor Outlying Islands (the)", "United States of America (the)", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela (Bolivarian Republic of)", 
                        "Viet Nam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe", "Åland Islands"];
                        foreach ($countries as $country) {
                            echo "<option value=\"$country\" " . ($country == $country ? 'selected' : '') . ">$country</option>";
                        }
                        ?>
                    </select>
                </div>

                <h2>Home Address</h2>
                <div class="place">
                    <div class="input-box">
                        <label>Unit No. & Bldg. Name:</label>
                        <input type="text" name="hbldg" required value="<?= htmlspecialchars($addressRecord['ha_unitno']) ?>">
                    </div>
                    <div class="input-box">
                        <label>House/Lot & Blk. No:</label>
                        <input type="text" name="hblk" required value="<?= htmlspecialchars($addressRecord['ha_blkno']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Street Name:</label>
                        <input type="text" name="hsn" required value="<?= htmlspecialchars($addressRecord['ha_sn']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Subdivision:</label>
                        <input type="text" name="hsubdivision" value="<?= htmlspecialchars($addressRecord['ha_subdivision']) ?>">
                    </div>
                </div>

                <div class="home">
                    <div class="input-box">
                        <label>Barangay/District:</label>
                        <input type="text" name="hbarangay" required value="<?= htmlspecialchars($addressRecord['ha_barangay']) ?>">
                    </div>
                    <div class="input-box">
                        <label>City:</label>
                        <input type="text" name="hcity" required value="<?= htmlspecialchars($addressRecord['ha_city']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Province:</label>
                        <input type="text" name="hprovince" required value="<?= htmlspecialchars($addressRecord['ha_province']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Zipcode:</label>
                        <input type="text" name="hzip" value="<?= htmlspecialchars($addressRecord['ha_zipcode']) ?>">
                    </div>
                </div>

                <div class="input-box">
                    <label>Country</label>
                    <select name="country" id="hcountry" required>
                        <option value="" disabled selected>Select</option>
                        <?php
                        $countries = ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", 
                        "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas (the)", "Bahrain", 
                        "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia (Plurinational State of)", 
                        "Bonaire, Sint Eustatius and Saba", "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory (the)", 
                        "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Cayman Islands (the)", 
                        "Central African Republic (the)", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands (the)", "Colombia", "Comoros (the)", 
                        "Congo (the Democratic Republic of the)", "Congo (the)", "Cook Islands (the)", "Costa Rica", "Croatia", "Cuba", "Curaçao", "Cyprus", "Czechia",
                        "Côte d'Ivoire", "Denmark", "Djibouti", "Dominica", "Dominican Republic (the)", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", 
                        "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Falkland Islands (the) [Malvinas]", "Faroe Islands (the)", "Fiji", "Finland", "France", 
                        "French Guiana", "French Polynesia", "French Southern Territories (the)", "Gabon", "Gambia (the)", "Georgia", "Germany", "Ghana", 
                        "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", 
                        "Haiti", "Heard Island and McDonald Islands", "Holy See (the)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", 
                        "Iran (Islamic Republic of)", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", 
                        "Kenya", "Kiribati", "Korea (the Democratic People's Republic of)", "Korea (the Republic of)", "Kuwait", "Kyrgyzstan", 
                        "Lao People's Democratic Republic (the)", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", 
                        "Macao", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands (the)", "Martinique", "Mauritania", "Mauritius", 
                        "Mayotte", "Mexico", "Micronesia (Federated States of)", "Moldova (the Republic of)", "Monaco", "Mongolia", "Montenegro", "Montserrat", 
                        "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands (the)", "New Caledonia", "New Zealand", "Nicaragua", 
                        "Niger (the)", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands (the)", "Norway", "Oman", "Pakistan", "Palau", "Palestine, State of", 
                        "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines (the)", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", 
                        "Republic of North Macedonia", "Romania", "Russian Federation (the)", "Rwanda", "Réunion", "Saint Barthélemy", "Saint Helena, Ascension and Tristan da Cunha", 
                        "Saint Kitts and Nevis", "Saint Lucia", "Saint Martin (French part)", "Saint Pierre and Miquelon", "Saint Vincent and the Grenadines", "Samoa", 
                        "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Sint Maarten (Dutch part)", 
                        "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "South Sudan", "Spain", 
                        "Sri Lanka", "Sudan (the)", "Suriname", "Svalbard and Jan Mayen", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", 
                        "Tanzania, United Republic of", "Thailand", "Timor-Leste", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", 
                        "Turks and Caicos Islands (the)", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates (the)", "United Kingdom of Great Britain and Northern Ireland (the)", 
                        "United States Minor Outlying Islands (the)", "United States of America (the)", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela (Bolivarian Republic of)", 
                        "Viet Nam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe", "Åland Islands"];
                        foreach ($countries as $country) {
                            echo "<option value=\"$country\" " . ($country == $country ? 'selected' : '') . ">$country</option>";
                        }
                        ?>
                    </select>
                </div>

                <h2>Contact Information</h2>
                <div class="type">
                    <div class="input-box">
                        <label>Mobile Number</label>
                        <input type="text" name="number" value="<?= htmlspecialchars($addressRecord['ha_mobileno']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Telephone Number</label>
                        <input type="text" name="tel" value="<?= htmlspecialchars($addressRecord['ha_telno']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($addressRecord['ha_email']) ?>">
                    </div>
                </div>

                <h2>Father's Name</h2>
                <div class="type">
                    <div class="input-box">
                        <label>Last Name</label>
                        <input type="text" name="father_lastname" value="<?= htmlspecialchars($parentsRecord['f_lname']) ?>">
                    </div>
                    <div class="input-box">
                        <label>First Name</label>
                        <input type="text" name="father_firstname" value="<?= htmlspecialchars($parentsRecord['f_fname']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Middle Name</label>
                        <input type="text" name="father_middle" value="<?= htmlspecialchars($parentsRecord['f_middle']) ?>">
                    </div>
                </div>

                <h2>Mother's Name</h2>
                <div class="type">
                    <div class="input-box">
                        <label>Last Name</label>
                        <input type="text" name="mother_lastname" value="<?= htmlspecialchars($contactRecord['m_lname']) ?>">
                    </div>
                    <div class="input-box">
                        <label>First Name</label>
                        <input type="text" name="mother_firstname" value="<?= htmlspecialchars($contactRecord['m_fname']) ?>">
                    </div>
                    <div class="input-box">
                        <label>Middle Name</label>
                        <input type="text" name="mother_middle" value="<?= htmlspecialchars($contactRecord['m_middle']) ?>">
                    </div>
                </div>
  
                <div class="button">
                <button onclick="window.location.href='details.php'" class="backBtn">Update</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>