<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">

    <script>
        function toggleOthersField() {
            var status = document.getElementById("civil_status").value;
            var othersField = document.getElementById("others_input");
            if (status === "Others") {
                othersField.style.display = "block";
            } else {
                othersField.style.display = "none";
            }
        }
    </script>

</head>
<body>

<div class="wrapper">

<header class="header">
      <h2>Test_<span>Form</span></h2>
    </header>

<div class="main">

<?php

//php part

$errors = [];
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   
    if (!empty($_POST['personal_lastname']) && preg_match('/\d/', $_POST['personal_lastname'])) {
        $errors[] = 'Last name must not contain numbers.';
    }
    if (!empty($_POST['personal_firstname']) && preg_match('/\d/', $_POST['personal_firstname'])) {
        $errors[] = 'First name must not contain numbers.';
    }
    if (!empty($_POST['personal_middle']) && preg_match('/\d/', $_POST['personal_middle'])) {
        $errors[] = 'Middle initial must not contain numbers.';
    }

    
    if (!empty($_POST['father_lastname']) && preg_match('/\d/', $_POST['father_lastname'])) {
        $errors[] = 'Father\'s last name must not contain numbers.';
    }
    if (!empty($_POST['father_firstname']) && preg_match('/\d/', $_POST['father_firstname'])) {
        $errors[] = 'Father\'s first name must not contain numbers.';
    }
    if (!empty($_POST['father_middle']) && preg_match('/\d/', $_POST['father_middle'])) {
        $errors[] = 'Father\'s middle initial must not contain numbers.';
    }

   
    if (!empty($_POST['mother_lastname']) && preg_match('/\d/', $_POST['mother_lastname'])) {
        $errors[] = 'Mother\'s last name must not contain numbers.';
    }
    if (!empty($_POST['mother_firstname']) && preg_match('/\d/', $_POST['mother_firstname'])) {
        $errors[] = 'Mother\'s first name must not contain numbers.';
    }
    if (!empty($_POST['mother_middle']) && preg_match('/\d/', $_POST['mother_middle'])) {
        $errors[] = 'Mother\'s middle initial must not contain numbers.';
    }

    
    if (!empty($_POST['date'])) {
        $dob = new DateTime($_POST['date']); 
        $today = new DateTime(); 
        $age = $today->diff($dob)->y; 
        if ($age < 18) {
            $errors[] = "You must be at least 18 years old to submit this form.";
        }
    } else {
        $errors[] = "Date of Birth is required.";
    }

    
    if (!empty($_POST['number']) && !preg_match('/^\d+$/', $_POST['number'])) {
        $errors[] = "Mobile number must contain only numbers.";
    }

    
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address format.";
    }
    
    if (!empty($_POST['tax_no']) && !preg_match('/^\d+$/', $_POST['tax_no'])) {
        $errors[] = "Tax No must contain only numbers.";
    }

   
    if (empty($errors)) {
        $success_message = "<p style='color: green; font-weight: bold;'>Form submitted successfully!</p>";
    }
}


?>


<section class="container">

    <form action="" method="POST">
    <h1>Personal Data</h1>

    <div class="input-box">

     <label for="personal_lastname">Last Name</label> 
     <input id="personal_lastname" type="text" name="personal_lastname" placeholder="Last Name" required>

    <label for="personal_firstname">First Name</label> 
    <input id="personal_firstname" type="text" name="personal_firstname" placeholder="First Name" required> 


    </div>

    <div class="input-box">
    
    <label for="personal_middle">Middle Name</label> 
    <input id="personal_middle" type="text" name="personal_middle" placeholder="Middle Name" required>

    <label for="date">Date of Birth</label> 
    <input id="date" type="date" name="date" required> 

    </div>

    <div class="input-box">
      
      <div class="radio">
      <label for="Sex">Sex</label>
      <label for="Male">Male</label>
      <input type="radio" id="Male" name="sex" value="Male" required>
      <label for="Female">Female</label>
      <input type="radio" id="Female" name="sex" value="Female" required>  
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

    </div>
    
    <div class="input-box">
 
    <label for="tax">Tax Identification No.</label> 
      <input id="tax_no" type="text" name="tax_no" placeholder="Tax Id. No"  > 
     
     
      <label for="religion">Religion</label> 
      <input id="religion" type="text" name="religion" placeholder="Religion">

    </div>

    <div class="input-box">

    <label for="nationality">Nationality</label> 
    <input id="nationality" type="text" name="nationality" placeholder="Nationality" required> 

    </div>

    <div class="input-box">

    
    </div>
 
    <h2>Place of birth</h2>

    <div class="input-box">

      <label for="bldg">RM/FLR/Unit No. & Bldg. Name</label> 
      <input id="bldg" type="bldg" name="bldg" placeholder="RM/FLR/Unit" required>

    </div>

    <div class="input-box">

    <label for="blk">House/Lot & Blk. No</label> 
      <input id="blk" type="blk" name="blk" placeholder="House/Lot No." required>

    </div>



    <div class="input-box">

    <label for="sn">Street Name</label> 
    <input id="sn" type="sn" name="sn"  placeholder="Street Name" required>

     <label for="subdivision">Subdivision</label> 
      <input id="subdivision" type="subdivision" name="subdivision" placeholder="Subdivision">
      
    </div>

    <div class="input-box">
    <label for="barangay">Barangay/District</label> 
      <input id="barangay" type="barangay" name="barangay" placeholder="Barangay/District">
    
      <label for="city">City/Municipality</label> 
      <input id="city" type="city" name="city" placeholder="City/Municipality"> 

    </div>

    <div class="input-box">


      <label for="province">Province</label> 
      <input id="province" type="province" name="province" placeholder="Province">
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
                         "Viet Nam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe", "Åland Islands"
                      ];

                        foreach ($countries as $country) {
                            echo "<option value=\"$country\">$country</option>";
                        }
                    ?>
                </select>

                <label for="zip">Zip Code</label> 
    <input id="zip" type="zip" name="zip" placeholder="Zip Code">
    </div>



    <h2>Home Address</h2>

    <div class="input-box">

    <label for="bldg">RM/FLR/Unit No. & Bldg. Name</label> 
      <input id="bldg" type="bldg" name="bldg" placeholder="RM/FLR/Unit" required>


    </div>

    <div class="input-box">
    <label for="blk">House/Lot & Blk. No</label> 
      <input id="blk" type="blk" name="blk" placeholder="House/Lot No" required>

    
    </div>

    <div class="input-box">

    <label for="sn">Street Name</label> 
    <input id="sn" type="sn" name="sn" placeholder="Street Name" required>

    <label for="subdivision">Subdivision</label> 
    <input id="subdivision" type="subdivision" name="subdivision" placeholder="Subdivision" required>
      

    </div>

    <div class="input-box">
    <label for="barangay">Barangay/District</label> 
      <input id="barangay" type="barangay" name="barangay" placeholder="Barangay/District">
    
      <label for="city">City/Municipality</label> 
      <input id="city" type="city" name="city" placeholder="City/Municipality"> 

    </div>

    <div class="input-box">


<label for="province">Province</label> 
<input id="province" type="province" name="province" placeholder="Province">
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
                         "Viet Nam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe", "Åland Islands"
                      ];

                        foreach ($countries as $country) {
                            echo "<option value=\"$country\">$country</option>";
                        }
                    ?>
                </select> 

                <label for="zip">Zip Code</label> 
      <input id="zip" type="zip" name="zip" placeholder="Zip Code" required> 
    </div>

    <div class="input-box">
  

      <label for="number">Mobile/Cellphone No.</label>
      <input id="number" type="mobile number" name="number" placeholder="Mobile/Cell No." required>

    </div>

    <div class="input-box">
    <label for="email">E-mail Address</label>
    <input id="email" type="email" name="email" placeholder="E-mail Adress">
    </div>

    <div class="input-box">

      <label for="tel">Telephone Number</label>
      <input id="tel" type="tel" name="tel" placeholder="Telephone No.">

    </div>

    <h2>Father's Name</h2>

    <div class="input-box">
  
<label for="father_lastname">Last Name</label> 
<input id="father_lastname" type="text" name="father_lastname" placeholder="Last Name"> 

<label for="father_firstname">First Name</label> 
<input id="father_firstname" type="text" name="father_firstname" placeholder="First Name"> 

</div>


<div class="input-box">
<label for="father_middle">Middle Initial</label> 
<input id="father_middle" type="text" name="father_middle" placeholder="Middle Name">
      
</div>

      

    <h2>Mother's Name</h2>

    <div class="input-box">

<label for="mother_lastname">Last Name</label> 
<input id="mother_lastname" type="text" name="mother_lastname" placeholder="Last Name"> 

<label for="mother_firstname">First Name</label> 
<input id="mother_firstname" type="text" name="mother_firstname" placeholder="First Name"> 

    </div>

    <div class="input-box">
    <label for="mother_middle">Middle Initial</label> 
<input id="mother_middle" type="text" name="mother_middle" placeholder="Middle Name">

    </div>

    <div class="button">
      <button type="submit">Submit</button>
      </div>

      <div class="validation-messages">
        <?php
        if (!empty($errors)) {
            echo "<div style='color: red; font-weight: bold;'>";
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            echo "</div>";
        }

        echo $success_message;
        ?>
    </div>

    </form>


   </section>






</div>  
</div> 

<script src="main.js"></script>


</body>
</html>