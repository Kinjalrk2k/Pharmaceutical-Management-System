<?php
include("../include/connection.php");

$target_dir = "../../uploads/";
$allowed_exts = array('gif', 'png', 'jpg', 'jpeg');

$target_file = $target_dir . basename($_FILES["image"]["name"]);
$ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


if (!in_array($ext, $allowed_exts)) {
    echo "The file you are trying to upload is not an Image";
    return;
}

if ($_FILES['image']['size'] > 2097152) {
    echo "The file you are trying to upload is greater than 2MB in size";
    return;
}

$rename = md5(time() . rand()) . "." . $ext;

move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $rename);
echo $rename;

$query = "update chemicals set name='" . $_POST['name'] . "', rate='" . $_POST['rate'] . "', image='" . $rename . "' where id='" . $_POST['id'] . "'";
$result = mysqli_query($con, $query);
header("location:../chemicals.php");
