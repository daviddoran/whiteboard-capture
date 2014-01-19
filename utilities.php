<?php

function stderr($message) {
    fwrite(STDERR, $message);
}

function stderrln($message) {
    fwrite(STDERR, $message . PHP_EOL);
}

function bench($message = null) {
    static $start = null;
    if (func_num_args() === 0) {
        stderrln(sprintf("Done. Took %.2f seconds.", microtime(true) - $start));
        return;
    }
    $start = microtime(true);
    stderr("$message ");
}

function get_single_argument() {
    global $argc, $argv;

    if ($argc > 1) {
        //"--" indicates that STDIN should be used
        if ("--" !== $argv[1]) {
            return $argv[1];
        }
    }
    return rtrim(fgets(STDIN));
}
