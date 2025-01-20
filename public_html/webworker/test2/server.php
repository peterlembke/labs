<?php
/**
 * Simulates Infohub, that it sends JS code over Ajax requests
 *
 * Created by PhpStorm.
 * User: peter
 * Date: 2017-04-09
 * Time: 07:02
 */

$theScript = file_get_contents('myscript.js');
echo $theScript;