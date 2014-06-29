<div class="head-left">
	<h1>Light Speed Interactive Payout Calculator</h1>
</div>
<div class="head-right">
	<? if ($headerinfo['TRUSTED'] == "Yes")
	{
		if ($headerinfo['ALLIANCEID'] != "")
		{
			?><img class="alliance" src="<?echo get_eve_image("alliance",$headerinfo['ALLIANCEID'],64); ?>" width="40px" /> <?
		}
		?>
			<img class="corporation" src="<?echo get_eve_image("corporation",$headerinfo['CORPID'],64); ?>" width="40px" />
			<img class="character" src="<? echo get_eve_image("character",$headerinfo['CHARID'],64); ?>" width="40px" />
		<?
	}
	?>
</div>