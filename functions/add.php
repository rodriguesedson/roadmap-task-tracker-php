<?php

require_once dirname(__CLASS__) . "entities/task.php";
require_once dirname(__FUNCTION__) . "repositories/repository.php";
require_once __FUNCTION__ . "command-handler.php";

function add(string $command) {
    try {
        $description = getContent($command, "add");
        if (!$description) {
            echo "No description was provided\n";
            return;
        }
    
        $repository = new Repository();
        $data = $repository->getFileData();
        
        $newId =  count($data) + 1;
        $newTask = new Task($newId, trim($description));
        $newTaskDto = $newTask->toTaskDto();
        $data[] = $newTaskDto;
    
        $repository->saveData($data);
    
        echo "Task id $newId saved\n";
    } catch (error $error) {
        echo $error."\n";
    }
}