<?php
include 'orm/Categories.php';
$category = new Categories();
$data = $category->Get_category();

function buildTree($dataArray, $parentId = "0")
{
    $tree = [];
    foreach ($dataArray as $item) {
        // Check if necessary keys are present in $item array
        if (isset($item['id'], $item['parent_id'], $item['name'], $item['alias'])) {
            if ($item['parent_id'] === $parentId) {
                $children = buildTree($dataArray, $item['id']);
                // Condition to add 'childrens' key only if children exist
                $node = [
                    'id' => (int)$item['id'], // Casting id to integer for consistency with categories.json
                    'name' => $item['name'],
                    'alias' => $item['alias'],
                ];
                if (!empty($children)) {
                    $node['childrens'] = $children;
                }
                $tree[] = $node;
            }
        }
    }
    return $tree;
}

// Initiating tree building process
$tree = buildTree($data);

$jsonData = json_encode($tree, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents('categories2.json', $jsonData);
