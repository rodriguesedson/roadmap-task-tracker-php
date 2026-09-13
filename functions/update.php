<?php

require_once dirname(__FUNCTION__) . "repositories/repository.php";
require_once dirname(__CLASS__) . "dtos/taskDto.php";
require_once __FUNCTION__ . "command-handler.php";

function update(string $command) {
    [$id, $newDescription] = getIdAndDescription($command, "update");

    if (!is_numeric($id)) {
        echo "Not a valid id\n";
        return;
    }

    $repository = new Repository();
    $data = $repository->getFileData();
    $taskList = array_map(function($task) {
        return TaskDto::fromArray($task);
    }, $data);

    foreach ($taskList as &$task) {
        if ($task->id === $id) {
            $entity = $task->toEntity();
            $entity->updateTask($newDescription);
            $task = $entity->toTaskDto();
            break;
        }
    }
    unset($task);

    $repository->saveData($taskList);
}