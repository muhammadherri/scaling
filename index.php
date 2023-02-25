
<?php 
	


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
			

    }
	
?>
<html>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="style.css">
  </head>
  <br>
  <body>
    <div class="form-style-5">
      <form action="print.php" method="post">
        <fieldset>
		
          <legend></span> Form Input Scaling</legend>
		  <input type="text" name="nopol" placeholder="No Pol" value="" required>
          <input type="text" name="weightIn" placeholder="Berat Masuk" value="" required>
          <input type="text" name="weightOut" placeholder="Berat Keluar" value=""required>
          <input type="text" name="supplierName" placeholder="Nama Supplier" value=""required>
          <input type="text" name="travelPassWeight" placeholder="Berat Surat Jalan" value=""required>
         
          <input href="print.php" type="submit"name="calculateButton" value="Submit And Print" />
        </fieldset>
      </form>
    </div>
	
	
  </body>
</html>