<?php
	$filename = "http://gd2.mlb.com/components/game/mlb/year_2015/month_06/day_14/gid_2015_06_14_lanmlb_sdnmlb_1/media/highlights.xml";
	echo $filename;
	$homepage = file_get_contents($filename);
	echo $homepage;

	echo "\n\nBreak\n\n";


	$xml = simplexml_load_string($homepage);

	foreach ($xml as $character) {
	   echo "<p>",$character->headline, ' : ', $character->blurb, PHP_EOL,count($xml),"</p>";
	}


?>
