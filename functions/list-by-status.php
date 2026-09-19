<?php

require_once dirname(__CLASS__) . "enums/status.php";
require_once __FUNCTION__ . "get-taskdto-list.php";

function listByStatus(Status $status) {
    $taskList = getTaskDtoList();

    echo "Tasks $status->value list:\n";

    foreach ($taskList as &$task) {
        if (Status::tryFrom($task->status) === $status) {
            echo "Id: $task->id\nTask: $task->description\nStatus: $task->status\nCreated $task->createdAt - Updated $task->updatedAt\n\n";
        }
        else
            continue;
    }

    echo "End\n";
}