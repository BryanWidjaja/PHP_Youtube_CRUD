<?php
session_start();

$videos = json_decode(file_get_contents("../data/json/videos.json"), true);
$html = "";

foreach ($videos as $video) {
    if ($video["creator"] === $_SESSION["username"]) {
        echo "
        <div class='video-card'>
            <img src='../uploads/thumbnails/" . $video["thumbnail"] . "' alt='video-img'>
            <div class='video-info-container'>
                <p class='video-title'>" . $video["title"] . "</p>
                <p class='video-description'>" . $video["description"] . "</p>
            </div>
        </div>
        ";
    }
}