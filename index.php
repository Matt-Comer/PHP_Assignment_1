<?php
// Connect to the database
require_once('database.php');
// Select all tatoos from the tatoos table
$query = 'Select * from  tatoos';
// Prepare the query
$statement = $db->prepare($query);
// Execute the query
$statement->execute();
// Fetch all the results
$tatoos = $statement->fetchAll();
// Close the statement
$statement->closeCursor();
?>
<!-- Adds the header to the page -->
<?php include('header.php'); ?>

<main>
    <!-- Displays the tattoo list heading -->
    <h2>Tattoo Gallery</h2>
    <!-- Displays the tattoo information -->
    <table>
        <tr>
            <th>Artist Name</th>
            <th>Tattoo Style</th>
            <th>Description</th>
            <th>Price</th>
        </tr>
        <!-- Loops through each tattoo record -->
        <?php foreach ($tatoos as $tattoo) : ?>
        <tr>
            <td><?php echo $tattoo['artistName']; ?></td>
            <td><?php echo $tattoo['tattooStyle']; ?></td>
            <td><?php echo $tattoo['description']; ?></td>
            <td>$<?php echo $tattoo['price']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
<!-- Adds the footer to the page -->
<?php include('footer.php'); ?>
