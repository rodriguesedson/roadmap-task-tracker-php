<?php

require_once dirname(__CLASS__) . "entities/task.php";

class TaskDto {
    public function __construct(
        public int $id,
        public string $description,
        public string $status,
        public string $createdAt,
        public string $updatedAt
    ) {}

    public function toEntity() : Task {
        return new Task(
            $this->id,
            $this->description,
            Status::from($this->status),
            new DateTime($this->createdAt),
            new DateTime($this->updatedAt)
        );
    }

    public static function fromArray(array $data): self {
        return new self(
            (int) $data['id'],
            (string) $data['description'],
            (string) $data['status'],
            (string) $data['createdAt'],
            (string) $data['updatedAt']
        );
    }
}