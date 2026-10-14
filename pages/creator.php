<?php 

session_start();

if (!empty($_SESSION["success"])) {
    $msg = addslashes($_SESSION["success"]);
    echo "<script>alert('$msg');</script>";
    unset($_SESSION["success"]);
}

if (!empty($_SESSION["error"])) {
    $msg = addslashes($_SESSION["error"]);
    echo "<script>alert('$msg');</script>";
    unset($_SESSION["error"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZouTube</title>
    <link rel="stylesheet" href="../assets/styles/master.css">
    <link rel="stylesheet" href="../assets/styles/navbar.css">
    <link rel="stylesheet" href="../assets/styles/sidebar.css">
    <link rel="stylesheet" href="../assets/styles/creator.css">
</head>

<body>
    <?php include"../components/navbar.php"; ?>

    <section class="main-container">
        <div class="sidebar">
            <div class="sidebar-item active" id="content">Content</div>
            <div class="sidebar-item" id="upload">Upload</div>
        </div>
        <div class="content-container">
            <div class="video-container">

            </div>
        </div>
    </section>

    <script src="../scripts/creator.js"></script>
</body>

</html>