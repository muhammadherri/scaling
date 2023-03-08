<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "timbangan";
$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
    $WEIGHT_DEDUCTOR = 	100;

    function getPrintedRandomWeightNettoWithRatio($weightDifference, $benefitRatio=90) {
        $benefitInWeight = ( (100 - $benefitRatio) * $weightDifference)/100;
        $minWeightRandomNumber = $benefitInWeight - (ceil($benefitInWeight/100)*50);
    
        $temp = random_int($minWeightRandomNumber, $benefitInWeight);

        return $temp;
    }

    if(isset($_POST["defaultbutton"])){
        $nopol = $_POST["nopol"];
		$weightIn = $_POST["weightIn"];
        $weightOut = $_POST["weightOut"];
        $supplierName = $_POST["supplierName"];
        $travelPassWeight = $_POST["travelPassWeight"];

        $realWeightBruto = $weightIn;
        $realWeightTara = $weightOut;
        $realWeightNetto = $travelPassWeight;
		
		date_default_timezone_set("Asia/Bangkok");
		$waktu = date('H.i.s');
		$tanggal =  date('Y-m-d'); // Tanggal: 20.01.07
		$created_at = date('Y-m-d H:i:s');
		$norand = str_pad(rand(10,100), 4, "0", STR_PAD_LEFT);
		$artrand = str_pad(rand(200,300), 3, "0", STR_PAD_LEFT);

        // echo "Real Weight <br> Bruto : $realWeightBruto <br> Tara : $realWeightTara <br> Netto : $realWeightNetto <br><br>";

       
        // echo "Printed Weight <br>";
        // echo "Bruto : ".$printedWeightBruto."<br>";
        // echo "Tara : ".$printedWeightTara."<br>";
        // echo "Netto: ".$printedWeightNetto."<br>"; 
		// echo "Supplier: ".$supplierName."<br>"; 

        // echo "<br> Value Won : ".($realWeightNetto - $printedWeightNetto)."<br>";

		$sql = "INSERT INTO bm_scaling (supplier_name,no,nopol,truck,art,gross,tara,netto,created_at) 
		VALUES('".$supplierName."','2','".$nopol."','2','2','".$printedWeightBruto."','".$printedWeightTara."','".$printedWeightNetto."','".$created_at."')";
		if ($conn->query($sql) === TRUE) {
		
		} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		} 

		$data = mysqli_query($conn,"select * from bm_scaling order by id desc limit 1");
		while($d = mysqli_fetch_array($data)){
			$id= $d['id'];
		}
    }
?>
<html>
<head>
	<title>Buana Megah</title>
	<link href="https://fonts.cdnfonts.com/css/dot-matrix" rel="stylesheet">
	<style>
	 @media print {

	.hidden-print,
	.hidden-print * {
		display: none !important;
	}
	}
	 #body{
		 width: 200px;margin: auto;
		 font-family: 'Dot Matrix', sans-serif;
	 }
	 .element{
		/* color:  #fff; */
		/* font-weight: 50; */
		font-family: 'Dot Matrix', sans-serif;

		/* -webkit-text-stroke-width: 1px; */
		/* -webkit-text-stroke-color: black; */
	 }
	#tabel
	{
	font-size:15px;
	border-collapse:collapse;
	}
	#tabel  td
	{
	padding-left:5px;
	border: 1px solid black;
	}
	</style>
</head>
<body style=' font-size:5pt; width: 150px;margin-left: auto; margin-right:auto'>
	<center>
		<!-- <table style='width:90%; font-size:10pt; border-collapse: collapse;' border = '0'>
			<tr height='100%'>
				<td width='70%' align='CENTER'><span style='color:black;'><b>PT.BUANA MEGAH</b></span></td>
			</tr>
			<tr height='100%'>
				<td width='70%' align='CENTER'><span style='color:black;'><p style="font-size:6pt;">Jl. Raya Cangkringmalang KM. 40</p></span></td>
			</tr>
			<tr height='100%'>
				<td width='70%' align='CENTER'><span style='font-size:6pt'> Beji-Pasuruan</span></td>
			</tr>
			
		</table> -->
		<style>
			hr { 
				display: block;
				margin-top: 0.5em;
				margin-bottom: 0.5em;
				margin-left: auto;
				margin-right: auto;
				border-style: inset;
				border-width: 1px;
			} 
		</style>
		<table class="element" cellspacing='0' cellpadding='0' style='width:100%; font-size:10pt;  border-collapse: collapse;' border='0'>
			<!-- <tr>
				<td colspan='5'><hr></td>
			</tr> -->
			<tr>
				<td>
					<div style=' text-align:right'>No</div>
				</td>
				<td>:&nbsp; &nbsp;<?= $norand ?></td>
				<td style='width:10%'> </td>
			</tr>
			<tr>
				<td>
					<div style='text-align:right; color:black'>Date</div>
				</td>
				<td style='text-align:left;'>:&nbsp;<?= $tanggal ?></td>
				<td style='width:50%'> </td>
			</tr>
			<tr>
				<td>
					<div style='text-align:right; color:black'>Time</div>
				</td>
				<td>: <?= $waktu ?></td>
				<td style='width:10%'> </td>
			</tr>
			<tr>
				<td><div style='text-align:right; color:black'>Truk</div></td>
				<td>: <?= $nopol ?></td>
				<td style='width:10%'> </td>
			</tr>
			<tr>
				<td><div style='text-align:right; color:black'>Art.</div></td>
				<td>: <?= $artrand ?></td>
				<td style='width:10%'> </td>
			</tr>
			<tr>
				<td><div style='text-align:left; color:black'>G:</div></td>
				<td style='text-align:right;'><?= $realWeightBruto ?>(Kg)</td>
				<td style='width:26%'> </td>
			</tr>
			<tr>
				<td><div style='text-align:left; color:black'>T:</div></td>
				<td style='text-align:right;'><?= $realWeightTara ?>(Kg)</td>
				<td style='width:26%'> </td>
			</tr>
			<tr>
				<td><div style='text-align:left; color:black'>N:</div></td>
				<td style='text-align:right;'><?= $realWeightNetto ?>(Kg)</td>
				<td style='width:26%'> </td>
			</tr>
		</table>
		<br>
		<br>
		<!-- <table class="element" style='width:90%; font-size:8pt;' cellspacing='2'><tr></br><td align='center'>*** TERIMAKASIH ***</br></td></tr></table> -->
		<br>
	</center>
	<button id="btnPrint" class="hidden-print">Print</button>
	<script src="script.js"></script>

</body>
</html>