# Whiteboard Capture

The small tools in this project will help you capture what's on your whiteboard
using a webcam, fswebcam, Rackspace CloudFiles and HipChat.

Each program has a small job:

## button-listener.py

Waits for a GPIO pin to be triggered (voltage goes high or low), for example
by a button or a sensor.

When triggered, the script `pipeline.sh` will be run.

## capture-frame.php

Captures a single frame from the webcam using `fswebcam`, saves it to file
and outputs the filename to stdout. If an error is encountered then nothing
is written to stdout, the exit code will be non-zero and a message will be written to stderr.

Example:

```bash
$ ./capture-frame.php
/tmp/whiteboardlRbHQt
```

## save-to-cloudfiles.php

Saves the data in the file given on stdin to a CloudFiles container and outputs
the public CDN URL to stdout. Debugging output is written to stderr.
If there's an error then the exit code will be non-zero.

Example:

```bash
$ echo '/tmp/whiteboardlRbHQt' | ./save-to-cloudfiles.php
http://04e[...].rackcdn.com/362dcaa9e9eb3d4c495adb815a82033d8366a20e.jpg
```

## post-to-hipchat.php

Posts the message given on stdin to a HipChat room.
If there's an error then the exit code will be non-zero.

Example:

```bash
$ echo 'This is a message' | ./post-to-hipchat.php
```
