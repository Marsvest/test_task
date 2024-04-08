<?php

function GoIn($directory, $parent, $filePath, $count)
{
    foreach ($directory as $item) {
        if ($item != null) {
            $content = str_repeat('    ', $count) . $item['name'] . ' /';
            $content .= $parent . $item['alias'] . "\n";
            file_put_contents($filePath, $content, FILE_APPEND);
            if ($item['childrens'] != null) {
                GoIn($item['childrens'], $parent . $item['alias'] . "/", $filePath, $count + 1);
            }
        }
    }
}

$jsonFilePath = 'categories2.json';
$outputFilePath = 'outputs/type_a.txt';

$file = fopen($jsonFilePath, 'r');
$jsonContent = fread($file, filesize($jsonFilePath));
fclose($file);

$data = json_decode($jsonContent, true);
file_put_contents($outputFilePath, '');

GoIn($data, '', $outputFilePath, 0);

echo "Данные успешно записаны в файл '$outputFilePath'.";