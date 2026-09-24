<?php
// Display database error
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database Error</title>
</head>
<body>
    <main>
        <h1>Database Error</h1>
        <p>There was an error connecting to the database.</p>
        <p><?php echo $error_message; ?></p>
    </main>
</body>
</html>