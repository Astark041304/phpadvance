<?php
session_start();
include 'db.php';


$errors = [];
$success = false;


if (isset($_GET['id'])) {
    $personalId = intval($_GET['id']);
    
   
$stmt = $conn->prepare("SELECT * FROM tbl_personal WHERE p_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$personal = $stmt->get_result();
$record = $personal->fetch_assoc();
$stmt->close();


$stmt = $conn->prepare("SELECT * FROM tbl_placeofbirth WHERE pob_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$placeofbirth = $stmt->get_result();
$birthRecord =  $placeofbirth->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM tbl_hadress WHERE ha_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$hadress = $stmt->get_result();
$addressRecord =  $hadress->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM tbl_minfo WHERE m_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$minfo = $stmt->get_result();
$contactRecord = $minfo->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM tbl_finfo WHERE f_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$finfo = $stmt->get_result();
$parentsRecord =  $finfo->fetch_assoc();
$stmt->close();

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $lastName = trim($_POST['personal_lastname'] ?? '');
    $firstName = trim($_POST['personal_firstname'] ?? '');
    $middleName = trim($_POST['personal_middle'] ?? '');
    $dateOfBirth = $_POST['date'] ?? '';
    $sex = $_POST['sex'] ?? '';
    $civilStatus = $_POST['civil_status'] ?? '';
    $taxId = trim($_POST['tax'] ?? '');
    $nationality = trim($_POST['nationality'] ?? '');
    $religion = trim($_POST['religion'] ?? '');

    $birthunit = trim($_POST['bldg'] ?? '');
    $birthblk = trim($_POST['blk'] ?? '');
    $birthstreetName = trim($_POST['sn'] ?? '');
    $birthsubdivision = trim($_POST['subdivision'] ?? '');
    $birthbarangay = trim($_POST['barangay'] ?? '');
    $birthcity = trim($_POST['city'] ?? '');
    $birthprovince = trim($_POST['province'] ?? '');
    $birthcountry = $_POST['country'] ?? '';
    $birthzipCode = trim($_POST['bzip'] ?? '');

    $unit = trim($_POST['hbldg'] ?? '');
    $blk = trim($_POST['hblk'] ?? '');
    $streetName = trim($_POST['hsn'] ?? '');
    $subdivision = trim($_POST['hsubdivision'] ?? '');
    $barangay = trim($_POST['hbarangay'] ?? '');
    $city = trim($_POST['hcity'] ?? '');
    $province = trim($_POST['hprovince'] ?? '');
    $country = $_POST['hcountry'] ?? '';
    $zipCode = trim($_POST['hzip'] ?? '');
    $mobile = trim($_POST['number'] ?? '');
    $telephone = trim($_POST['tel'] ?? '');
    $email = trim($_POST['email'] ?? '');

    $fatherlastName = trim($_POST['father_lastname'] ?? '');
    $fatherfirstName = trim($_POST['father_firstname'] ?? '');
    $fathermiddleName = trim($_POST['father_middle'] ?? '');
    $motherlastName = trim($_POST['mother_lastname'] ?? '');
    $motherfirstName = trim($_POST['mother_firstname'] ?? '');
    $mothermiddleName = trim($_POST['mother_middle'] ?? '');

    if (empty($lastName) || preg_match('/[0-9]/', $lastName)) {
        $errors['personal_lastname'] = "Last Name must not contain numbers.";
    }
    if (empty($firstName) || preg_match('/[0-9]/', $firstName)) {
        $errors['personal_firstname'] = "First Name must not contain numbers.";
    }
    if (empty($middleName) || preg_match('/[0-9]/', $middleName)) {
        $errors['personal_middle'] = "Middle Name must not contain numbers.";
    }
    if (empty($fatherlastName) || preg_match('/[0-9]/', $fatherlastName)) {
        $errors['father_lastname'] = "Father's Last Name must not contain numbers.";
    }
    if (empty($fatherfirstName) || preg_match('/[0-9]/', $fatherfirstName)) {
        $errors['father_firstname'] = "Father's First Name must not contain numbers.";
    }
    if (empty($fathermiddleName) || preg_match('/[0-9]/', $fathermiddleName)) {
        $errors['father_middle'] = "Father's Middle Name must not contain numbers.";
    }
    if (empty($motherlastName) || preg_match('/[0-9]/', $motherlastName)) {
        $errors['mother_lastname'] = "Mother's Last Name must not contain numbers.";
    }
    if (empty($motherfirstName) || preg_match('/[0-9]/', $motherfirstName)) {
        $errors['mother_firstname'] = "Mother's First Name must not contain numbers.";
    }
    if (empty($mothermiddleName) || preg_match('/[0-9]/', $mothermiddleName)) {
        $errors['mother_middle'] = "Mother's Middle Name must not contain numbers.";
    }
    if (empty($dateOfBirth)) {
        $errors['date'] = "Invalid Date of Birth.";
    } elseif (calculateAge($dateOfBirth) < 18) {
        $errors['date'] = "You must be at least 18 years old.";
    }
    if (empty($sex)) {
        $errors['sex'] = "Select a Gender.";
    }
    if (empty($civilStatus)) {
        $errors['civil_status'] = "Select a Civil Status.";
    }
    if (empty($taxId) || !preg_match('/^[0-9]+$/', $taxId)) {
        $errors['tax'] = "Tax ID must contain numbers only.";
    }
    if (empty($nationality)) {
        $errors['nationality'] = "Field is required.";
    }
    if (empty($religion)) {
        $religion = "N/A";
    }
    if (empty($birthunit)) {
        $errors['bldg'] = "Field is required.";
    }
    if (empty($birthblk)) {
        $errors['blk'] = "Field is required.";
    }
    if (empty($birthstreetName)) {
        $errors['sn'] = "Field is required.";
    }
    if (empty($birthcity)) {
        $birthcity = "N/A";
    }
    if (empty($birthprovince)) {
        $birthprovince = "N/A";
    }
    if (empty($birthzipCode) || !preg_match('/^[0-9]+$/', $birthzipCode)) {
        $errors['bzip'] = "Birth Zipcode must contain numbers only.";
    }
    if (empty($birthcountry)) {
        $birthcountry = "N/A";
    }
    if (empty($unit)) {
        $errors['hbldg'] = "Field is required.";
    }
    if (empty($blk)) {
        $errors['hblk'] = "Field is required.";
    }
    if (empty($streetName)) {
        $errors['hsn'] = "Field is required.";
    }
    if (empty($city)) {
        $city = "N/A";
    }
    if (empty($province)) {
        $province = "N/A";
    }
    if (empty($zipCode) || !preg_match('/^[0-9]+$/', $zipCode)) {
        $errors['hzip'] = "Zip Code must contain numbers only.";
    }
    if (empty($country)) {
        $country = "N/A";
    }
    if (empty($mobile)) {
        $errors['number'] = "Field is required.";
    } elseif (!preg_match('/^[0-9]+$/', $mobile)) {
        $errors['number'] = "Mobile Phone must contain numbers only.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }
    if (empty($telephone) || !preg_match('/^[0-9]+$/', $telephone)) {
        $errors['tel'] = "Telephone Number must contain numbers only.";
    }

    if (empty($errors)) {
        $_SESSION['form_data'] = [
            'personalId' => $personalId,
            'placeOfBirthId' => $placeOfBirthId,
            'homeAddressId' => $homeAddressId,
            'motherId' => $motherId,
            'fatherId' => $fatherId,

            'personal_lastname' => $lastName, 
            'personal_firstname'=> $firstName, 
            'personal_middle'=> $middleName, 
            'dob' => $dateOfBirth,
            'age' => calculateAge($dateOfBirth),
            'sex' => $sex,
            'civilStatus' => $civilStatus,
            'taxId' => $taxId,
            'nationality' => $nationality,
            'religion' => $religion,

            'birth' => [
                'bldg' => $birthunit,
                'blk' => $birthblk,
                'sn' => $birthstreetName,
                'subdivision' => $birthsubdivision,
                'barangay' => $birthbarangay,
                'city' => $birthcity,
                'province' => $birthprovince,
                'country' => $birthcountry,
                'bzip' => $birthzipCode,
            ],
            'address' => [
                'hbldg' => $unit,
                'hblk' => $blk,
                'hsn' => $streetName,
                'hsubdivision' => $subdivision,
                'hbarangay' => $barangay,
                'hcity' => $city,
                'hprovince' => $province,
                'hcountry' => $country,
                'hzip' => $zipCode,
                'number' => $mobile,
                'tel' => $telephone,
                'email' => $email,
            ],
           
            'father_lastname' => $fatherlastName,
            'father_firstname' => $fatherfirstName,
            'father_middle' => $fathermiddleName,
            'mother_lastname' => $motherlastName,
            'mother_firstname' => $motherfirstName,
            'mother_middle' => $mothermiddleName,
        ];

       
    $updatePersonal = $conn->prepare("UPDATE tbl_personal SET p_lname = ?, p_fname = ?, p_middle = ?, p_bdate = ?, p_sex = ?, p_civilstatus = ?, p_taxno = ?, p_religion = ?, p_nationality = ? WHERE p_id = ?");
    $updatePersonal->bind_param("sssssssssi", $lastName, $firstName, $middleName, $dateOfBirth, $sex, $civilStatus, $taxId, $nationality, $religion, $id);
    
    if (!$updatePersonal->execute()) {
        error_log("Error updating tbl_personal: " . $updatePersonal);
    }
    $updatePersonal->close();

    $birthUnit = $_POST['bldg'];
    $birthBlkNo = $_POST['blk'];
    $birthStreetName = $_POST['sn'];
    $birthSubdivision = $_POST['subdivision'];
    $birthBrgy = $_POST['barangay'];
    $birthCity = $_POST['city'];
    $birthProvince = $_POST['province'];
    $birthCountry = $_POST['country'];
    $birthZipCode = $_POST['bzip'];

    $updateBirth = $conn->prepare("UPDATE tbl_placeofbirth SET pob_unitno = ?, pob_blk = ?, pob_sn = ?, pob_subdivision = ?, pob_barangay = ?, pob_city = ?, pob_country = ?, pob_province = ?, pob_zipcode = ? WHERE pob_id = ?");
    $updateBirth->bind_param("issssssssi", $birthUnit, $birthblk, $birthstreetName, $birthsubdivision, $birthbarangay, $birthcity, $birthprovince, $birthcountry, $birthzipCode, $id);
    
    if (!$updateBirth->execute()) {
        error_log("Error updating tbl_placeofbirth: " . $updateBirth->error);
    }
    $updateBirth->close();

    $unit = $_POST['hbldg'];
    $blk = $_POST['hblk'];
    $streetName = $_POST['hsn'];
    $subdivision = $_POST['hsubdivision'];
    $barangay = $_POST['hbarangay'];
    $city = $_POST['hcity'];
    $province = $_POST['hprovince'];
    $country = $_POST['hcountry'];
    $zipCode = $_POST['hzip'];
    $mobile = $_POST['number'];
    $telephone = $_POST['tel'];
    $email = $_POST['email'];


    $updateHomeAddress = $conn->prepare("UPDATE tbl_hadress SET ha_unitno = ?, ha_blkno = ?, ha_sn = ?, ha_subdivision = ?, ha_barangay = ?, ha_city = ?, ha_country = ?, ha_province = ?, h_zipcode, ha_email, ha_telno, ha_mobileno = ? WHERE ha_id = ?");
    $updateHomeAddress->bind_param("isssssssssssi", $unit, $blk, $streetName, $subdivision, $barangay, $city, $country, $province, $zipCode, $email, $telephone, $mobile, $id);
    
    if (!$updateHomeAddress->execute()) {
        error_log("Error updating tbl_hadress: " . $updateHomeAddress->error);
    }
    $updateHomeAddress->close();

    
    $fatherLastName = $_POST['father_lastname'];
    $fatherFirstName = $_POST['father_firstname'];
    $fatherMiddleName = $_POST['father_middle'];
   
    $updateFathersinfo = $conn->prepare("UPDATE tbl_finfo SET f_lname = ?, f_fname = ?, f_middle = ? WHERE f_id = ?");
    $updateFathersinfo ->bind_param("sssi", $fatherlastName, $fatherfirstName, $fathermiddleName, $id);

   
    if (!$updateFathersinfo->execute()) {
        error_log("Error updating tbl_finfo: " . $updateFathersinfo->error);
    }
    $updateFathersinfo->close();

    $motherLastName = $_POST['mother_lastname'];
    $motherFirstName = $_POST['mother_firstname'];
    $motherMiddleName = $_POST['mother_middle'];

    $updateMothersinfo = $conn->prepare("UPDATE tbl_minfo SET m_lname = ?, m_fname = ?, m_middle = ? WHERE m_id = ?");
    $updateMothersinfo->bind_param("sssi", $motherlastName, $motherfirstName, $mothermiddleName, $id);

    if (! $updateMothersinfo->execute()) {
        error_log("Error updating tbl_parents: " .  $updateMothersinfo->error);
    }
    $updateMothersinfo->close();

           
            header("Location: details.php");
            exit();
        }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Data Form</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function toggleOthersField() {
            var status = document.getElementById("civil_status").value;
            var othersField = document.getElementById("others_input");
            othersField.style.display = (status === "Others") ? "block" : "none";
        }
    </script>
</head>
<body>
<div class="wrapper">
    <header class="header">
        <h2>Test_<span>Form</span></h2>
    </header>
    <div class="main">
        <section class="container">
            <form action="index.php" method="POST" class="form">
                <h1>Personal Data</h1>
                <div class="input-box">
                    <label for="personal_lastname">Last Name</label>
                    <input type="text" name="personal_lastname" placeholder="Enter last Name" required value="<?= htmlspecialchars($record['p_lname']) ?>">
                </div>
                <div class="input-box">
                    <label for="personal_firstname">First Name</label>
                    <input type="text" name="personal_firstname" placeholder="Enter First Name" required value="<?= htmlspecialchars($record['p_fname']) ?>">
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="personal_middle">Middle Name</label>
                        <input type="text" name="personal_middle" placeholder="Enter Middle Initial" required value="<?= htmlspecialchars($record['p_middle']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="date">Date of Birth</label>
                        <input type="date" id="date" name="date" required value="<?= htmlspecialchars($record['p_bdate']) ?>">
                    </div>
                </div>
                <div class="radio">
                    <label>Sex:</label>
                    <label for="Male">Male</label>
                    <input type="radio" id="Male" name="sex" value="Male" required <?= ($record['p_sex'] == 'Male') ? 'checked' : ''; ?>>
                    <label for="Female">Female</label>
                    <input type="radio" id="Female" name="sex" value="Female" required <?= ($record['p_sex'] == 'Female') ? 'checked' : ''; ?>>
                </div>
                <div class="Select">
                    <label for="civil_status">Civil Status:</label>
                    <select id="civil_status" name="civil_status" onchange="toggleOthersField()">
                        <option value="">Select</option>
                        <option value="Single" <?= ($record['p_civilstatus'] == 'Single') ? 'selected' : '' ?>>Single</option>
                        <option value="Widowed" <?= ($record['p_civilstatus'] == 'Widowed') ? 'selected' : '' ?>>Widowed</option>
                        <option value="Divorce" <?= ($record['p_civilstatus'] == 'Divorce') ? 'selected' : '' ?>>Divorced</option>
                        <option value="Separated" <?= ($record['p_civilstatus'] == 'Separated') ? 'selected' : '' ?>>Separated</option>
                        <option value="Others" <?= ($record['p_civilstatus'] == 'Others') ? 'selected' : '' ?>>Others</option>
                    </select>
                    <input type="text" id="others_input" name="others" placeholder="Please specify civil status" style="display: none;">
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="tax">Tax Identification No.</label>
                        <input type="text" name="tax" id="tax" required value="<?= htmlspecialchars($record['p_taxno']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="religion">Religion</label>
                        <input type="text" name="religion" placeholder="Enter Religion" value="<?= htmlspecialchars($record['p_religion']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="nationality">Nationality</label>
                        <input type="text" name="nationality" placeholder="Enter Nationality" required value="<?= htmlspecialchars($record['p_nationality']) ?>">
                    </div>
                </div>
                <h2>Place of Birth</h2>
                <div class="column">
                    <div class="input-box">
                        <label for="bldg">RM/FLR/Unit No. & Bldg. Name</label>
                        <input type="text" name="bldg" id="bldg" value="<?= htmlspecialchars($record['pob_unitno']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="blk">House/Lot & Blk. No</label>
                        <input type="text" name="blk" id="blk" value="<?= htmlspecialchars($record['pob_blk']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="sn">Street Name</label>
                        <input type="text" name="sn" id="sn" value="<?= htmlspecialchars($record['pob_sn']) ?>">
                    </div>
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="subdivision">Subdivision</label>
                        <input type="text" name="subdivision" id="subdivision" value="<?= htmlspecialchars($record['pob_subdivision']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="barangay">Barangay/District</label>
                        <input type="text" name="barangay" id="barangay" value="<?= htmlspecialchars($record['pob_barangay']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="city">City/Municipality</label>
                        <input type="text" name="city" id="city" value="<?= htmlspecialchars($record['pob_city']) ?>">
                    </div>
                </div>
                <div class="input-box">
                    <label>Country</label>
                    <select name="country" id="country" required>
                        <option value="" disabled selected>Select</option>
                        <?php
                        // Assuming you have a function to get the countries
                        foreach ($countries as $country) {
                            $selected = ($country == $placeOfBirth['pob_country']) ? 'selected' : '';
                            echo "<option value=\"$country\" $selected>$country</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="province">Province</label>
                        <input id="province" type="text" name="province" value="<?= htmlspecialchars($record['pob_province']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="bzip">Zip Code</label>
                        <input type="text" name="bzip" id="bzip" value="<?= htmlspecialchars($record['pob_zipcode']) ?>">
                    </div>
                </div>
                <h2>Home Address</h2>
                <div class="column">
                    <div class="input-box">
                        <label for="hbldg">RM/FLR/Unit No. & Bldg. Name</label>
                        <input id="hbldg" type="text" name="hbldg" placeholder="RM/FLR/Unit" required value="<?= htmlspecialchars($record['ha_unitno']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="hblk">House/Lot & Blk. No</label>
                        <input id="hblk" type="text" name="hblk" placeholder="House/Lot No." required value="<?= htmlspecialchars($record['ha_blkno']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="hsn">Street Name</label>
                        <input id="hsn" type="text" name="hsn" placeholder="Street Name" required value="<?= htmlspecialchars($record['ha_sn']) ?>">
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="hsubdivision">Subdivision</label>
                        <input id="hsubdivision" type="text" name="hsubdivision" placeholder="Subdivision" value="<?= htmlspecialchars($record['ha_subdivision']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="hbarangay">Barangay/District</label>
                        <input id="hbarangay" type="text" name="hbarangay" placeholder="Barangay/District" value="<?= htmlspecialchars($record['ha_barangay']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="hcity">City/Municipality</label>
                        <input id="hcity" type="text" name="hcity" placeholder="City/Municipality" value="<?= htmlspecialchars($record['ha_city']) ?>">
                    </div>
                </div>
                <div class="input-box">
                    <label>Country</label>
                    <select name="hcountry" id="hcountry" required>
                        <option value="" disabled selected>Select</option>
                        <?php
                        foreach ($countries as $country) {
                            $selected = ($country == $homeAddress['ha_country']) ? 'selected' : '';
                            echo "<option value=\"$country\" $selected>$country</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="hprovince">Province</label>
                        <input id="hprovince" type="text" name="hprovince" placeholder="Province" value="<?= htmlspecialchars($record['ha_province']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="hzip">Zip Code</label>
                        <input type="text" name="hzip" id="hzip" value="<?= htmlspecialchars($record['ha_zipcode']) ?>">
                    </div>
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="number">Mobile/Cellphone No.</label>
                        <input type="text" name="number" id="number" required value="<?= htmlspecialchars($record['ha_mobileno']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="email">E-mail Address</label>
                        <input id="email" type="email" name="email" placeholder="E-mail Address" required value="<?= htmlspecialchars($record['ha_email']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="tel">Telephone Number</label>
                        <input type="text" name="tel" id="tel" required value="<?= htmlspecialchars($record['ha_telno']) ?>">
                    </div>
                </div>
                <h2>Father's Name</h2>
                <div class="column">
                    <div class="input-box">
                        <label for="father_lastname">Last Name</label>
                        <input type="text" name="father_lastname" placeholder="Enter Last Name" value="<?= htmlspecialchars($record['f_lname']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="father_firstname">First Name</label>
                        <input type="text" name="father_firstname" placeholder="Enter First Name" value="<?= htmlspecialchars($record['f_fname']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="father_middle">Middle Initial</label>
                        <input type="text" name="father_middle" placeholder="Enter Middle Name" value="<?= htmlspecialchars($record['f_middle']) ?>">
                    </div>
                </div>
                <h2>Mother's Name</h2>
                <div class="column">
                    <div class="input-box">
                        <label for="mother_lastname">Last Name</label>
                        <input type="text" name="mother_lastname" placeholder="Enter Last Name" value="<?= htmlspecialchars($record['m_lname']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="mother_firstname">First Name</label>
                        <input type="text" name="mother_firstname" placeholder="Enter First Name" value="<?= htmlspecialchars($record['m_fname']) ?>">
                    </div>
                    <div class="input-box">
                        <label for="mother_middle">Middle Initial</label>
                        <input type="text" name="mother_middle" placeholder="Enter Middle Name" value="<?= htmlspecialchars($record['m_middle']) ?>">
                    </div>
                </div>

                <div class="buttons">
                    <div class="error-container">
                        <?php if (!empty($errors)): ?>
                            <div class="error">
                                <?php echo implode('<br>', $errors); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="button">
                        <button type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
<script src="main.js"></script>

</body>
</html>
