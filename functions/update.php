<?php

require_once dirname(__FUNCTION__) . "repositories/repository.php";
require_once dirname(__CLASS__) . "dtos/taskDto.php";
require_once __FUNCTION__ . "command-handler.php";

function update(string $command) {
    try {
        [$id, $newDescription] = getIdAndDescription($command, "update");
        if (!$id) return;
        if (!$newDescription) {
            echo "No new description was provided\n";
            return;
        }

        $repository = new Repository();
        $data = $repository->getFileData();
        $taskList = array_map(function($task) {
            return TaskDto::fromArray($task);
        }, $data);

        foreach ($taskList as $key => &$task) {
            if ($task->id === $id) {
                $entity = $task->toEntity();
                $entity->updateTask($newDescription);
                $task = $entity->toTaskDto();
                break;
            } else if ($key === array_key_last($taskList)) {
                echo "Task not found\n";
                return;
            }
        }
        unset($task);

        $repository->saveData($taskList);

        echo "Task Id $id was updated\n";
    } catch (error $error) {
        echo $error;
    }
}