<?php
session_start();
include 'db.php';

if (!isset($_SESSION['form_data'])) {
    header("Location: index.php");
    exit();
}

$formData = $_SESSION['form_data'];
unset($_SESSION['form_data']); // Clear session data after use

// Insert into tbl_personal
$stmt = $conn->prepare("INSERT INTO tbl_personal(p_lname, p_fname, p_middle, p_bdate, p_sex, p_civilstatus, p_taxno, p_religion, p_nationality) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", 
    $formData['personal_lastname'], 
    $formData['personal_firstname'], 
    $formData['personal_middle'], 
    $formData['dob'], 
    $formData['sex'], // Added missing 'sex' field
    $formData['civilStatus'], // Added missing 'civilStatus' field
    $formData['taxId'], // Added missing 'taxId' field
    $formData['religion'], 
    $formData['nationality']
);

$stmt->execute();
$uId = $stmt->insert_id; // Get the inserted ID
$stmt->close(); // Close the statement

// Insert into tbl_placeofbirth
$stmt = $conn->prepare("INSERT INTO tbl_placeofbirth(pob_unitno, pob_blk, pob_sn, pob_subdivision, pob_barangay, pob_city, pob_country, pob_province, pob_zipcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", 
    $formData['birth']['bldg'], 
    $formData['birth']['blk'], 
    $formData['birth']['sn'], 
    $formData['birth']['subdivision'], 
    $formData['birth']['barangay'], 
    $formData['birth']['city'], 
    $formData['birth']['country'], 
    $formData['birth']['province'], 
    $formData['birth']['bzip']
);

$stmt->execute();
$bId = $stmt->insert_id; // Get the inserted ID
$stmt->close(); // Close the statement

// Insert into tbl_hadress
$stmt = $conn->prepare("INSERT INTO tbl_hadress(ha_unitno, ha_blkno, ha_sn, ha_subdivision, ha_barangay, ha_city, ha_country, ha_province, ha_zipcode, ha_email, ha_telno, ha_mobileno) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssss", 
    $formData['address']['hbldg'], 
    $formData['address']['hblk'], 
    $formData['address']['hsn'], 
    $formData['address']['hsubdivision'], 
    $formData['address']['hbarangay'], 
    $formData['address']['hcity'], 
    $formData['address']['hcountry'], 
    $formData['address']['hprovince'], 
    $formData['address']['hzip'], 
    $formData['address']['email'], 
    $formData['address']['tel'], 
    $formData['address']['number']
);

$stmt->execute();
$hId = $stmt->insert_id; // Get the inserted ID
$stmt->close(); // Close the statement

// Insert into tbl_minfo (Mother's Information)
$stmt = $conn->prepare("INSERT INTO tbl_minfo(m_lname, m_fname, m_middle) VALUES (?, ?, ?)");
$stmt->bind_param("sss", 
    $formData['mother_lastname'], 
    $formData['mother_firstname'], 
    $formData['mother_middle']
);

$stmt->execute();
$cId = $stmt->insert_id; // Get the inserted ID
$stmt->close(); // Close the statement

// Insert into tbl_finfo (Father's Information)
$stmt = $conn->prepare("INSERT INTO tbl_finfo(f_lname, f_fname, f_middle) VALUES (?, ?, ?)");
$stmt->bind_param("sss", 
    $formData['father_lastname'], 
    $formData['father_firstname'], 
    $formData['father_middle']
);
$stmt->execute();
$pId = $stmt->insert_id; 
$stmt->close(); 

// Fetch data for display
$personal = $conn->query("SELECT * FROM tbl_personal");
$placeofbirth = $conn->query("SELECT * FROM tbl_placeofbirth");
$hadress = $conn->query("SELECT * FROM tbl_hadress");
$minfo = $conn->query("SELECT * FROM tbl_minfo");
$finfo = $conn->query("SELECT * FROM tbl_finfo");

$conn->close(); 
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
        <tr>
                <th>Personal Id</th>  
                <th>Last Name</th> 
                <th>First Name</th> 
                <th>Middle Initial</th> 
                <th>Date of Birth</th> 
                <th>Sex</th> 
                <th>Civil Status</th> 
                <th>Tax ID</th> 
                <th>Religion</th>
                <th>Nationality</th> 
                <th>Action</th> <!-- New column for actions -->
        </tr>
            <?php while ($row = $personal->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['p_id'] ?></td>
                    <td><?= htmlspecialchars($row['p_lname']) ?></td>
                    <td><?= htmlspecialchars($row['p_fname']) ?></td>
                    <td><?= htmlspecialchars($row['p_middle']) ?></td>
                    <td><?= htmlspecialchars($row['p_bdate']) ?></td>
                    <td><?= htmlspecialchars($row['p_sex']) ?></td>
                    <td><?= htmlspecialchars($row['p_civilstatus']) ?></td>
                    <td><?= htmlspecialchars($row['p_taxno']) ?></td>
                    <td><?= htmlspecialchars($row['p_religion']) ?></td>
                    <td><?= htmlspecialchars($row['p_nationality']) ?></td>
                    <td>
                        <form action="update.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['p_id'] ?>">
                            <button type="submit">Update</button>
                        </form>
                        <form action="delete.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['p_id'] ?>">
                            <input type="hidden" name="table" value="personal">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <h2>Place of Birth</h2>
        <table class="info-table">
            <tr>
                <th>Birth Id</th>  
                <th>Unit</th> 
                <th>Block Area</th> 
                <th>Street Name</th> 
                <th>Subdivision</th> 
                <th>Barangay</th> 
                <th>City</th> 
                <th>Province</th> 
                <th>Country</th> 
                <th>Zip Code</th>
                <th>Action</th> <!-- New column for actions -->
            </tr>
            <?php while ($row = $placeofbirth->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['pob_id'] ?></td>
                    <td><?= htmlspecialchars($row['pob_unitno']) ?></td>
                    <td><?= htmlspecialchars($row['pob_blk']) ?></td>
                    <td><?= htmlspecialchars($row['pob_sn']) ?></td>
                    <td><?= htmlspecialchars($row['pob_subdivision']) ?></td>
                    <td><?= htmlspecialchars($row['pob_barangay']) ?></td>
                    <td><?= htmlspecialchars($row['pob_city']) ?></td>
                    <td><?= htmlspecialchars($row['pob_country']) ?></td>
                    <td><?= htmlspecialchars($row['pob_province']) ?></td>
                    <td><?= htmlspecialchars($row['pob_zipcode']) ?></td>
                    <td>
                        <form action="update.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['pob_id'] ?>">
                            <button type="submit">Update</button>
                        </form>
                        <form action="delete.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['pob_id'] ?>">
                            <input type="hidden" name="table" value="placeofbirth">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <h2>Home Address</h2>
        <table class="info-table">
            <tr>
                <th>Home Id</th>  
                <th>Unit</th> 
                <th>Block Area</th> 
                <th>Street Name</th> 
                <th>Subdivision</th> 
                <th>Barangay</th> 
                <th>City</th> 
                <th>Province</th> 
                <th>Country</th> 
                <th>Zip Code</th>
                <th>Email</th>
                <th>Telephone</th> 
                <th>Mobile</th> 
                <th>Action</th> 
            </tr>
            <?php while ($row = $hadress->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['ha_id'] ?></td>
                    <td><?= htmlspecialchars($row['ha_unitno']) ?></td>
                    <td><?= htmlspecialchars($row['ha_blkno']) ?></td>
                    <td><?= htmlspecialchars($row['ha_sn']) ?></td>
                    <td><?= htmlspecialchars($row['ha_subdivision']) ?></td>
                    <td><?= htmlspecialchars($row['ha_barangay']) ?></td>
                    <td><?= htmlspecialchars($row['ha_city']) ?></td>
                    <td><?= htmlspecialchars($row['ha_country']) ?></td>
                    <td><?= htmlspecialchars($row['ha_province']) ?></td>
                    <td><?= htmlspecialchars($row['ha_zipcode']) ?></td>
                    <td><?= htmlspecialchars($row['ha_email']) ?></td>
                    <td><?= htmlspecialchars($row['ha_telno']) ?></td>
                    <td><?= htmlspecialchars($row['ha_mobileno']) ?></td>
                    <td>
                        <form action="update.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['ha_id'] ?>">
                            <button type="submit">Update</button>
                        </form>
                        <form action="delete.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['ha_id'] ?>">
                            <input type="hidden" name="table" value="hadress">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <h2>Father's Information</h2>
        <table class="info-table">
            <tr>
                <th>Father's Id</th> 
                <th>Father's Last Name</th> 
                <th>Father's First Name</th> 
                <th>Father's Middle Initial</th>
                <th>Action</th> 
            </tr>
            <?php while ($row = $finfo->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['f_id'] ?></td>
                    <td><?= htmlspecialchars($row['f_lname']) ?></td>
                    <td><?= htmlspecialchars($row['f_fname']) ?></td>
                    <td><?= htmlspecialchars($row['f_middle']) ?></td>
                    <td>
                        <form action="update.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['f_id'] ?>">
                            <button type="submit">Update</button>
                        </form>
                        <form action="delete.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['f_id'] ?>">
                            <input type="hidden" name="table" value="finfo">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <h2>Mother's Information</h2>
        <table class="info-table">
            <tr>
                <th>Mother's Id</th> 
                <th>Mother's Last Name</th> 
                <th>Mother's First Name</th> 
                <th>Mother's Middle Initial</th>
                <th>Action</th> 
            </tr>
            <?php while ($row = $minfo->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['m_id'] ?></td>
                    <td><?= htmlspecialchars($row['m_lname']) ?></td>
                    <td><?= htmlspecialchars($row['m_fname']) ?></td>
                    <td><?= htmlspecialchars($row['m_middle']) ?></td>
                    <td>
                        <form action="update.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['m_id'] ?>">
                            <button type="submit">Update</button>
                        </form>
                        <form action="delete.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['m_id'] ?>">
                            <input type="hidden" name="table" value="minfo">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                        </form>
                    </td>
                </tr>  
            <?php endwhile; ?>
        </table>

        <div class="nbutton">
            <button onclick="window.location.href='index.php'" class="backBtn">Add</button>
        </div>
        
        </section>
    </div>
</div>

</body>
</html>