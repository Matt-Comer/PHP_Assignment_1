<?php
    // Starts the session
    session_start();
?>
<!-- Adds the header to the page -->
<?php include('header.php'); ?>
<main>
    <!-- Displays the confirmation heading -->
    <h2>Add Tattoo Confirmation</h2>
    <!-- Displays the confirmation message -->
    <p>
        The tattoo
        <?php echo htmlspecialchars($_SESSION['tattooDescription']); ?>
        was successfully added to the gallery.
    </p>
    <!-- Displays the navigation links -->
    <p><a href="add_tattoo_form.php">Add Another Tattoo</a></p>
    <p><a href="index.php">View Tattoo Gallery</a></p>
</main>
<!-- Adds the footer to the page -->
<?php include('footer.php'); ?>