<?php include_once('includes/header.php'); 

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>

Welcome, <?php echo $_SESSION['fullname'] ?> you can now book your train ticket.

<?php include_once('includes/footer.php'); ?>