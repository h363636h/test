<!DOCTYPE html>
<html> 
<body> 
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file" id="fileToUpload"><br><br>
    <input type="submit" value="Upload File" name="submit">
</form>
</body>
</html>
<?php

$save_dir = "uploads/";

if(is_uploaded_file($_FILES['file']['tmp_name'])){
    // echo "업로드 파일명 : " . $_FILES['file']['name']."<br>";
    // echo "업로드 파일 크기 : " . $_FILES['file']['size']."<br>";
    // echo "업로드한 파일 type : " . $_FILES['file']['type']."<br>";
    // echo "임시 디렉토리 파일 명 : " . $_FILES['file']['tmp_name']."<br>";

    $dest = $save_dir . $_FILES['file']['name'];
    // echo $dest;

    if(!move_uploaded_file($_FILES['file']['tmp_name'],$dest)){
        die("실패");
    } else{
        echo "<script>window.location.href='shot_insert_db.php?file_name=".$_FILES['file']['name']."';</script>";
    }

}
// echo "<script>window.location.href='test.php?php_file=test.xlsx';</script>";
// echo $_FILES['file']['name'];
?>

