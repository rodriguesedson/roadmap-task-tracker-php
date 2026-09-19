<?php

function listDone() {
    try {
        $repository = new Repository();
        $data = $repository->getFileData();
        $taskList = array_map(function($task) {
            return TaskDto::fromArray($task);
        }, $data);

        echo "Tasks done list:\n";
        
        foreach ($taskList as &$task) {
            if (Status::tryFrom($task->status) === Status::Done) {
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