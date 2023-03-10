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

    if(isset($_POST["calculateButton"])){
        $nopol = $_POST["nopol"];
		$weightIn = $_POST["weightIn"];
        $weightOut = $_POST["weightOut"];
        $supplierName = $_POST["supplierName"];
        $travelPassWeight = $_POST["travelPassWeight"];

        $realWeightBruto = $weightIn;
        $realWeightTara = $weightOut;
        $realWeightNetto = $realWeightBruto - $realWeightTara;
		
		
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
		date_default_timezone_set("Asia/Bangkok");

		// $no = "  No:";	
		// echo "COBA : ".$no;
		$no =str_pad("No:",5 ," ", STR_PAD_LEFT);
		$norand = $no.str_pad(str_pad(rand(10,100),4,"0", STR_PAD_LEFT) , 7, " ", STR_PAD_LEFT)."\n";
		$date = "Date:".str_pad(date('Y-m-d'), 11, " ", STR_PAD_LEFT)."\n";
		$time = "Time:".str_pad(str_pad(date('H.i.s'),9," ", STR_PAD_LEFT),2," ",STR_PAD_RIGHT)."\n";
		$truck = "Truk:".str_pad(str_pad($nopol, 5, "0", STR_PAD_RIGHT), 6, " ", STR_PAD_LEFT)."\n";
		$art = "Art.:".str_pad(str_pad(str_pad(rand(0,300),4," ",STR_PAD_RIGHT), 5, " ", STR_PAD_LEFT), 5, " ", STR_PAD_LEFT)."\n";
		$g = "G:".str_pad($printedWeightBruto, 9, " ", STR_PAD_LEFT)."(Kg)"."\n";
		$t = "T:".str_pad($printedWeightTara, 9, " ", STR_PAD_LEFT)."(Kg)"."\n";
		$n = "N:".str_pad($printedWeightNetto, 9, " ", STR_PAD_LEFT)."(Kg)"."\n";

		$printed = $norand.$date.$time.$truck.$art.$g.$t.$n;

        // echo "Printed Weight <br>";
        // echo "Bruto : ".$printedWeightBruto."<br>";
        // echo "Tara : ".$printedWeightTara."<br>";
        // echo "Netto: ".$printedWeightNetto."<br>"; 
		// echo "Supplier: ".$supplierName."<br>"; 

        // echo "<br> Value Won : ".($realWeightNetto - $printedWeightNetto)."<br>";

		$sql = "INSERT INTO bm_scaling (supplier_name,no,nopol,truck,art,gross,tara,netto) 
		VALUES('".$supplierName."','2','".$nopol."','2','2','".$printedWeightBruto."','".$printedWeightTara."','".$printedWeightNetto."')";
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

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">
	<title>Buana Megah</title>
	<link href="https://fonts.cdnfonts.com/css/dot-matrix" rel="stylesheet">
	<style>
	 @media print {

	.hidden-print,
	.hidden-print * {
		display: none !important;
	}
	pre{
		font-family: 'Dot Matrix', sans-serif;
		width : 60em;
		word-wrap: break-word;
		white-space: pre-wrap;
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
<body style='width: 150px;margin-left: auto; margin-right:auto'>
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
		<pre><?= $printed ?></pre> 	
	</center>
	<button id="btnPrint" class="hidden-print">Print</button>
	<script src="script.js"></script>

</body>
</html>