<?php

function getContent(string $command, string $functionName) {
    $pattern = "/".preg_quote($functionName)."/";
    return trim(preg_replace($pattern, "", $command, 1));
}

function getTaskId(string $command, string $functionName) {
    $id = trim(getContent($command, $functionName));
    if (!validateId($id)) return;
    return (int)$id;
}

function getIdAndDescription(string $command, string $functionName) {
    $content = getContent($command, $functionName);
    $splitContent = explode(" ", $content);
    $id = (int)array_shift($splitContent);
    if (!validateId($id)) return;
    $description = implode(" ", $splitContent);
    return [$id, $description];
}

function validateId(string $id) {
    if (!$id) {
        echo "No id was provided\n";
        return false;
    } else if (!is_numeric($id)) {
        echo "Invalid id value\n";
        return false;
    }
    return true;
}