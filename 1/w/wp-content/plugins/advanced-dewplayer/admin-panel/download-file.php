<?php

$file=$_GET['dew_file'];

$fbasename = pathinfo($file);
$file_name = $fbasename['basename'];
$file_dir = $fbasename['dirname']."/";
$file_ext = $fbasename['extension'];

if('mp3' !== strtolower($file_ext))
{
	die('This file can not be download');
}
else
{ 
$data = str_replace(' ','%20',$file);

header("Content-type:audio/mpeg");
header("Content-Disposition:attachment;filename=".$file_name);

header('Pragma: no-cache');
header('Expires: 0');
readfile($data);
exit();
}
?>