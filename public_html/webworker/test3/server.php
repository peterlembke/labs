<?php
/**
 * Simulates Infohub, that it sends JS code over Ajax requests
 *
 * Created by PhpStorm.
 * User: peter
 * Date: 2023-11-24
 * Time: 01:15
 */

$pluginName = $_GET['want'];

$fileName = $pluginName . '.js';

$pluginCode = file_get_contents($fileName);

$out = [
    'plugin_name' => $pluginName,
    'plugin_code' => $pluginCode
];

$json = json_encode($out);

echo $json;
