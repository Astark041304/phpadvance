<?php
session_start();
include 'db.php'; // Include the database connection

if (!isset($_GET['id'])) {
    exit("No ID provided.");
}

$id = $_GET['id'];

$countries = ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas (the)", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia (Plurinational State of)", "Bonaire, Sint Eustatius and Saba", "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory (the)", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Cayman Islands (the)", "Central African Republic (the)", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands (the)", "Colombia", "Comoros (the)", "Congo (the Democratic Republic of the)", "Congo (the)", "Cook Islands (the)", "Costa Rica", "Croatia", "Cuba", "Curaçao", "Cyprus", "Czechia", "Côte d'Ivoire", "Denmark", "Djibouti", "Dominica", "Dominican Republic (the)", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Falkland Islands (the) [Malvinas]", "Faroe Islands (the)", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories (the)", "Gabon", "Gambia (the)", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard Island and McDonald Islands", "Holy See (the)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea (the Democratic People's Republic of)", "Korea (the Republic of)", "Kuwait", "Kyrgyzstan", "Lao People's Democratic Republic (the)", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands (the)", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia (Federated States of)", "Moldova (the Republic of)", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands (the)", "New Caledonia", "New Zealand", "Nicaragua", "Niger (the)", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands (the)", "Norway", "Oman", "Pakistan", "Palau", "Palestine, State of", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines (the)", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Republic of North Macedonia", "Romania", "Russian Federation (the)", "Rwanda", "Réunion", "Saint Barthélemy", "Saint Helena, Ascension and Tristan da Cunha", "Saint Kitts and Nevis", "Saint Lucia", "Saint Martin (French part)", "Saint Pierre and Miquelon", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Sint Maarten (Dutch part)", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "South Sudan", "Spain", "Sri Lanka", "Sudan (the)", "Suriname", "Svalbard and Jan Mayen", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Timor-Leste", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands (the)", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates (the)", "United Kingdom of Great Britain and Northern Ireland (the)", "United States Minor Outlying Islands (the)", "United States of America (the)", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela (Bolivarian Republic of)", "Viet Nam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe", "Åland Islands"];

// Fetch personal data
$stmt = $conn->prepare("SELECT * FROM tbl_personal WHERE p_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$personalResult = $stmt->get_result();
$record = $personalResult->fetch_assoc();
$stmt->close();

// Fetch related data from other tables
$stmt = $conn->prepare("SELECT * FROM tbl_placeofbirth WHERE pob_id = (SELECT pob_id WHERE pob_id = ?)");
$stmt->bind_param("i", $id);
$stmt->execute();
$birthResult = $stmt->get_result();
$birthRecord = $birthResult->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM tbl_hadress WHERE ha_id = (SELECT ha_id WHERE ha_id = ?)");
$stmt->bind_param("i", $id);
$stmt->execute();
$addressResult = $stmt->get_result();
$addressRecord = $addressResult->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM tbl_minfo WHERE m_id = (SELECT m_id WHERE m_id = ?)");
$stmt->bind_param("i", $id);
$stmt->execute();
$contactResult = $stmt->get_result();
$contactRecord = $contactResult->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM tbl_finfo WHERE f_id = (SELECT f_id WHERE f_id = ?)");
$stmt->bind_param("i", $id);
$stmt->execute();
$parentsResult = $stmt->get_result();
$parentsRecord = $parentsResult->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect updated data
    $formData = [
        'personal_lastname' => $_POST['personal_lastname'],
        'personal_firstname' => $_POST['personal_firstname'],
        'personal_middle' => $_POST['personal_middle'],
        'dob' => $_POST['date'],
        'sex' => $_POST['sex'],
        'civilStatus' => $_POST['civil_status'],
        'taxId' => $_POST['tax'],
        'religion' => $_POST['religion'],
        'nationality' => $_POST['nationality'],
        'birth' => [
            'bldg' => $_POST['bldg'],
            'blk' => $_POST['blk'],
            'sn' => $_POST['sn'],
            'subdivision' => $_POST['subdivision'],
            'barangay' => $_POST['barangay'],
            'city' => $_POST['city'],
            'country' => $_POST['country'],
            'province' => $_POST['province'],
            'bzip' => $_POST['bzip'],
        ],
        'address' => [
            'hbldg' => $_POST['hbldg'],
            'hblk' => $_POST['hblk'],
            'hsn' => $_POST['hsn'],
            'hsubdivision' => $_POST['hsubdivision'],
            'hbarangay' => $_POST['hbarangay'],
            'hcity' => $_POST['hcity'],
            'hcountry' => $_POST['hcountry'],
            'hprovince' => $_POST['hprovince'],
            'hzip' => $_POST['hzip'],
            'email' => $_POST['email'],
            'tel' => $_POST['tel'],
            'number' => $_POST['number'],
        ],
        'mother_lastname' => $_POST['mother_lastname'],
        'mother_firstname' => $_POST['mother_firstname'],
        'mother_middle' => $_POST['mother_middle'],
        'father_lastname' => $_POST['father_lastname'],
        'father_firstname' => $_POST['father_firstname'],
        'father_middle' => $_POST['father_middle'],
    ];

    // Store form data in session
    $_SESSION['form_data'] = $formData;
    
    // Flag for error checking
    $hasError = false;

    // Update the record in the tbl_personal table
    $updatePersonalStmt = $conn->prepare("UPDATE tbl_personal SET p_lname = ?, p_fname = ?, p_middle = ?, p_bdate = ?, p_sex = ?, p_civilstatus = ?, p_taxno = ?, p_nationality = ?, p_religion = ? WHERE p_id = ?");
    $updatePersonalStmt->bind_param("sssssssssi", $lastName, $firstName, $middleName, $dateOfBirth, $sex, $civilStatus, $taxId, $nationality, $religion, $id);
    
    if (!$updatePersonalStmt->execute()) {
        error_log("Error updating tbl_personal: " . $updatePersonalStmt->error);
        $_SESSION['error'] = "Failed to update personal data.";
        $hasError = true;
    }
    $updatePersonalStmt->close();

    // Update the record in the tbl_birth table
    $birthunit = $_POST['bldg'];
    $birthblk = $_POST['blk'];
    $birthstreetName = $_POST['sn'];
    $birthsubdivision = $_POST['subdivision'];
    $birthbarangay = $_POST['barangay'];
    $birthcity = $_POST['city'];
    $birthprovince = $_POST['province'];
    $birthcountry = $_POST['country'];
    $birthzipCode = $_POST['bzip'];

    $updateBirthStmt = $conn->prepare("UPDATE tbl_placeofbirth SET pob_unitno = ?, pob_blk = ?, pob_sn = ?, pob_subdivision = ?, pob_barangay = ?, pob_city = ?, pob_province = ?, pob_country = ?, pob_zipcode = ? WHERE pob_id = (SELECT pob_id FROM tbl_personal WHERE p_id = ?)");
    $updateBirthStmt->bind_param("issssssssi", $birthunit, $birthblk, $birthstreetName, $birthsubdivision, $birthbarangay, $birthcity, $birthprovince, $birthcountry, $birthzipCode, $id);
    
    if (!$updateBirthStmt->execute()) {
        error_log("Error updating tbl_birth: " . $updateBirthStmt->error);
        $_SESSION['error'] = "Failed to update birth data.";
        $hasError = true;
    }
    $updateBirthStmt->close();

    // Update the record in the tbl_address table
    $unit = $_POST['hbldg'];
    $blk = $_POST['hblk'];
    $streetName = $_POST['hsn'];
    $subdivision = $_POST['hsubdivision'];
    $barangay = $_POST['hbarangay'];
    $city = $_POST['hcity'];
    $province = $_POST['hprovince'];
    $country = $_POST['hcountry'];
    $zipCode = $_POST['hzip'];
    $email = $_POST['email'];
    $telephone = $_POST['tel'];
    $mobile = $_POST['number'];

    $updateHomeAddressStmt = $conn->prepare("UPDATE tbl_hadress SET ha_unitno = ?, ha_blkno = ?, ha_sn = ?, ha_subdivision = ?, ha_barangay = ?, ha_city = ?, ha_province = ?, ha_country = ?, ha_zipcode = ?, ha_email = ?, ha_telno = ?, ha_mobileno = ? WHERE ha_id = (SELECT ha_id FROM tbl_personal WHERE p_id = ?)");
    $updateHomeAddressStmt->bind_param("isssssssssssi", $unit, $blk, $streetName, $subdivision, $barangay, $city, $province, $country, $zipCode, $email, $telephone, $mobile, $id);
    
    if (!$updateHomeAddressStmt->execute()) {
        error_log("Error updating tbl_address: " . $updateHomeAddressStmt->error);
        $_SESSION['error'] = "Failed to update address data.";
        $hasError = true;
    }
    $updateHomeAddressStmt->close();

    // Update the record in the tbl_finfo table
    $fatherlastName = $_POST['father_lastname'];
    $fatherfirstName = $_POST['father_firstname'];
    $fathermiddleName = $_POST['father_middle'];

    $updateFathersInfoStmt = $conn->prepare("UPDATE tbl_finfo SET f_lname = ?, f_fname = ?, f_middle = ? WHERE f_id = (SELECT f_id FROM tbl_personal WHERE p_id = ?)");
    $updateFathersInfoStmt->bind_param("sssi", $fatherlastName, $fatherfirstName, $fathermiddleName, $id);
    
    if (!$updateFathersInfoStmt->execute()) {
        error_log("Error updating tbl_finfo: " . $updateFathersInfoStmt->error);
        $_SESSION['error'] = "Failed to update parents data.";
        $hasError = true;
    }
    $updateFathersInfoStmt->close();

    // Update the record in the tbl_minfo table
    $motherlastName = $_POST['mother_lastname'];
    $motherfirstName = $_POST['mother_firstname'];
    $mothermiddleName = $_POST['mother_middle'];

    $updateMothersInfoStmt = $conn->prepare("UPDATE tbl_minfo SET m_lname = ?, m_fname = ?, m_middle = ? WHERE m_id = (SELECT m_id FROM tbl_personal WHERE p_id = ?)");
    $updateMothersInfoStmt->bind_param("sssi", $motherlastName, $motherfirstName, $mothermiddleName, $id);
    
    if (!$updateMothersInfoStmt->execute()) {
        error_log("Error updating tbl_minfo: " . $updateMothersInfoStmt->error);
        $_SESSION['error'] = "Failed to update parents data.";
        $hasError = true;
    }
    $updateMothersInfoStmt->close();

    // Check if there were any errors
    if (!$hasError) {
        // If no errors, redirect to details.php
        $_SESSION['success'] = "Data updated successfully."; // Optional success message
        header("Location: details.php?id=" . $id); // Redirect to the same details page with the ID
        exit(); // Ensure that the script terminates after the redirect
    } else {
        // If there were errors, set an error message
        $_SESSION['error'] = "There were errors updating the data.";
    }
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
       <form action="update.php?id=<?php echo $id; ?>" method="POST">
        <div class="form first">
            <div class="details personal">
                <h1>Edit Personal Data</h1>

                <!-- Display error or success messages -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="error-message"><?= htmlspecialchars($_SESSION['error']) ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="success-message"><?= htmlspecialchars($_SESSION['success']) ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <div class="fields">
                    <div class="input-box">
                        <label for="personal_lastname">Last Name</label>
                        <input type="text" id="personal_lastname" name="personal_lastname" placeholder="Enter last Name" required value="<?= htmlspecialchars($record['p_lname']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="personal_firstname">First Name</label>
                        <input type="text" id="personal_firstname" name="personal_firstname" placeholder="Enter First Name" required value="<?= htmlspecialchars($record['p_fname']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="personal_middle">Middle Initial</label>
                        <input type="text" id="personal_middle" name="personal_middle" placeholder="Enter Middle Initial" required value="<?= htmlspecialchars($record['p_middle']) ?>">
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
                </div>
                
                <div class="Select">
                    <label for="civil_status">Civil Status:</label>
                    <select id="civil_status" name="civil_status" required>
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
                        <label for="tax">Tax Identification Number</label>
                        <input type="text" id="tax" name="tax" required value="<?= htmlspecialchars($record['p_taxno']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="nationality">Nationality</label>
                        <input type="text" id="nationality" name="nationality" placeholder="Enter Nationality" required value="<?= htmlspecialchars($record['p_nationality']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="religion">Religion</label>
                        <input type="text" id="religion" name="religion" placeholder="Enter Religion" value="<?= htmlspecialchars($record['p_religion']) ?>">
                    </div>
                </div>

                <h2>Place of Birth</h2>
                <div class="place">
                    <div class="input-box">
                        <label for="bldg">Unit No. & Bldg. Name:</label>
                        <input type="text" id="bldg" name="bldg" value="<?= htmlspecialchars($birthRecord['pob_unitno']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="blk">House/Lot & Blk. No:</label>
                        <input type="text" id="blk" name="blk" value="<?= htmlspecialchars($birthRecord['pob_blk']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="sn">Street Name:</label>
                        <input type="text" id="sn" name="sn" value="<?= htmlspecialchars($birthRecord['pob_sn']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="subdivision">Subdivision:</label>
                        <input type="text" id="subdivision" name="subdivision" value="<?= htmlspecialchars($birthRecord['pob_subdivision']) ?>">
                    </div>
                </div>

                <div class="home">
                    <div class="input-box">
                        <label for="barangay">Barangay/District:</label>
                        <input type="text" id="barangay" name="barangay" placeholder="Enter Barangay" value="<?= htmlspecialchars($birthRecord['pob_barangay']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" placeholder="Enter City" value="<?= htmlspecialchars($birthRecord['pob_city']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="province">Province:</label>
                        <input type="text" id="province" name="province" placeholder="Enter Province" value="<?= htmlspecialchars($birthRecord['pob_province']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="bzip">Zipcode:</label>
                        <input type="text" id="bzip" name="bzip" placeholder="Enter Zipcode" value="<?= htmlspecialchars($birthRecord['pob_zipcode']) ?>">
                    </div>
                </div>

                <div class="input-box">
                    <label for="country">Country</label>
                    <select name="country" id="country" required>
                        <option value="" disabled>Select</option>
                        <?php
                        foreach ($countries as $country) {
                            echo "<option value=\"$country\" " . ($birthRecord['pob_country'] == $country ? 'selected' : '') . ">$country</option>";
                        }
                        ?>
                    </select>
                </div>

                <h2>Home Address</h2>
                <div class="place">
                    <div class="input-box">
                        <label for="hbldg">Unit No. & Bldg. Name:</label>
                        <input type="text" id="hbldg" name="hbldg" required value="<?= htmlspecialchars($addressRecord['ha_unitno'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label for="hblk">House/Lot & Blk. No:</label>
                        <input type="text" id="hblk" name="hblk" required value="<?= htmlspecialchars($addressRecord['ha_blkno'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label for="hsn">Street Name:</label>
                        <input type="text" id="hsn" name="hsn" required value="<?= htmlspecialchars($addressRecord['ha_sn'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label for="hsubdivision">Subdivision:</label>
                        <input type="text" id="hsubdivision" name="hsubdivision" value="<?= htmlspecialchars($addressRecord['ha_subdivision'] ?? '') ?>">
                    </div>
                </div>

                <div class="home">
                    <div class="input-box">
                        <label for="hbarangay">Barangay/District:</label>
                        <input type="text" id="hbarangay" name="hbarangay" required value="<?= htmlspecialchars($addressRecord['ha_barangay'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label for="hcity">City:</label>
                        <input type="text" id="hcity" name="hcity" required value="<?= htmlspecialchars($addressRecord['ha_city'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label for="hprovince">Province:</label>
                        <input type="text" id="hprovince" name="hprovince" required value="<?= htmlspecialchars($addressRecord['ha_province'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label for="hzip">Zipcode:</label>
                        <input type="text" id="hzip" name="hzip" value="<?= htmlspecialchars($addressRecord['ha_zipcode'] ?? '') ?>">
                    </div>
                </div>

                <div class="input-box">
                    <label for="hcountry">Country</label>
                    <select name="hcountry" id="hcountry" required>
                        <option value="" disabled selected>Select</option>
                        <?php
                        foreach ($countries as $country) {
                            echo "<option value=\"$country\" " . ($addressRecord['ha_country'] == $country ? 'selected' : '') . ">$country</option>";
                        }
                        ?>
                    </select>
                </div>

                <h2>Contact Information</h2>
                <div class="type">
                    <div class="input-box">
                        <label for="number">Mobile Number</label>
                        <input type="text" id="number" name="number" value="<?= htmlspecialchars($addressRecord['ha_mobileno'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label for="tel">Telephone Number</label>
                        <input type="text" id="tel" name="tel" value="<?= htmlspecialchars($addressRecord['ha_telno'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($addressRecord['ha_email'] ?? '') ?>">
                    </div>
                </div>

                <h2>Father's Name</h2>
                <div class="type">
                    <div class="input-box">
                        <label for="father_lastname">Last Name</label>
                        <input type="text" id="father_lastname" name="father_lastname" value="<?= htmlspecialchars($parentsRecord['f_lname'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label for="father_firstname">First Name</label>
                        <input type="text" id="father_firstname" name="father_firstname" value="<?= htmlspecialchars($parentsRecord['f_fname'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label for="father_middle">Middle Name</label>
                        <input type="text" id="father_middle" name="father_middle" value="<?= htmlspecialchars($parentsRecord['f_middle'] ?? '') ?>">
                    </div>
                </div>

                <h2>Mother's Name</h2>
                <div class="type">
                    <div class="input-box">
                        <label for="mother_lastname">Last Name</label>
                        <input type="text" id="mother_lastname" name="mother_lastname" value="<?= htmlspecialchars($contactRecord['m_lname'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label for="mother_firstname">First Name</label>
                        <input type="text" id="mother_firstname" name="mother_firstname" value="<?= htmlspecialchars($contactRecord['m_fname'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label for="mother_middle">Middle Name</label>
                        <input type="text" id="mother_middle" name="mother_middle" value="<?= htmlspecialchars($contactRecord['m_middle'] ?? '') ?>">
                    </div>
                </div>

                <div class="button">
                    <button type="submit">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>