<?php

function getTaskDtoList() {
    $repository = new Repository();
    $data = $repository->getFileData();
    return array_map(function($task) {
        return TaskDto::fromArray($task);
    }, $data);
}