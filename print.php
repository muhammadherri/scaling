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
    $WEIGHT_DEDUCTOR = 80;

    function getPrintedRandomWeightNettoWithRatio($weightDifference, $benefitRatio=90) {
        $benefitInWeight = ( (100 - $benefitRatio) * $weightDifference)/100;
        $minWeightRandomNumber = $benefitInWeight - (ceil($benefitInWeight/100)*50);
    
        $temp = random_int($minWeightRandomNumber, $benefitInWeight);

        return $temp;
    }

    if(isset($_POST["calculateButton"])){
        $nopol = $_POST["nopol"];
		$weightIn = $_POST["weightIn"];
        $weightOut = $_POST["weightOut"];
        $supplierName = $_POST["supplierName"];
        $travelPassWeight = $_POST["travelPassWeight"];

        $realWeightBruto = $weightIn;
        $realWeightTara = $weightOut;
        $realWeightNetto = $realWeightBruto - $realWeightTara;
		
		date_default_timezone_set("Asia/Bangkok");
		$waktu = date('H:i:s');
		$tanggal =  date('Y-m-d'); // Tanggal: 20.01.07
		$created_at = date('Y-m-d H:i:s');
		

        // echo "Real Weight <br> Bruto : $realWeightBruto <br> Tara : $realWeightTara <br> Netto : $realWeightNetto <br><br>";

        if($realWeightNetto - $WEIGHT_DEDUCTOR > $travelPassWeight ) {
            $differenceWeight = $realWeightNetto - $travelPassWeight;

            $printedWeightNetto =  $travelPassWeight + getPrintedRandomWeightNettoWithRatio($differenceWeight);

            $printedWeightNetto = ceil($printedWeightNetto/10)*10;
            
            $printedWeightTara = $realWeightTara; // Must always same with real weight

            $printedWeightBruto = $printedWeightNetto + $printedWeightTara;
        }
        else {
            $printedWeightNetto = $realWeightNetto - $WEIGHT_DEDUCTOR;
            $printedWeightTara = $realWeightTara;
            $printedWeightBruto = $printedWeightNetto + $printedWeightTara;
        }

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
		<table class="element" cellspacing='0' cellpadding='0' style='width:90%; font-size:8pt;  border-collapse: collapse;' border='0'>
			
			
			
			<!-- <tr>
				<td colspan='5'><hr></td>
			</tr> -->
			<tr>
				<td>
					<div style='text-align:right'>No</div>
				</td>
				<td>:</td>
				<td style='text-align:left; '>&nbsp; &nbsp; &nbsp; <?=$id?></td>
				<td style='width:10%'> </td>
			</tr>
			<tr>
				<td>
					<div style='text-align:right'>Date</div>
				</td>
				<td>:</td>
				<td style='text-align:left; '>&nbsp; <?= $tanggal ?></td>
				<td style='width:10%'> </td>
			</tr>
			<tr>
				<td>
					<div style='text-align:right'>Time</div>
				</td>
				<td>:</td>
				<td style='text-align:left; '>&nbsp; <?= $waktu ?></td>
				<td style='width:10%'> </td>
			</tr>
			<tr>
				<td><div style='height:10px text-align:right; color:black'>Truck</div></td>
				<td>:</td>
				<td style='text-align:left;  color:black'>&nbsp; <?= $nopol ?></td>
				<td style='width:10%'> </td>
			</tr>
			<tr>
				<td><div style='text-align:right; color:black'>Art.</div></td>
				<td>:</td>
				<td style='text-align:left;  color:black'>&nbsp; <?=$id?></td>
				<td style='width:10%'> </td>
			</tr>
			<tr>
				<td><div style='height:30px text-align:left; color:black'>G</div></td>
				<td>:</td>
				<td style='text-align:right;  color:black'><?= $printedWeightBruto ?> (Kg)</td>
				<td style='width:10%'> </td>
			</tr>
			<tr>
				<td><div style='text-align:left; color:black'>T</div></td>
				<td>:</td>
				<td style='text-align:right;  color:black'><?= $printedWeightTara ?> (Kg)</td>
				<td style='width:10%'> </td>
			</tr>
			<tr>
				<td><div style='text-align:left; color:black'>N</div></td>
				<td>:</td>
				<td style='text-align:right;  color:black'><?= $printedWeightNetto ?> (Kg)</td>
				<td style='width:10%'> </td>
			</tr>
		</table>
		<table class="element" style='width:90%; font-size:5pt;' cellspacing='2'><tr></br><td align='center'>*** TERIMAKASIH ***</br></td></tr></table>
		<button id="btnPrint" class="hidden-print">Print</button>
        <script src="script.js"></script>
	</center>
</body>
</html>