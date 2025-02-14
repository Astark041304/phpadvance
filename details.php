<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    
    $personal_lastname = $_POST['personal_lastname'] ?? "";
    $personal_firstname = $_POST['personal_firstname'] ?? "";
    $personal_middle = $_POST['personal_middle'] ?? "";
    $date = $_POST['date'] ?? "";
    $sex = $_POST['sex'] ?? "";
    $civil_status = $_POST['civil_status'] ?? "";
    $nationality = $_POST['nationality'] ?? "";
    $religion = $_POST['religion'] ?? "";
    $tax_no = $_POST['tax_no'] ?? "";
    $email = $_POST['email'] ?? "";
    $zip = $_POST['zip'] ?? "";  
    $bzip = $_POST['bzip'] ?? ""; 

    
    $age = "Invalid Date";
    if (!empty($date)) {
        $dob = DateTime::createFromFormat('Y-m-d', $date);
        if ($dob) {
            $today = new DateTime();
            $age = $today->diff($dob)->y;
        } else {
            $errors[] = "Invalid Date of Birth format.";
        }
    }

  
    $bldg = $_POST['bldg'] ?? "";
    $blk = $_POST['blk'] ?? "";
    $sn = $_POST['sn'] ?? "";
    $subdivision = $_POST['subdivision'] ?? "";
    $barangay = $_POST['barangay'] ?? "";
    $city=$_POST['city'] ?? "";
    $province = $_POST['province'] ?? "";
    $country = $_POST['country'] ?? "";

    
    $hbldg = $_POST['hbldg'] ?? "";
    $hblk = $_POST['hblk'] ?? "";
    $hsn = $_POST['hsn'] ?? "";
    $hsubdivision = $_POST['hsubdivision'] ?? "";
    $hbarangay = $_POST['hbarangay'] ?? "";
    $hcity = $_POST['hcity'] ?? "";
    $hprovince = $_POST['hprovince'] ?? "";
    $hcountry = $_POST['hcountry'] ?? "";

  
    $father_lastname = $_POST['father_lastname'] ?? "";
    $father_firstname = $_POST['father_firstname'] ?? "";
    $father_middle = $_POST['father_middle'] ?? "";

   
    $mother_lastname = $_POST['mother_lastname'] ?? "";
    $mother_firstname = $_POST['mother_firstname'] ?? "";
    $mother_middle = $_POST['mother_middle'] ?? "";

    
    function validateText($text) {
        return preg_match("/^[a-zA-Z ]*$/", $text);
    }

    function validateZipcode($zipcode) {
        return preg_match("/^[0-9]{4,10}$/", $zipcode);
    }

   
    if (!validateText($personal_lastname)) $errors[] = "Invalid Last Name.";
    if (!validateText($personal_firstname)) $errors[] = "Invalid First Name.";
    if (!validateText($nationality)) $errors[] = "Invalid Nationality.";
    if (!validateText($religion)) $errors[] = "Invalid Religion.";
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid Email format.";
    if (!empty($zipCode) && !validateZipcode($zipCode)) $errors[] = "Invalid Zip Code.";
    if (!empty($birthZipCode) && !validateZipcode($birthZipCode)) $errors[] = "Invalid Birth Zip Code."; // Birth Zip Code Validation

    
    if (empty($errors)) {
        echo "<h2>Submitted Data:</h2>";
        echo "<p><strong>Name:</strong> $personal_lastname, $personal_firstname $personal_middle.</p>";
        echo "<p><strong>Date of Birth:</strong> $date</p>";
        echo "<p><strong>Age:</strong> $age</p>";
        echo "<p><strong>Sex:</strong> $sex</p>";
        echo "<p><strong>Civil Status:</strong> $civil_status</p>";
        echo "<p><strong>Nationality:</strong> $nationality</p>";
        echo "<p><strong>Religion:</strong> $religion</p>";
        echo "<p><strong>Tax ID:</strong> $tax_no</p>";
        echo "<p><strong>Email:</strong> $email</p>";

        echo "<h3>Place of Birth:</h3>";
        echo "<p><strong>Unit No. & Bldg. Name:</strong> $bldg</p>";
        echo "<p><strong>House/Lot & Blk. No:</strong> $blk</p>";
        echo "<p><strong>Street Name:</strong> $sn</p>";
        echo "<p><strong>Subdivision:</strong> $subdivision</p>";
        echo "<p><strong>Brgy/District/Locality:</strong> $barangay</p>";
        echo "<p><strong>City/Municipality:</strong> $city</p>";
        echo "<p><strong>Province:</strong> $province</p>";
        echo "<p><strong>Zip Code:</strong> $bzip</p>"; 
        echo "<p><strong>Country:</strong> $country</p>";

        echo "<h3>Home Address:</h3>";
        echo "<p><strong>Unit No. & Bldg. Name:</strong> $hbldg</p>";
        echo "<p><strong>House/Lot & Blk. No:</strong> $hblk</p>";
        echo "<p><strong>Street Name:</strong> $hsn</p>";
        echo "<p><strong>Subdivision:</strong> $hsubdivision</p>";
        echo "<p><strong>Brgy/District/Locality:</strong> $hbarangay</p>";
        echo "<p><strong>City/Municipality:</strong> $hcity</p>";
        echo "<p><strong>Province:</strong> $hprovince</p>";
        echo "<p><strong>Zip Code:</strong> $zip</p>"; 
        echo "<p><strong>Country:</strong> $hcountry</p>";

        echo "<h3>Parents:</h3>";
        echo "<p><strong>Father's Name:</strong> $father_lastname, $father_firstname $father_middle.</p>";
        echo "<p><strong>Mother's Name:</strong> $mother_lastname, $mother_firstname $mother_middle.</p>";
    } else {
        echo "<div style='color: red;'>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo "</div>";
    }
}
?>

<button onclick="window.location.href='index.php'" class="backBtn">Back</button>


