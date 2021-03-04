<?php
echo 'Export iCal';
die;
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=invite.ics');
$properties = array(
'dtstart' => 'now',
'dtend' => 'now + 30 minutes'
);

$ics = new ICS($properties);
$ics_file_contents = $ics->to_string();