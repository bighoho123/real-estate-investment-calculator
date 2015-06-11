<?php
	$property_value=isset($_GET['property_value'])?$_GET['property_value']:0;
	$deposit=isset($_GET['deposit'])?$_GET['deposit']:0;
	$interest=isset($_GET['interest'])?$_GET['interest']:5;
	$term=isset($_GET['term'])?$_GET['term']:0;
	$rent=isset($_GET['rent'])?$_GET['rent']:0;

	$isShowResult='none';
	if ($property_value!=0&&$term!=0) {
		$isShowResult='block';

		$n_interest=$interest/12/100;
		$n_term=$term*12;
		/* Monthly Payment */
		$monthly=$n_interest*($property_value-$deposit)/(1-1/pow(1+$n_interest,$n_term));

		$yearly=$monthly*12;
		$totally=$monthly*$n_term;
		$rentYearly=$rent/7*365;
		$balanceYearly=$rentYearly-$yearly;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Real Estate Investment Calculator</title>
	<!-- jQuery -->
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>Calculator</h1>
		
		<div class="row">
			<div class="col-sm-3" id="input-div">
				<form action="" method="get" accept-charset="utf-8">
					<div class="form-group">
						<label for="property_value">Property Value</label>
						<input class="form-control" type="text" name="property_value" id="property_value" value="<?=$property_value?>">
					</div>
					<div class="form-group">
						<label for="deposit">Property Deposit</label>
						<input class="form-control" type="text" name="deposit" id="deposit" value="<?=$deposit?>">
					</div>
					<div class="form-group">
						<label for="interest">Home Loan Interest (%)</label>
						<input class="form-control" type="text" name="interest" id="interest" value="<?=$interest?>">
					</div>
					<div class="form-group">
						<label for="term">Home Loan Term (y.)</label>
						<input class="form-control" type="text" name="term" id="term" value="<?=$term?>">
					</div>
					<div class="form-group">
						<label for="rent">Rent (p.w.)</label>
						<input class="form-control" type="text" name="rent" id="rent" value="<?=$rent?>">
					</div>
					<button type="submit" class="btn btn-primary">Tell me the answer!</button>
				</form>
			</div>
			<div class="col-sm-9" id='output-div' style='display:<?=$isShowResult?>'>
				<h3>Summary</h3>
				<hr>
				<p>Your total payment would be <b class="text-info pull-right">$<?php echo number_format($totally,2); ?></b></p>
				<p>Your monthly payment would be <b class="text-info pull-right">$<?php echo number_format($monthly,2); ?></b></p>
				<p>Your yearly payment would be <b class="text-info pull-right">$<?php echo number_format($yearly,2); ?></b></p>
				<p>Your yearly rental income would be <b class="text-info pull-right">$<?php echo number_format($rentYearly,2); ?></b></p>
				<hr>
				<p>
					Your overall balance change 
					<?php 
						if ($balanceYearly<0) {
							echo "<b class='text-danger pull-right'>$".number_format($balanceYearly,2)."</b>";
						} else {
							echo "<b class='text-success pull-right'>$".number_format($balanceYearly,2)."</b>";
						}
					?>
				</p>
				<p>
					Your overall investment outcome (%)
					<?php 
						if ($balanceYearly<0) {
							echo "<b class='text-danger pull-right'>".number_format(100*$balanceYearly/$deposit,2)."%</b>";
						} else {
							echo "<b class='text-success pull-right'>".number_format(100*$balanceYearly/$deposit,2)."%</b>";
						}
					?>
				</p>
			</div>
		</div>
	</div>
</body>
</html>