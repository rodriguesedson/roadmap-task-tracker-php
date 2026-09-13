#!/usr/bin/env php
<?php

require_once __FUNCTION__ . "functions/switch.php";

$continue = true;

$dataPath = __DIR__ . "/data/tasks.json";
if (!file_exists($dataPath)) {
    $dirName = dirname($dataPath);
    mkdir($dirName, 0777, true);
    $initialJson = json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($dataPath, $initialJson);
}

while($continue) {
    echo "\033[35m"."task-cli"."\033[0m ";

    $entry = trim(fgets(STDIN));

    switch ($entry) {
        case "clear":
            passthru("clear");
            break;
        case "exit":
            $continue = false;
            break;
        default:
            verifyCommand($entry);
    }
}