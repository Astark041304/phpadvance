<?php
session_start();
include 'db.php';

function calculateAge($dob) {
    $dobDate = new DateTime($dob);
    $today = new DateTime();
    return $today->diff($dobDate)->y;
}

$errors = [];
$success = false;

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
    <link rel="stylesheet" href="index.css">
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
                    <input type="text" name="personal_lastname" placeholder="Enter last Name" required value="<?php echo htmlspecialchars($lastName ?? ''); ?>">
                </div>
                <div class="input-box">
                    <label for="personal_firstname">First Name</label>
                    <input type="text" name="personal_firstname" placeholder="Enter First Name" required value="<?php echo htmlspecialchars($firstName ?? ''); ?>">
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="personal_middle">Middle Name</label>
                        <input type="text" name="personal_middle" placeholder="Enter Middle Initial" required value="<?php echo htmlspecialchars($middleName ?? ''); ?>">
                    </div>
                    <div class="input-box">
                        <label for="date">Date of Birth</label>
                        <input type="date" id="date" name="date" required value="<?php echo htmlspecialchars($dateOfBirth ?? ''); ?>">
                    </div>
                </div>
                <div class="radio">
                    <label for="Male">Sex:</label>
                    <label for="Male">Male</label>
                    <input type="radio" id="Male" name="sex" value="Male" required <?php echo (isset($sex) && $sex == 'Male') ? 'checked' : ''; ?>>
                    <label for="Female">Female</label>
                    <input type="radio" id="Female" name="sex" value="Female" required <?php echo (isset($sex) && $sex == 'Female') ? 'checked' : ''; ?>>
                </div>
                <div class="Select">
                    <label for="civil_status">Civil Status:</label>
                    <select id="civil_status" name="civil_status" onchange="toggleOthersField()">
                        <option value="">Select</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Separated">Separated</option>
                        <option value="Others">Others</option>
                    </select>
                    <input type="text" id="others_input" name="others" placeholder="Please specify civil status" style="display: none;">
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="tax">Tax Identification No.</label>
                        <input type="text" name="tax" id="tax" required value="<?php echo htmlspecialchars($taxId ?? ''); ?>">
                    </div>
                    <div class="input-box">
                        <label for="religion">Religion</label>
                        <input type="text" name="religion" placeholder="Enter Religion" value="<?php echo htmlspecialchars($religion ?? ''); ?>">
                    </div>
                    <div class="input-box">
                        <label for="nationality">Nationality</label>
                        <input type="text" name="nationality" placeholder="Enter Nationality" required value="<?php echo htmlspecialchars($nationality ?? ''); ?>">
                    </div>
                </div>
                <h2>Place of Birth</h2>
                <div class="column">
                    <div class="input-box">
                        <label for="bldg">RM/FLR/Unit No. & Bldg. Name</label>
                        <input type="text" name="bldg" id="bldg" value="<?php echo htmlspecialchars($birthunit ?? ''); ?>">
                    </div>
                    <div class="input-box">
                        <label for="blk">House/Lot & Blk. No</label>
                        <input type="text" name="blk" id="blk" value="<?php echo htmlspecialchars($birthblk ?? ''); ?>">
                    </div>
                    <div class="input-box">
                        <label for="sn">Street Name</label>
                        <input type="text" name="sn" id="sn" value="<?php echo htmlspecialchars($birthstreetName ?? ''); ?>">
                    </div>
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="subdivision">Subdivision</label>
                        <input type="text" name="subdivision" id="subdivision" value="<?php echo htmlspecialchars($birthsubdivision ?? ''); ?>">
                    </div>
                    <div class="input-box">
                        <label for="barangay">Barangay/District</label>
                        <input type="text" name="barangay" id="barangay" value="<?php echo htmlspecialchars($birthbarangay ?? ''); ?>">
                    </div>
                    <div class="input-box">
                        <label for="city">City/Municipality</label>
                        <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($birthcity ?? ''); ?>">
                    </div>
                </div>
                <div class="input-box">
                    <label>Country</label>
                    <select name="country" id="country" required>
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
                            echo "<option value=\"$country\">$country</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="province">Province</label>
                        <input type="text" name="province" id="province" value="<?php echo htmlspecialchars($birthprovince ?? ''); ?>">
                    </div>
                    <div class="input-box">
                        <label for="bzip">Zip Code</label>
                        <input type="text" name="bzip" id="bzip" value="<?php echo htmlspecialchars($birthzipCode ?? ''); ?>">
                    </div>
                </div>
                <h2>Home Address</h2>
                <div class="column">
                    <div class="input-box">
                        <label for="hbldg">RM/FLR/Unit No. & Bldg. Name</label>
                        <input id="hbldg" type="text" name="hbldg" placeholder="RM/FLR/Unit" required>
                    </div>
                    <div class="input-box">
                        <label for="hblk">House/Lot & Blk. No</label>
                        <input id="hblk" type="text" name="hblk" placeholder="House/Lot No." required>
                    </div>
                    <div class="input-box">
                        <label for="hsn">Street Name</label>
                        <input id="hsn" type="text" name="hsn" placeholder="Street Name" required>
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="hsubdivision">Subdivision</label>
                        <input id="hsubdivision" type="text" name="hsubdivision" placeholder="Subdivision">
                    </div>
                    <div class="input-box">
                        <label for="hbarangay">Barangay/District</label>
                        <input id="hbarangay" type="text" name="hbarangay" placeholder="Barangay/District">
                    </div>
                    <div class="input-box">
                        <label for="hcity">City/Municipality</label>
                        <input id="hcity" type="text" name="hcity" placeholder="City/Municipality">
                    </div>
                </div>
                <div class="input-box">
                    <label>Country</label>
                    <select name="hcountry" id="hcountry" required>
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
                            echo "<option value=\"$country\">$country</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="hprovince">Province</label>
                        <input id="hprovince" type="text" name="hprovince" placeholder="Province">
                    </div>
                    <div class="input-box">
                        <label for="hzip">Zip Code</label>
                        <input type="text" name="hzip" id="hzip" value="<?php echo htmlspecialchars($zipCode ?? ''); ?>">
                    </div>
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="number">Mobile/Cellphone No.</label>
                        <input type="text" name="number" id="number" required value="<?php echo htmlspecialchars($mobile ?? ''); ?>">
                    </div>
                    <div class="input-box">
                        <label for="email">E-mail Address</label>
                        <input id="email" type="email" name="email" placeholder="E-mail Address" required>
                    </div>
                    <div class="input-box">
                        <label for="tel">Telephone Number</label>
                        <input type="text" name="tel" id="tel" required value="<?php echo htmlspecialchars($telephone ?? ''); ?>">
                    </div>
                </div>
                <h2>Father's Name</h2>
                <div class="column">
                    <div class="input-box">
                        <label for="father_lastname">Last Name</label>
                        <input type="text" name="father_lastname" placeholder="Enter Last Name" value="<?php echo htmlspecialchars($fatherlastName ?? ''); ?>">
                    </div>
                    <div class="input-box">
                        <label for="father_firstname">First Name</label>
                        <input type="text" name="father_firstname" placeholder="Enter First Name" value="<?php echo htmlspecialchars($fatherfirstName ?? ''); ?>">
                    </div>
                    <div class="input-box">
                        <label for="father_middle">Middle Initial</label>
                        <input type="text" name="father_middle" placeholder="Enter Middle Name" value="<?php echo htmlspecialchars($fathermiddleName ?? ''); ?>">
                    </div>
                </div>
                <h2>Mother's Name</h2>
                <div class="column">
                    <div class="input-box">
                        <label for="mother_lastname">Last Name</label>
                        <input type="text" name="mother_lastname" placeholder="Enter Last Name" value="<?php echo htmlspecialchars($motherlastName ?? ''); ?>">
                    </div>
                    <div class="input-box">
                        <label for="mother_firstname">First Name</label>
                        <input type="text" name="mother_firstname" placeholder="Enter First Name" value="<?php echo htmlspecialchars($motherfirstName ?? ''); ?>">
                    </div>
                    <div class="input-box">
                        <label for="mother_middle">Middle Initial</label>
                        <input type="text" name="mother_middle" placeholder="Enter Middle Name" value="<?php echo htmlspecialchars($mothermiddleName ?? ''); ?>">
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






