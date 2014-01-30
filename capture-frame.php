#!/usr/bin/env php
<?php

/**
 * Captures a frame from a webcam or other video device.
 */

require "utilities.php";

$start = microtime(true);
bench("Capture: Capturing image...");

$output_filename = tempnam(sys_get_temp_dir(), "whiteboard");

$arguments = array(
    "fswebcam",
    "-d /dev/video0", //The video device (webcam)
    "-r 1280x720",    //Capture dimensions
    "-S 2",           //Skip 2 frames
    "--jpeg 85",      //JPEG quality
    "--no-banner",    //Don't overlay the capture time
);

$config = require "config.php";
$config_arguments = (isset($config["fswebcam"]["arguments"]) ? $config["fswebcam"]["arguments"] : array());

$arguments = array_merge(
    $arguments,
    $config_arguments,
    array(
        escapeshellarg($output_filename),
        "2>&1"
    )
);

$command = implode(" ", $arguments);

exec($command, $output, $return_code);

if (0 === $return_code and !preg_grep("/error/i", $output)) {
    bench();
    stderrln("Capture: Image stored at $output_filename");
    echo $output_filename, "\n";
    exit(0);
} else {
    fwrite(STDERR, PHP_EOL . implode(PHP_EOL, $output) . PHP_EOL);
    exit($return_code ?: 13);
}
