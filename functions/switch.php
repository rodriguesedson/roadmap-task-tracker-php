<?php

require __FUNCTION__ . "command-handler.php";
require __FUNCTION__ . "add.php";
require __FUNCTION__ . "update.php";
require __FUNCTION__ . "delete.php";
require __FUNCTION__ . "mark-in-progress.php";
require __FUNCTION__ . "mark-done.php";
require __FUNCTION__ . "list-to-do.php";
require __FUNCTION__ . "list.php";

function verifyCommand(string $command) {
    $functionName = getFunctionName($command);
    switch ($command) {
        case $functionName === "add":
            add($command);
            break;
        case $functionName === "update":
            update($command);
            break;
        case $functionName === "delete":
            delete($command);
            break;
        case $functionName === "mark-in-progress":
            markInProgress($command);
            break;
        case $functionName === "mark-done":
            markDone($command);
            break;
        case $functionName === "list todo":
            listToDo();
            break;
        case $functionName === "list in-progress":
            // todo list in-progress
            break;
        case $functionName === "list done":
            // todo list done
            break;
        case $functionName === "list":
            listAll();
            break;
        default:
            echo "Invalid command\n";
    }
}