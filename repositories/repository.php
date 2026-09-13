<?php

class Repository{
    private string $dataPath;

    public function __construct() {
        $this->dataPath = dirname(__DIR__) . "/data/tasks.json";
    }

    public function getFileData() : array {
        $fileData = file_get_contents($this->dataPath);
        return json_decode($fileData, true);
    }

    public function saveData(array $data) {
        $fileData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($this->dataPath, $fileData);
    }
}