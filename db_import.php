<?php
include 'orm/Categories.php';

$categories = new Categories();
function GoIn($directory, $parent_id, $cat)
{

    foreach ($directory as $item) {
        if ($item != null) {
            $cat->Insert_category($item['id'], $item['name'], $item['alias'], $parent_id);
            if ($item['childrens'] != null) {
                GoIn($item['childrens'], $item['id'], $cat);
            }
        }
    }
}

$jsonFilePath = 'categories.json';

$file = fopen($jsonFilePath, 'r');
$jsonContent = fread($file, filesize($jsonFilePath));
fclose($file);

$data = json_decode($jsonContent, true);
GoIn($data, 0, $categories);
