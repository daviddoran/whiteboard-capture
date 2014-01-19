#!/usr/bin/env php
<?php

/**
 * Posts an image link into a HipChat room.
 */

use HipChat\HipChat;

require "vendor/autoload.php";

if ($argc > 1 and ("--" !== $argv[1])) {
    $image_url = $argv[1];
} else {
    $image_url = rtrim(fgets(STDIN));
}

$defaults = array(
    "from"   => "Whiteboard",
    "notify" => false,
    "color"  => HipChat::COLOR_YELLOW,
    "format" => HipChat::FORMAT_TEXT
);
$config = require "config.php";
$config["hipchat"] = $config["hipchat"] + $defaults;

$token = $config["hipchat"]["token"];
$room_id = $config["hipchat"]["room"];

$hc = new HipChat($token);

$success = $hc->message_room(
    $room_id,
    $config["hipchat"]["from"],
    $image_url,
    $config["hipchat"]["notify"],
    $config["hipchat"]["color"],
    $config["hipchat"]["format"]
);

if (!$success) {
    echo "Unknown error posting image to HipChat room.\n";
    exit(1);
}
