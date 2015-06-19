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



