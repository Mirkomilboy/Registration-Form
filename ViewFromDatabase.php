<?php
 require_once("Include/DB.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data From Database</title>
</head>
<body>
    <!-- Creating table for showing data from database -->
    <table width="1000" border="5" align="center">
        <caption>View From Database</caption>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Second Phone</th>
            <th>Home Address</th>
            <th>Delete Candidate</th>
        </tr>
        <!-- PHP code for fetching data -->
        <?php
         global $ConnectingDB;
         $sql = "SELECT * FROM candidate";
         $stmt = $ConnectingDB->query($sql);
         while ($DataRows=$stmt->fetch()) {
             $Id           = $DataRows["id"];
             $FirstName    = $DataRows["firstName"];
             $LastName     = $DataRows["lastName"];
             $PhoneNumber  = $DataRows["phoneNumber"];
             $SecondPhone  = $DataRows["optionalPhone"];
             $HomeAddress  = $DataRows["homeAddress"];
        ?>
        <tr>
            <td><?php echo $Id ?></td>
            <td><?php echo $FirstName ?></td>
            <td><?php echo $LastName ?></td>
            <td><?php echo $PhoneNumber ?></td>
            <td><?php echo $SecondPhone?></td>
            <td><?php echo $HomeAddress?></td>
            <td><a href="Delete.php?id=<?php echo $Id; ?>">Delete</a></td>
        </tr>
         <?php } ?>
    </table>
</body>
</html>