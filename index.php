<?php 

session_start();
$_SESSION["user-role"] = "viewer";
unset($_SESSION["username"]);

function formatTitle($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    $text = preg_replace('~[^-\w]+~', '', $text);

    return $text;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZouTube</title>
    <link rel="stylesheet" href="./assets/styles/master.css">
    <link rel="stylesheet" href="./assets/styles/navbar.css">
    <link rel="stylesheet" href="./assets/styles/index.css">
</head>

<body>
    <?php include"./components/navbar.php"; ?>

    <div class="main-container video-container">
        <?php
            $videos = json_decode(file_get_contents("./data/json/videos.json"), true);
            
            foreach ($videos as $video) {
                if($video["visibility"] == "Public") {
                    $formattedTitle = formatTitle($video["title"]);
                    $href = "/pages/watchVideo.php?video=" . $formattedTitle;
                    
                    echo "
                    
                    <a href='" . $href . "' class='video-card'>
                        <img src='../uploads/thumbnails/" . $video["thumbnail"] . "' alt='video-img'>
                        <div class='video-info-container'>
                            <p class='video-title'>" . $video["title"] . "</p>
                            <p class='video-creator'>" . $video["creator"] . "</p>
                        </div>
                    </a>
                
                    ";  
                }
            }
        ?>
    </div>
</body>

</html>