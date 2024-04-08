<?php

function GoIn($directory, $filePath, $count)
{
    if ($count < 2) {
        foreach ($directory as $item) {
            $content = str_repeat('    ', $count) . $item['name'] . PHP_EOL;
            file_put_contents($filePath, $content, FILE_APPEND);
            if (!empty($item['childrens'])) {
                GoIn($item['childrens'], $filePath, $count + 1);
            }
        }
    }
}

$jsonFilePath = 'categories2.json';
$outputFilePath = 'outputs/type_b.txt';

$file = fopen($jsonFilePath, 'r');
$jsonContent = fread($file, filesize($jsonFilePath));
fclose($file);

$data = json_decode($jsonContent, true);
file_put_contents($outputFilePath, '');

GoIn($data, $outputFilePath, 0);

echo "Данные успешно записаны в файл '$outputFilePath'.";
