<?php

require_once __FUNCTION__ . "command-handler.php";

function markDone(string $command) {
    try {
        $id = getTaskId($command, "mark-done");
        if (!$id) return;

        $repository = new Repository();
        $data = $repository->getFileData();
        $taskList = array_map(function($task) {
            return TaskDto::fromArray($task);
        }, $data);

        foreach ($taskList as $key => &$task) {
            if ($task->id === $id) {
                $auxTask = $task->toEntity();
                $auxTask->markAsDone();
                $task = $auxTask->toTaskDto();
                break;
            } else if ($key == array_key_last($taskList)) {
                echo "Task not found\n";
                return;
            }
        }

        $repository->saveData($taskList);

        echo "Task Id $id is done\n";
    } catch (error $error) {
        echo $error."\n";
    }
}