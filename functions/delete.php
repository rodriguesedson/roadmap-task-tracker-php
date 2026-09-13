<?php

require_once __FUNCTION__ . "command-handler.php";
require_once dirname(__FUNCTION__) . "repositories/repository.php";

function delete(string $command) {
    try {
        $id = getTaskId($command, "delete");
        if (!$id) return;

        $repository = new Repository();
        $data = $repository->getFileData();
        $taskList = array_map(function($task) {
            return TaskDto::fromArray($task);
        }, $data);
        $taskPosition = null;

        foreach ($taskList as $key => &$task) {
            if ($task->id === $id) {
                $taskPosition = $key;
                break;
            } else if ($key == array_key_last($taskList)) {
                echo "Task not found\n";
                return;
            }
        }

        array_splice($taskList, $taskPosition, 1);

        $repository->saveData($taskList);

        echo "Task Id $id was deleted\n";
    } catch (error $error) {
        echo $error;
    }
}