#!/usr/bin/env php
<?php

require_once __FUNCTION__ . "functions/switch.php";
require_once __FUNCTION__ . "functions/initialize-data.php";
require_once __FUNCTION__ . "functions/configure-cli.php";
require_once __CLASS__ . "services/task-service.php";

configureCli();

initializeData();

$continue = true;

$taskService = new TaskService();

while($continue) {
    echo "\033[35m"."task-cli"."\033[0m ";

    $entry = trim(fgets(STDIN));

    switch ($entry) {
        case "clear":
            echo "\e[2J\e[3J\e[H";
            break;
        case "exit":
            $continue = false;
            break;
        default:
            verifyCommand($entry, $taskService);
    }
}