<?php

require_once __FUNCTION__ . "get-taskdto-list.php";

function listAll() {
    $taskList = getTaskDtoList();

    echo "All tasks:\n";

    foreach ($taskList as &$task) {
        echo "Id: $task->id\nTask: $task->description\nStatus: $task->status\nCreated $task->createdAt - Updated $task->updatedAt\n\n";
    }

    echo "End\n";
}