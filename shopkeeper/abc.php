<?php

$data=	'{"meds":"[{\"pid\":\"3\",\"qty\":\"20\"},{\"pid\":\"2\",\"qty\":\"100\"}]","sup":"avbc"}';
$dt=json_decode($data);
echo $dt->sup;
echo '<br/>';
$med=$dt->meds;
$md=json_decode($med);
echo gettype($md);
echo '<br/>';
for($i=0;$i<sizeof($md);$i++)
	{
		$pi=$md[$i]->pid;
		$qt=$md[$i]->qty;
		echo $pi;
		echo '<br/>';
		echo $qt;
		echo '<br/>';
	}	
?>

