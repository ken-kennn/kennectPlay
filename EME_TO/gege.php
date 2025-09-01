<?php 

session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['username'])){

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
    </head>
    <body>
        <h1>Hello, <?php echo $_SESSION['username']; ?></h1>
    </body>
    </html>
    
<?php
} else {
    header("Location: index.php");
    exit();
}

?>
