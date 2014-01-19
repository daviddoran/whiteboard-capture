#!/usr/bin/env php
<?php

/**
 * Saves an image file to Rackspace CloudFiles.
 */

require "vendor/autoload.php";
require "utilities.php";

$input_filename = get_single_argument();

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

bench("CF: Authenticating to CloudFiles...");
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
