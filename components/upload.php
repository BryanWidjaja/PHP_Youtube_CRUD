<?php
session_start();
function displayError($message) {
    $_SESSION["error"] = $message;
    header("Location: /pages/creator.php");
    exit;
}

if (
    empty($_POST["title"]) ||
    empty($_POST["description"]) ||
    empty($_POST["visibility"]) ||
    empty($_FILES["upload-thumbnail"]["name"]) ||
    empty($_FILES["upload-video"]["name"])
) {
    displayError("Fill all, some empty");
}

$title = htmlspecialchars(trim($_POST["title"]));
$description = htmlspecialchars(trim($_POST["description"]));
$visibility = $_POST["visibility"];

$thumbnailDir = $_SERVER["DOCUMENT_ROOT"] . "/uploads/thumbnails/";
$videoDir = $_SERVER["DOCUMENT_ROOT"] . "/uploads/videos/";

function validateFile($inputName, $validExtensions, $uploadDir) {
    if (!isset($_FILES[$inputName]) || $_FILES[$inputName]["error"] !== UPLOAD_ERR_OK) {
        displayError("Error uploading file: $inputName");
    }

    $temp = $_FILES[$inputName]["temp_name"];
    $fileName = basename($_FILES[$inputName]["name"]);
    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $uploadFile = $uploadDir . $fileName;

    if (!in_array($extension, $validExtensions)) {
        displayError("Invalid extension, $fileName");
    }

    if (file_exists($uploadFile)) {
        displayError("$fileName already exists");
    }

    if (!move_uploaded_file($temp, $uploadFile)) {
        displayError("Upload error");
    }

    return $fileName;
}

$imageTypes = ["jpg", "jpeg", "png"];
$videoTypes = ["mp4", "webm", "mov", "avi"];

$thumbnailFile = validateFile("upload-thumbnail", $imageTypes, $thumbnailDir);
$videoFile = validateFile("upload-video", $videoTypes, $videoDir);

$videoData = [
    "title" => $title,
    "description" => $description,
    "visibility" => $visibility,
    "thumbnail" => $thumbnailFile,
    "video" => $videoFile,
    "creator" => $_SESSION["username"]
];

$videosJson = $_SERVER["DOCUMENT_ROOT"] . "/data/json/videos.json";

$videos = [];

$videos = json_decode(file_get_contents($videosJson), true);

$videos[] = $videoData;

file_put_contents($videosJson, json_encode($videos, JSON_PRETTY_PRINT));

$_SESSION["success"] = "Video and thumbnail uploaded successfully!";
header("Location: /pages/creator.php");
exit;
?>