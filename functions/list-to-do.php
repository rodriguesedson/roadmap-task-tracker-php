<?php

require_once dirname(__CLASS__) . "enums/status.php";

function listToDo() {
    try {
        listByStatus(Status::Todo);
    } catch (error $error) {
        echo $error."\n";
    }
}