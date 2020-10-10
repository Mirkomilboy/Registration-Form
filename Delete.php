<?php
require_once("Include/DB.php");
require_once("Include/Redirect.php");

if(isset($_GET["id"])) {
    $SearchQueryParameter = $_GET["id"];
    global $ConnectingDB;
    $sql = "DELETE FROM candidate WHERE id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
    if($Execute) {
        echo "Candidate deleted successfully";
        // create redirection page, so that's it finito
        Redirect_to("ViewFromDatabase.php");
    } else {
        echo "Candidate could not be deleted";
        Redirect_to("ViewFromDatabase.php");
    }
}
?>