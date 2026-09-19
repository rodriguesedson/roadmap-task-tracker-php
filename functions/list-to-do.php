<?php

require_once dirname(__CLASS__) . "enums/status.php";

function listToDo() {
    try {
        $repository = new Repository();
        $data = $repository->getFileData();
        $taskList = array_map(function($task) {
            return TaskDto::fromArray($task);
        }, $data);

        echo "Tasks todo list:\n";
        
        foreach ($taskList as &$task) {
            if (Status::tryFrom($task->status) === Status::Todo) {
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