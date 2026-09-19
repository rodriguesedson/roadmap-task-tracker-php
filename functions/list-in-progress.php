<?php

require_once dirname(__CLASS__) . "enums/status.php";

function listInProgress() {
    try {
        $repository = new Repository();
        $data = $repository->getFileData();
        $taskList = array_map(function($task) {
            return TaskDto::fromArray($task);
        }, $data);

        echo "InProgress list:\n";
        
        foreach ($taskList as &$task) {
            if (Status::tryFrom($task->status) === Status::InProgress) {
                echo "Id: $task->id\nTask: $task->description\nStatus: $task->status\nCreated $task->createdAt - Updated $task->updatedAt\n\n";
            }
            else
                continue;
        }

        echo "End\n";
    } catch (error $error) {
        echo $error."\n";
    }
}