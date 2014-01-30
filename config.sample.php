<?php

/**
 * Rename this file to config.php and fill in as appropriate.
 */

$config = array();

/*
//Add any custom fswebcam arguments here
$config['fswebcam'] = array();
$fswebcam = & $config['fswebcam'];
//For example, the code below flips in both directions.
$fswebcam['arguments'] = array(
    '--flip v',
    '--flip h',
);
*/

$config['cloudfiles'] = array();
$cloudfiles = & $config['cloudfiles'];
$cloudfiles['username'] = 'YOUR CLOUDFILES USERNAME';
$cloudfiles['api_key'] = 'YOUR CLOUDFILES API KEY';
$cloudfiles['container'] = 'YOUR CLOUDFILES CONTAINER';

$config['hipchat'] = array();
$hipchat = & $config['hipchat'];
$hipchat['token'] = 'HIPCHAT V1 API TOKEN';
$hipchat['room'] = 'HIPCHAT ROOM ID';
$hipchat['from'] = 'Whiteboard';

return $config;
