<?php

function listDone() {
    try {
        listByStatus(Status::Done);
    } catch (error $error) {
        echo $error."\n";
    }
}