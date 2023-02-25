<!DOCTYPE html>
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
		$waktu = date('H:i:s'); // Waktu: 20-01-2017 22:01:15
		$tanggal =  date('Y-m-d'); // Tanggal: 20.01.07
		

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
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>Buana Megah</title>
    </head>
    <body>
        <div class="ticket">
            <p class="centered">Scaling
			<form action>
			</form>
            <table>
                <thead>
                    <tr>
                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="quantity">No</td>
                        <td class="quantity">:</td>
                        <td class="quantity">1.00</td>
                        
                    </tr>
                    <tr>
                        <td class="description">Date</td>
                        <td class="description">:</td>
                        <td class="price"><?= $tanggal ?></td>
                    </tr>
                    <tr>
                        <td class="quantity">Time</td>
                        <td class="quantity">:</td>
                        <td class="price"><?= $waktu ?></td>
                    </tr>
                    <tr>
                        <td class="quantity">Truck</td>
                        <td class="quantity">:</td>
                        <td class="price"><?= $nopol ?></td>
                    </tr>
                    <tr>
                        <td class="description">Art</td>
                        <td class="description">:</td>
                        <td class="price">020</td>
                    </tr>
                    <tr>
                        <td class="description">G</td>
                        <td class="description">:</td>
                        <td class="price"><?= $printedWeightBruto ?></td>
                    </tr>
                    <tr>
                        <td class="description">T</td>
                        <td class="description">:</td>
                        <td class="price"><?= $printedWeightTara ?></td>
                    </tr>
                    <tr>
                        <td class="description">N</td>
                        <td class="description">:</td>
                        <td class="price"><?= $printedWeightNetto ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
		<input type="hidden" id="btnPrint" class="hidden-print">
        <button id="btnPrint" class="hidden-print">Print</button>
        <script src="script.js"></script>
	
    </body>
</html>