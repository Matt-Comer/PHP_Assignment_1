<?php
    // Starts the session
    session_start();
?>
<!-- Adds the header to the page -->
<?php include('header.php'); ?>

<main>
    <!-- Displays the confirmation heading -->
    <h2>Update Tattoo Confirmation</h2>
    <!-- Displays the confirmation message -->
    <p>
        The tattoo
        <?php echo htmlspecialchars($_SESSION['tattooDescription']); ?>
        was successfully updated.
    </p>
    <!-- Displays the gallery link -->
    <p><a href="index.php">View Tattoo Gallery</a></p>
</main>
<!-- Adds the footer to the page -->
<?php include('footer.php'); ?>