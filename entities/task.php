<?php

require_once dirname(__FUNCTION__) . "enums/status.php";
require_once dirname(__CLASS__) . "dtos/taskDto.php";

class Task{
    public function __construct(
        private int $id,
        private string $description,
        private Status $status = Status::Todo,
        private DateTime $createdAt = new DateTime(),
        private DateTime $updatedAt = new DateTime()
    ) {}

    public function updateTask(string $newDescription) {
        $this->description = $newDescription;
        $this->updatedAt = new DateTime();
    }

    public function markAsInProgress() {
        $this->status = Status::InProgress;
        $this->updatedAt = new DateTime();
    }

    public function markAsDone() {
        $this->status = Status::Done;
        $this->updatedAt = new DateTime();
    }

    public function delete() {
        $this->status = Status::Deleted;
        $this->updatedAt = new DateTime();
    }

    public function toString() {
        return "Id: $this->id\nDescription: $this->description\nStatus: $this->status\nCreatedAt: $this->createdAt\nUpdatedAt: $this->updatedAt";
    }

    public function toTaskDto(): TaskDto {
        return new TaskDto(
            $this->id,
            $this->description,
            $this->status->value,
            $this->createdAt->format("Y-m-d H:i:s"),
            $this->updatedAt->format("Y-m-d H:i:s")
        );
    }
}