<?php

require_once dirname(__CLASS__) . "enums/status.php";
require_once __FUNCTION__ . "list-by-status.php";

function listInProgress() {
    try {
        listByStatus(Status::InProgress);
    } catch (error $error) {
        echo $error."\n";
    }
}