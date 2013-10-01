<?
$today = date('Y-m-d h:i:s a' , time());
$tomorrow = strtotime("+1 day", time());
$tomorrow = date('Y-m-d h:i:s a' , $tomorrow);

echo $today."\n";
echo $tomorrow;


?>