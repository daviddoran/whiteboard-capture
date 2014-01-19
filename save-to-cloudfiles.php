#!/usr/bin/env php
<?php

/**
 * Saves an image file to Rackspace CloudFiles.
 */

require "vendor/autoload.php";

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

if ($argc > 1 and ('--' !== $argv[1])) {
    $input_filename = $argv[1];
} else {
    $input_filename = rtrim(fgets(STDIN));
}

if (!$input_filename) {
    echo "You must provide a filename as the first argument or through STDIN.\n";
    exit(1);
}

$input_filename = realpath($input_filename);

if (!file_exists($input_filename)) {
    echo "Image file '{$input_filename}' doesn't exist.\n";
    exit(1);
}

$config = require "config.php";

$username = $config["cloudfiles"]["username"];
$apikey = $config["cloudfiles"]["api_key"];
$container_id = $config["cloudfiles"]["container"];

bench("Authenticating to CloudFiles...");
$auth = new CF_Authentication($username, $apikey);
$auth->authenticate();
bench();

$conn = new CF_Connection($auth);

$object_id = sprintf("%s.jpg", sha1(uniqid()));

bench("CF: Getting container...");
$container = $conn->get_container($container_id);
bench();

bench("CF: Creating object...");
$object = new CF_Object($container, $object_id, false, false);
bench();

bench("CF: Saving image data...");
$object->load_from_filename($input_filename);
bench();

echo $object->public_uri(), PHP_EOL;
