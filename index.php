<?php
include 'config.php';
include 'function.php';
include 'cls_piyushapi.php';
include 'cls_short_url.php';
include 'redis_connect.php';

if (isset($_POST["btnSubmit"])) {
    $ext = getFileNameExtension($_FILES["txtFile"]["name"]);
    $imageName = getFileUniqueName($ext);
    $upload_dir = ROOT_PATH . "upload_image";
    $fileDestination = $upload_dir . "/" . $imageName;
    $upload_dir_name = "upload_image";

    if (is_dir($upload_dir)) {
        if (!empty($ext)) {
            move_uploaded_file($_FILES["txtFile"]["tmp_name"], $fileDestination);
            $image_path = SITE_URL . $upload_dir_name . "/" . $imageName;
            $objShort = new Short_Url();
            $short_url = $objShort->setShortUrl($image_path);
            $objRedis = new Redis_Connect();
            $objRedis->set($short_url, $image_path);

            header("location:photo.php?url=" . $short_url);
        }
    }
}
?>
<html>
    <head>
        <title><?= TITLE ?></title>
    </head>
    <body>
        <form action="" method="post" enctype="multipart/form-data" name="frmPost" id="frmPost">
            <label>Select File For Post :</label>
            <input type="file" name="txtFile" id="txtFile">
            <input type="submit" name="btnSubmit" value="Post">
        </form>
    </body>
</html>