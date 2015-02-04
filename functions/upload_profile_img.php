<?php

@$target_file = $_FILES["fileToUpload"]["name"];
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

if (isset($_POST["upload_new"])) {

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    if ($check !== false) {
        $uploadOk = 1;
    } 

    else {
        echo "Filen är inte en bild.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Filen är för stor.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
        echo "Bilden måste vara JPG, JPEG, PNG eller GIF.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Filuppladdningen misslyckades.";
    } 

    else {
        
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "profile/user_img/" . "$_SESSION[user_id]" . ".$imageFileType");
        $sql = sqlUpdate('UPDATE users SET profile_img = "' . $_SESSION['user_id'] . '.' . $imageFileType . '" WHERE user_id = "' . $_SESSION['user_id'] . '";');
        echo '<script>function test() { window.location.reload(); }</script>';
    }
}

?>