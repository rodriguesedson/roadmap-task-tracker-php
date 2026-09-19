<?php

function listAll() {
    $repository = new Repository();
    $data = $repository->getFileData();
    $taskList = array_map(function($task) {
        return TaskDto::fromArray($task);
    }, $data);

    echo "All tasks:\n";
    
    foreach ($taskList as &$task) {
        echo "Id: $task->id\nTask: $task->description\nStatus: $task->status\nCreated $task->createdAt - Updated $task->updatedAt\n\n";
    }

    echo "End\n";
}