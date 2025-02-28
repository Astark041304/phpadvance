<?php
session_start();

if (!isset($_SESSION['users']) || !is_array($_SESSION['users']) || empty($_SESSION['users'])) {
    header("Location: index.php");
    exit();
}

if (is_array($_SESSION['users'])) {
    $_SESSION['users'] = array_filter($_SESSION['users'], function($row) {
        return is_array($row) && !empty(array_filter($row));
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information</title>
    <link rel="stylesheet" href="details.css">
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
            <tr> <th>p_id</th><th>p_lname</th><th>p_fname</th><th>p_middle</th><th>p_bdate</th><th>p_sex</th><th>p_civilstatus</th><th>p_taxno</th><th>p_religion</th><th>p_nationality</th></tr>
            <?php foreach ($_SESSION['users'] as $formData): ?>
                <?php if (!empty(array_filter($formData))): ?>
                <tr>
                    <td><?php echo $formData['personalId'] ?? ''; ?></td>
                    <td><?php echo $formData['personal_lastname'] ?? ''; ?></td>
                    <td><?php echo $formData['personal_firstname'] ?? ''; ?></td>
                    <td><?php echo $formData['personal_middle'] ?? ''; ?></td>
                    <td><?php echo $formData['dob'] ?? ''; ?></td>
                    <td><?php echo $formData['sex'] ?? ''; ?></td>
                    <td><?php echo $formData['civilStatus'] ?? ''; ?></td>
                    <td><?php echo $formData['taxId'] ?? ''; ?></td>
                    <td><?php echo $formData['religion'] ?? ''; ?></td>
                    <td><?php echo $formData['nationality'] ?? ''; ?></td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>

        <h2>Place of Birth</h2>
        <table class="info-table">
            <tr><th>pob_id</th><th>pob_unitno</th><th>pob_blk</th><th>pob_sn</th><th>pob_subdivision</th><th>pob_barangay</th><th>pob_city</th><th>pob_country</th><th>pob_province</th><th>pob_zipcode</th></tr>
            <?php foreach ($_SESSION['users'] as $formData): ?>
                <?php if (!empty(array_filter($formData))): ?>
                <tr>
                    <td><?php echo $formData['placeOfBirthId'] ?? ''; ?></td>
                    <td><?php echo $formData['bldg'] ?? ''; ?></td>
                    <td><?php echo $formData['blk'] ?? ''; ?></td>
                    <td><?php echo $formData['sn'] ?? ''; ?></td>
                    <td><?php echo $formData['subdivision'] ?? ''; ?></td>
                    <td><?php echo $formData['barangay'] ?? ''; ?></td>
                    <td><?php echo $formData['city'] ?? ''; ?></td>
                    <td><?php echo $formData['country'] ?? ''; ?></td>
                    <td><?php echo $formData['province'] ?? ''; ?></td>
                    <td><?php echo $formData['bzip'] ?? ''; ?></td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
        
    <h2>Home Address</h2>
    <table class="info-table">
        <tr><th>ha_id</th><th>ha_unitno</th><th>ha_blkno</th><th>ha_sn</th><th>ha_subdivision</th><th>ha_barangay</th><th>ha_city</th><th>ha_country</th><th>ha_province</th><th>ha_zipcode</th></tr>
        <?php foreach ($_SESSION['users'] as $formData): ?>
        <?php if (!empty(array_filter($formData))): ?>
    <tr>
        <td><?php echo $formData['homeAddressId'] ?? ''; ?></td>
        <td><?php echo $formData['hbldg'] ?? ''; ?></td>
        <td><?php echo $formData['hblk'] ?? ''; ?></td>
        <td><?php echo $formData['hsn'] ?? ''; ?></td>
        <td><?php echo $formData['hsubdivision'] ?? ''; ?></td>
        <td><?php echo $formData['hbarangay'] ?? ''; ?></td>
        <td><?php echo $formData['hcity'] ?? ''; ?></td>
        <td><?php echo $formData['hcountry'] ?? ''; ?></td>
        <td><?php echo $formData['hprovince'] ?? ''; ?></td>
        <td><?php echo $formData['hzip'] ?? ''; ?></td>
    </tr>
       <?php endif; ?>
       <?php endforeach; ?>
       </table>


    <h2>Contact Info</h2>
    <table class="info-table">
    <tr><th>ha_email</th> <th>ha_telno</th> <th>ha_mobileno</th></tr>
    <?php foreach ($_SESSION['users'] as $formData): ?>
    <?php if (!empty(array_filter($formData))): ?>
    <tr>
        <td><?php echo $formData['email'] ?? ''; ?></td>
        <td><?php echo $formData['tel'] ?? ''; ?></td>
        <td><?php echo $formData['number'] ?? ''; ?></td>
    </tr>
    <?php endif; ?>
    <?php endforeach; ?>
       </table>
    
    <h2>Father's Information</h2>
    <table class="info-table">
    <tr><th>f_id</th><th>f_lname</th><th>f_fname</th><th>f_middle</th></tr>
    <?php foreach ($_SESSION['users'] as $formData): ?>
    <?php if (!empty(array_filter($formData))): ?>
        <tr>
            <td><?php echo $formData['fatherId'] ?? ''; ?></td>
            <td><?php echo $formData['father_lastname'] ?? ''; ?></td>
            <td><?php echo $formData['father_firstname'] ?? ''; ?></td>
            <td><?php echo $formData['father_middle'] ?? ''; ?></td>
        </tr>
    <?php endif; ?>
    <?php endforeach; ?>
    </table>

    <h2>Mother's Information</h2>
    <table class="info-table">
    <tr><th>m_id</th><th>m_lname</th><th>m_fname</th><th>m_middle</th></tr>
    <?php foreach ($_SESSION['users'] as $formData): ?>
    <?php if (!empty(array_filter($formData))): ?>
        <tr>
            <td><?php echo $formData['motherId'] ?? ''; ?></td>
            <td><?php echo $formData['mother_lastname'] ?? ''; ?></td>
            <td><?php echo $formData['mother_firstname'] ?? ''; ?></td>
            <td><?php echo $formData['mother_middle'] ?? ''; ?></td>
        </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    </table>
        
        <div class="nbutton">
            <button onclick="window.location.href='index.php'" class="backBtn">Add</button>
            <button onclick="window.location.href='index.php'" class="backBtn">Update</button>
            <button onclick="window.location.href='index.php'" class="backBtn">Delete</button>
        </div>

        </section>
    </div>
</div>

</body>
</html>
