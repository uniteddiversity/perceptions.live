<?php
$output_is = exec('composer install');
//echo 'out put is '.$output_is;

require_once('env_editor.php');

//exec('whoami', $output, $retval);

//copy inv file
$file = './index.php';
$newfile = '../.inv2';

if (!copy($file, $newfile)) {
    echo "failed to copy";
}