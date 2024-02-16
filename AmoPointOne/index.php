<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Загрузка файла</title>
</head>
<body>
<h3>Загрузка файла</h3>

<form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload">
    <input type="button" value="Загрузить" onclick="validateFile()">
</form>

<div class="circle"></div>

<script src="script.js"></script>

</body>
</html>