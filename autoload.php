<?php

$dir = __DIR__.'/src/';
$files = array_diff(scandir($dir), array('..', '.'));
foreach ($files as $file)
{
    include $dir.$file;
}