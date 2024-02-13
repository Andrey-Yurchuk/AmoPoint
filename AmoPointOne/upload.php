<?php

$uploadDir = 'files/';

if (isset($_FILES['fileToUpload'])){
    $uploadFile = $uploadDir . basename($_FILES['fileToUpload']['name']);

    $fileExtension = strtolower(pathinfo($uploadFile,PATHINFO_EXTENSION));

    if ($fileExtension == "txt"){
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadFile)){
            echo '<b>Файл успешно загружен и сохранен</b>' . '<br><br>';

            $fileContent = file_get_contents($uploadFile);
            $lines = explode(PHP_EOL, $fileContent);

            foreach($lines as $line){
                if (!empty($line)){
                    $numOfDigits = preg_match_all('/\d/', $line);
                    echo $line . '<b> : количество цифр в строке = </b>' . '<b>' . $numOfDigits . '</b>' . '<br>';
                }
            }
        } else {
            echo '<b>Ошибка при загрузке файла</b>';
        }
    } else {
        echo '<b>Файл должен быть в формате txt</b>';
    }
}

