<?php
include 'Carbon.php';

$dtToronto = Carbon::createFromDate(2012, 1, 1, 'America/Toronto');
$dtVancouver = Carbon::createFromDate(2012, 1, 1, 'America/Vancouver');
echo $dtVancouver->diffInHours($dtToronto); // 3
