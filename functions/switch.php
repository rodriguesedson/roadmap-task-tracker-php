<?php

require_once dirname(__CLASS__) . "services/task-service.php";

function verifyCommand(string $command, TaskService $taskService) {
    $functionName = getFunctionName($command);
    switch ($command) {
        case $functionName === "add":
            $taskService->add($command);
            break;
        case $functionName === "update":
            $taskService->update($command);
            break;
        case $functionName === "delete":
            $taskService->delete($command);
            break;
        case $functionName === "mark-in-progress":
            $taskService->markInProgress($command);
            break;
        case $functionName === "mark-done":
            $taskService->markDone($command);
            break;
        case $functionName === "list todo":
            $taskService->listToDo();
            break;
        case $functionName === "list in-progress":
            $taskService->listInProgress();
            break;
        case $functionName === "list done":
            $taskService->listDone();
            break;
        case $functionName === "list":
            $taskService->listAll();
            break;
        default:
            echo "Invalid command\n";
    }
}