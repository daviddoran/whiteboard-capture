<?php

/**
 * Rename this file to config.php and fill in as appropriate.
 */

$config = array();

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
