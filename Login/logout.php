<?php
session_start();
if(isset($_POST['logout']))
{
    if(session_destroy()) {
        header("Location: ../Rustom/Rustom.html");
     }
}
?>

<!-- 
    Include this button in place of logout
    Note: Modify the action properly

<form id="logout" action="Login/logout.php" method ="post">
    <button type="submit" name="logout" class="btn btn-primary">Logout</button>
</form> 

-->