<?php

require __FUNCTION__ . "add.php";
require __FUNCTION__ . "update.php";
require __FUNCTION__ . "delete.php";
require __FUNCTION__ . "mark-in-progress.php";
require __FUNCTION__ . "mark-done.php";
require __FUNCTION__ . "list.php";

function verifyCommand(string $command) {
    switch ($command) {
        case str_contains($command, "add"):
            add($command);
            break;
        case str_contains($command, "update"):
            update($command);
            break;
        case str_contains($command, "delete"):
            delete($command);
            break;
        case str_contains($command, "mark-in-progress"):
            markInProgress($command);
            break;
        case str_contains($command, "mark-done"):
            markDone($command);
            break;
        case str_contains($command, "list"):
            listAll();
            break;
        case str_contains($command, "list done"):
            // todo list done
            break;
        case str_contains($command, "list todo"):
            // todo list todo
            break;
        case str_contains($command, "list in-progress"):
            // todo list in-progress
            break;
        default:
            echo "Invalid command\n";
    }
}