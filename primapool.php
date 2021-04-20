<center><h1><img src="http://primapool.tk/static/img/logo.png" height="60" width="60">PrimaPool</h1></center>
<br />

<?php
	$getusdprice = file_get_contents("https://api.coingecko.com/api/v3/simple/price?ids=riecoin&vs_currencies=usd");
	$usdresult  = json_decode($getusdprice);
	$price=round($usdresult->riecoin->usd, 5);
	
	$getprimapi = file_get_contents("http://primapool.tk/api/stats");
	$primapiresult  = json_decode($getprimapi);
	$primapoolwks = $primapiresult->global->workers;
	$primapoolpwr = $primapiresult->algos->stella->hashrateString;
	$primapooltpd = round($primapiresult->pools->riecoin->poolStats->totalPaid, 5);
	$primapoolvshs = $primapiresult->pools->riecoin->poolStats->validShares;
	$primapoolishs = $primapiresult->pools->riecoin->poolStats->invalidShares;
	$primapoolvbks = $primapiresult->pools->riecoin->poolStats->validBlocks;
	$primapoolpbks = $primapiresult->pools->riecoin->blocks->pending;
	$primapoollwks = $primapiresult->pools->riecoin;
	
	if(!empty($_POST['address']))
		$addressok = $_POST['address'];
	
	echo "<center> <b>Price: $price USD</b>
	<table class='table table-striped table-condensed'>
	<tr>
		<th width='80px' >Workers</th>	
		<th width='80px'>Shares/s</th>
		<th width='80px'>Fees</th>
		<th width='80px'>Port</th>
		<th width='80px'>ValidShares</th>
		<th width='80px'>InvalidShares</th>
		<th width='80px'>Valid Blocks</th>
		<th width='80px'>Blocks Pending</th>
		<th width='80px'>TotalPaid</th>
	</tr>
	<tr >
		<td >".$primapoolwks."</td>
		<td>".$primapoolpwr."</td>
		<td>0.1</td>
		<td>2004/2005/5000</td>
		<td>".$primapoolvshs."</td>
		<td>".$primapoolishs."</td>
		<td>".$primapoolvbks."</td>
		<td>".$primapoolpbks."</td>
		<td>".$primapooltpd."RIC</td>
	</tr>
</table></center>";
	if(!empty($addressok)) {
		if (empty($primapoollwks->workers->$addressok->shares)) 
			echo "<div class='well'><center><h2><b>Your miner was not found !</b></h2></center></div>";
		 else {
	echo "<center><div class='well'><center><h3><b>".$addressok."<b></h3></center><table class='table table-striped table-condensed'>
	<tr><td>Valid Shares</td>
	<td>Invalid Shares</td>
	<td>Shares/s</td>
	<tr><td>".$primapoollwks->workers->$addressok->shares;
	echo "</td>";
	echo "<td>".$primapoollwks->workers->$addressok->invalidshares;
	echo "</td>";
	echo "<td>".$primapoollwks->workers->$addressok->hashrateString;
	echo "</td></tr></table></div></center>";
		}
	}
?>
<br /><br />
<form name ="getcoin" action="" method="POST" class="clearfix">
						<input type="hidden" name="action" value="register" />
							<div class="form-group">
								<center><input class="form-control" type="text" name="address" placeholder="RIC address" align=center required></center>
							</div>
							<div class="form-group">
								<br />
								<center><button class="btn btn-primary" type="submit" name="submit">Submit</button></center>
								<center><p class="text-center">Go to <a href="http://primapool.tk">PrimaPool</a></p></center>
							</div>
						</form>
</table>
</div>
