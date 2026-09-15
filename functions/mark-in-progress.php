<?php

require_once __FUNCTION__ . "command-handler.php";

function markInProgress(string $command) {
    try {
        $id = getTaskId($command, "mark-in-progress");
        if (!$id) return;

        $repository = new Repository();
        $data = $repository->getFileData();
        $taskList = array_map(function($task) {
            return TaskDto::fromArray($task);
        }, $data);

        foreach ($taskList as $key => &$task) {
            if ($task->id === $id) {
                $auxTask = $task->toEntity();
                $auxTask->markAsInProgress();
                $task = $auxTask->toTaskDto();
                break;
            } else if ($key == array_key_last($taskList)) {
                echo "Task not found\n";
                return;
            }
        }

        $repository->saveData($taskList);

        echo "Task Id $id is in-progress\n";
    } catch (error $error) {
        echo $error."\n";
    }
}