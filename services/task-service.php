<?php

require_once dirname(__FUNCTION__ ). "functions/command-handler.php";
require_once dirname(__FUNCTION__) . "repositories/repository.php";
require_once dirname(__CLASS__) . "entities/task.php";
require_once dirname(__CLASS__) . "dtos/taskDto.php";

class TaskService {
    public function __construct(
        private Repository $repository = new Repository()
    ) {}

    function add(string $command) {
        try {
            $description = getContent($command, "add");
            if (!$description) {
                echo "No description was provided\n";
                return;
            }
        
            $data = $this->repository->getFileData();
            
            $newId =  count($data) + 1;
            $newTask = new Task($newId, trim($description));
            $newTaskDto = $newTask->toTaskDto();
            $data[] = $newTaskDto;
        
            $this->repository->saveData($data);
        
            echo "Task id $newId saved\n";
        } catch (error $error) {
            echo $error."\n";
        }
    }

    function update(string $command) {
        try {
            [$id, $newDescription] = getIdAndDescription($command, "update");
            if (!$id) return;
            if (!$newDescription) {
                echo "No new description was provided\n";
                return;
            }

            $data = $this->repository->getFileData();
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

            $this->repository->saveData($taskList);

            echo "Task Id $id was updated\n";
        } catch (error $error) {
            echo $error."\n";
        }
    }

    function markInProgress(string $command) {
        try {
            $id = getTaskId($command, "mark-in-progress");
            if (!$id) return;

            $data = $this->repository->getFileData();
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

            $this->repository->saveData($taskList);

            echo "Task Id $id is in-progress\n";
        } catch (error $error) {
            echo $error."\n";
        }
    }

    function markDone(string $command) {
        try {
            $id = getTaskId($command, "mark-done");
            if (!$id) return;

            $data = $this->repository->getFileData();
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

            $this->repository->saveData($taskList);

            echo "Task Id $id is done\n";
        } catch (error $error) {
            echo $error."\n";
        }
    }

    function delete(string $command) {
        try {
            $id = getTaskId($command, "delete");
            if (!$id) return;

            $data = $this->repository->getFileData();
            $taskList = array_map(function($task) {
                return TaskDto::fromArray($task);
            }, $data);

            foreach ($taskList as $key => &$task) {
                if ($task->id === $id) {
                    $auxTask = $task->toEntity();
                    $auxTask->delete();
                    $task = $auxTask->toTaskDto();
                    break;
                } else if ($key == array_key_last($taskList)) {
                    echo "Task not found\n";
                    return;
                }
            }

            $this->repository->saveData($taskList);

            echo "Task Id $id was deleted\n";
        } catch (error $error) {
            echo $error."\n";
        }
    }

    function getTaskDtoList() {
        try {
            $data = $this->repository->getFileData();
            return array_map(function($task) {
                return TaskDto::fromArray($task);
            }, $data);
        } catch (error $error) {
            echo $error."\n";
        }
    }

    function listByStatus(Status $status) {
        $taskList = $this->getTaskDtoList();

        echo "Tasks $status->value list:\n";

        foreach ($taskList as &$task) {
            if (Status::tryFrom($task->status) === $status) {
                echo "Id: $task->id\nTask: $task->description\nStatus: $task->status\nCreated $task->createdAt - Updated $task->updatedAt\n\n";
            }
            else
                continue;
        }

        echo "End\n";
    }

    function listAll() {
        $taskList = $this->getTaskDtoList();

        echo "All tasks:\n";

        foreach ($taskList as &$task) {
            if (Status::tryFrom($task->status) !== Status::Deleted)
                echo "Id: $task->id\nTask: $task->description\nStatus: $task->status\nCreated $task->createdAt - Updated $task->updatedAt\n\n";
        }

        echo "End\n";
    }

    function listToDo() {
        try {
            $this->listByStatus(Status::Todo);
        } catch (error $error) {
            echo $error."\n";
        }
    }

    function listInProgress() {
        try {
            $this->listByStatus(Status::InProgress);
        } catch (error $error) {
            echo $error."\n";
        }
    }

    function listDone() {
        try {
            $this->listByStatus(Status::Done);
        } catch (error $error) {
            echo $error."\n";
        }
    }
}