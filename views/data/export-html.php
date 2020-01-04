<?php

/** @var array $dateToDreams */
/** @var \app\models\dj\Dream $dream */
/** @var int $dreamCount */
/** @var string $userName */
/** @var string $currentTime */

print "<i>data export by {$userName} at {$currentTime}</i>";
print "<hr>";
print "<h2 style=\"font-family:Calibri Light, Verdana;\">{$userName}'s Dream Journal</h2>";

foreach($dateToDreams as $date => $dreams)
{
	print "<h3 style=\"color:#002a97;font-family:Calibri Light, Verdana;margin-bottom:0;padding-bottom:0;\">Dream Event {$date}</h3>";
	foreach($dreams as $key => $dream)
	{
		$keyPlusOne = $key + 1;
		print "<p style=\"font-family:Calibri, Arial; margin-top:5;\">";
		print "<b>Dream {$keyPlusOne} -- {$dream->getTitle()}</b>";
		print "<br>";
		$dreamText = nl2br($dream->getDescription());
		print "<span>{$dreamText}</span>";
		print "</p>";
	}
	print "<hr>";
}
print "<i>exported a total of <b>{$dreamCount}</b> dreams</i>";