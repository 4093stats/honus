<?php
	// set date today
	$year = date('Y');
	$month = date('m');
	$day = date('d');

	// get scoreboard as XML
	$dateurl = "http://gd2.mlb.com/components/game/mlb/year_".$year."/month_".$month."/day_".$day."/";
	$datepage = file_get_contents($dateurl);
	$datescoreboardurl = $dateurl."master_scoreboard.xml";
	$datescoreboardpage = file_get_contents($datescoreboardurl);
	$datescoreboardpagexml = simplexml_load_string($datescoreboardpage);


	// create table of scores, each row is a game
	echo "<table>";
	foreach($datescoreboardpagexml as $a) {
		echo "<tr><td>";
			echo "<table><tr><td>",$a->attributes()->away_team_name,"</td></tr><tr><td>",$a->attributes()->home_team_name,"</td></tr></table>";
			if (($a->status->attributes()->status)=="Final") {
				echo "</td><td>";
				echo "<table><tr><td>",$a->linescore->r->attributes()->away,"</td></tr><tr><td>",$a->linescore->r->attributes()->home,"</td></tr></table>";
				echo "</td><td>";
				echo "F";
			} elseif (($a->status->attributes()->status)=="In Progress" || ($a->status->attributes()->status)=="Review") {
				echo "</td><td>";
				echo "<table><tr><td>",$a->linescore->r->attributes()->away,"</td></tr><tr><td>",$a->linescore->r->attributes()->home,"</td></tr></table>";
				echo "</td><td>";
				if (($a->status->attributes()->top_inning)=="Y"){echo "&#8593;";} else {echo "&#8595;";}
				echo $a->status->attributes()->inning;
			} elseif (($a->status->attributes()->status)=="Preview") {
				echo "</td><td>";
				echo "<table><tr><td>",$a->away_probable_pitcher->attributes()->last_name,"</td></tr><tr><td>",$a->home_probable_pitcher->attributes()->last_name,"</td></tr></table>";
				echo "</td><td>";
				echo $a->attributes()->time," ET";
			} else {echo "Game status unknown"}
		echo "</td></tr>";
	}
	echo "</table>";
?>

<?php
	$filename = "http://gd2.mlb.com/components/game/mlb/year_2015/month_06/day_14/gid_2015_06_14_lanmlb_sdnmlb_1/media/highlights.xml";
	$homepage = file_get_contents($filename);
	$xml = simplexml_load_string($homepage);

	$headlines = array();
	$blurbs = array();
	$urls = array();
	foreach ($xml as $media) {
		array_push($headlines,$media->headline);
		array_push($blurbs,$media->blurb);
		array_push($urls,$media->url);
	}

	

?>

<table>
	<tr>
		<td><table>
			<?php
				for ($iii=0; $iii<count($headlines); $iii++) {
					$headline = $headlines[$iii];
					$url = $urls[$iii];
					echo "<tr><td onclick='document.getElementById(\"videoplayer\").setAttribute(\"src\", \"",$url,"\");'>",$headline,"</td></tr>";
				}
			?>
		</table></td>
		<td>
			<video id="videoplayer" controls>
			<source src="<?php echo $urls[0];?>" type="video/mp4">
			Your browser does not support the video tag.
			</video>
		</td>
	</tr>
</table>



