<?php
    // Starts the session
    session_start();
?>
<!-- Adds the header to the page -->
<?php include('header.php'); ?>
<main>
    <!-- Displays the add error heading -->
    <h2>Add Error</h2>
    <!-- Displays the add error message -->
    <p>There was an error adding the tattoo to the database.</p>
    <p>
        Error Message:
        <?php echo htmlspecialchars($_SESSION['add_error']); ?>
    </p>
    <!-- Displays the navigation links -->
    <p><a href="add_tattoo_form.php">Add Tattoo</a></p>
    <p><a href="index.php">View Tattoo Gallery</a></p>
</main>
<!-- Adds the footer to the page -->
<?php include('footer.php'); ?>