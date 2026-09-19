<?php

function configureCli() {
    $stdout = fopen("php://stdout", "w");
    $stdin = fopen("php://stdin", "r");
    stream_set_blocking($stdin, false);

    // fwrite($stdout, "\e[?1049h\e[2J\e[H");
    
    register_shutdown_function(function() use ($stdout) {
        // fwrite($stdout, "\e[?25h\e[?1049l");
        fclose($stdout);
    });
}