#!/bin/sh
# This pipeline runs each of the whiteboard capture stages one after the other
./capture-frame.php | ./save-to-cloudfiles.php | ./post-to-hipchat.php
