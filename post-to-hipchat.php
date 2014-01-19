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

$config = require "config.php";

$token = $config["hipchat"]["token"];
$room_id = $config["hipchat"]["room"];
$from = !empty($config["hipchat"]["from"]) ? $config["hipchat"]["from"] : "Whiteboard";

$hc = new HipChat($token);

$success = $hc->message_room(
    $room_id,
    $from,
    $image_url,
    $notify = false,
    $color = HipChat::COLOR_YELLOW,
    HipChat::FORMAT_TEXT
);

if (!$success) {
    echo "Unknown error posting image to HipChat room.\n";
    exit(1);
}
