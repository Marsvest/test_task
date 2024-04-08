<?php
function GoIn($directory)
{
    echo '<ul>';
    foreach ($directory as $item) {
        if ($item != null) {
            echo "<li>";
            echo $item['id'] . "<br>";
            echo $item['name'] . "<br>";
            echo $item['alias'] . "<br>";
            echo "</li>";
            if ($item['childrens'] != null) {
                GoIn($item['childrens']);
            }
        }
    }
    echo '</ul>';
}

$jsonFilePath = 'categories2.json';

$file = fopen($jsonFilePath, 'r');
$jsonContent = fread($file, filesize($jsonFilePath));
fclose($file);

$data = json_decode($jsonContent, true);
GoIn($data);
