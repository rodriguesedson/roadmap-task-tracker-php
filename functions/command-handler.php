<?php

function getContent(string $command, string $functionName) {
    $pattern = "/".preg_quote($functionName)."/";
    return trim(preg_replace($pattern, "", $command, 1));
}

function getIdAndDescription(string $command, string $functionName) {
    $content = getContent($command, $functionName);
    $splitContent = explode(" ", $content);
    $id = (int)array_shift($splitContent);
    $description = implode(" ", $splitContent);
    return [$id, $description];
}