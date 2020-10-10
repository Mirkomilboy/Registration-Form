<?php
require_once("Include/DB.php");
$FirstNameError="";
$LastNameError="";
$PhoneNumberError="";
$HomeAddressError="";

if(isset($_POST['Submit'])) {
    // First Name
    if(empty($_POST['FirstName'])) {
        $FirstNameError="First Name is required";
    } else {
        $FirstName=Test_User_Input($_POST['FirstName']);
        if(!preg_match("/^[A-Za-z. ]*$/",$FirstName)) {
            $FirstNameError="Only letters and white spaces are allowed!";
        }
    }
    // Last Name
    if(empty($_POST['LastName'])) {
        $LastNameError="Last Name is required";
    } else {
        $LastName=Test_User_Input($_POST['LastName']);
        if(!preg_match("/^[A-Za-z. ]*$/",$LastName)) {
            $LastNameError="Only letters and white spaces are allowed!";
        }
    }
    // Phone Number
    if(empty($_POST['PhoneNumber'])) {
        $PhoneNumberError="Phone number is required";
    } else {
        $PhoneNumber=Test_User_Input($_POST['PhoneNumber']);
        if(!preg_match("/([(+]*[0-9]+[()+. -]*)/",$PhoneNumber)) {
            $PhoneNumberError="Enter valid phone number";
        }
    }
    // Address
    if(empty($_POST['HomeAddress'])) {
        $HomeAddressError="Home Address is required";
    } else {
        $HomeAddress=Test_User_Input($_POST['HomeAddress']);
    }
    // Sending data to database
    if(!empty($_POST['FirstName']) && !empty($_POST['LastName']) && !empty($_POST['PhoneNumber']) && !empty($_POST['HomeAddress'])) {
        if((preg_match("/^[A-Za-z. ]*$/",$FirstName)==true) && (preg_match("/^[A-Za-z. ]*$/",$LastName)==true) && (preg_match("/([(+]*[0-9]+[()+. -]*)/",$PhoneNumber) == true)) {
            global $ConnectingDB;
            $sql = "INSERT INTO candidate(firstName, lastName, phoneNumber, optionalPhone, homeAddress)
            VALUES(:firstNamE, :lastNamE, :phoneNumbeR, :optionalPhonE, :homeAddresS)";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue('firstNamE', $FirstName);
            $stmt->bindValue('lastNamE', $LastName);
            $stmt->bindValue('phoneNumbeR', $PhoneNumber);
            $stmt->bindValue('optionalPhonE', ($_POST['PhoneNumberOptional']));
            $stmt->bindValue('homeAddresS', $HomeAddress);
            $Execute = $stmt->execute();
            if($Execute) {
                echo '<h2>Registered Successfully!</h2>';
            }
        } else {
            echo "<span class='Error'>Please, complete and correct your form again</span>";
        }
    }
}
function Test_User_Input($Data) {
    return $Data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form for a Course</title>
</head>
<style type="text/css">
input[type="text"],input[type="email"],textarea{
	border:  1px solid dashed;
	background-color: rgb(221,216,212);
	width: 600px;
	padding: .5em;
	font-size: 1.0em;
}
.Error{
	color: red;
}
</style>
<body>
<h2>Registration Form For a Course (course name)</h2>

<form  action="RegistrationForm.php" method="post"> 
<legend>* Please Fill Out the following Fields.</legend>
<fieldset>
First name:<br>
<input class="input" type="text" Name="FirstName" value="">
<span class="Error">*<?php echo $FirstNameError ?></span><br>
Last name:<br>
<input class="input" type="text" Name="LastName" value="">
<span class="Error">*<?php echo $LastNameError ?></span><br>
Phone number:<br>
<input class="input" type="text" Name="PhoneNumber" value="">
<span class="Error">*<?php echo $PhoneNumberError ?></span><br>
Optional phone number:<br>
<input class="input" type="text" Name="PhoneNumberOptional" value="">
<br>
Address:<br>
<input class="input" type="text" Name="HomeAddress" value="">
<span class="Error">*<?php echo $HomeAddressError ?></span><br>
<br>
<br>
<input type="Submit" Name="Submit" value="Submit Your Information">
   </fieldset>
</form>
</body>
</html>