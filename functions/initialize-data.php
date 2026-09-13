<?php

function initializeData() {
    $dataPath = dirname(__DIR__) . "/data/tasks.json";
    if (!file_exists($dataPath)) {
        $dirName = dirname($dataPath);
        mkdir($dirName, 0777, true);
        $initialJson = json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($dataPath, $initialJson);
    }
}