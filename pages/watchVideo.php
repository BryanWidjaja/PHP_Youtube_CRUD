<?php
session_start();

function formatTitle($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    $text = preg_replace('~[^-\w]+~', '', $text);

    return $text;
}

$requested = $_GET['video'];

$jsonPath = $_SERVER["DOCUMENT_ROOT"] . "/data/json/videos.json";

$videos = json_decode(file_get_contents($jsonPath), true);

$found = null;
foreach ($videos as $video) {
    if (formatTitle($video['title']) === $requested) {
        $found = $video;
        break;
    }
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
    <link rel="stylesheet" href="../assets/styles/watch.css">
</head>

<body>
    <?php include"../components/navbar.php"; ?>
    <div class="main-container">
        <div class="main-video-container">
            <?php
                echo "
                
                <video controls poster='../uploads/thumbnails/" . $video["thumbnail"] . "' class='main-video'>
                    <source src='../uploads/videos/" . $video["video"] . "'>
                </video>

                <p class='video-title'>". $found['title']. "</p>
                <p class='video-creator'>". $found['creator']. "</p>
                ";
            ?>
        </div>
        <div class="video-sidebar-container">
            <p class="video-sidebar-title">Recommended Videos</p>
            <?php
                $videos = json_decode(file_get_contents("../data/json/videos.json"), true);
                
                foreach ($videos as $video) {
                    if($video["visibility"] == "Public" && $video["video"] != $found["video"]) {
                        $formattedTitle = formatTitle($video["title"]);
                        $href = "/pages/watchVideo.php?video=" . $formattedTitle;
                        
                        echo "
                        
                        <a href='" . $href . "' class='sidebar-video-card'>
                            <img src='../uploads/thumbnails/" . $video["thumbnail"] . "' alt='video-img'>
                            <div class='sidebar-video-info-container'>
                                <p class='sidebar-video-title'>" . $video["title"] . "</p>
                                <p class='sidebar-video-creator'>" . $video["creator"] . "</p>
                            </div>
                        </a>
                    
                        ";  
                    }
                }
            ?>
        </div>
    </div>
</body>

</html>