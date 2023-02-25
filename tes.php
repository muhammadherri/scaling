<?php 
    $WEIGHT_DEDUCTOR = 80;

    function getPrintedRandomWeightNettoWithRatio($weightDifference, $benefitRatio=90) {
        $benefitInWeight = ( (100 - $benefitRatio) * $weightDifference)/100;
        $minWeightRandomNumber = $benefitInWeight - (ceil($benefitInWeight/100)*50);
    
        $temp = random_int($minWeightRandomNumber, $benefitInWeight);

        return $temp;
    }

    if(isset($_POST["calculateButton"])){
        $weightIn = $_POST["weightIn"];
        $weightOut = $_POST["weightOut"];
        $supplierName = $_POST["supplierName"];
        $travelPassWeight = $_POST["travelPassWeight"];

        $realWeightBruto = $weightIn;
        $realWeightTara = $weightOut;
        $realWeightNetto = $realWeightBruto - $realWeightTara;

        echo "Real Weight <br> Bruto : $realWeightBruto <br> Tara : $realWeightTara <br> Netto : $realWeightNetto <br><br>";

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

        echo "Printed Weight <br>";
        echo "Bruto : ".$printedWeightBruto."<br>";
        echo "Tara : ".$printedWeightTara."<br>";
        echo "Netto: ".$printedWeightNetto."<br>"; 

        echo "<br> Value Won : ".($realWeightNetto - $printedWeightNetto)."<br>";

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Afval Lokal scaling simulation</h1>
    <form action="#" method="post">
        Berat Masuk : <input type="text" name="weightIn" value="<?= $weightIn ?>" required> <br>
        Berat Keluar : <input type="text" name="weightOut" value="<?= $weightOut ?>" required> <br>
        Nama Supplier : <input type="text" name="supplierName" value="<?= $supplierName ?>" required> <br>
        <!-- Nomor Truck : <input type="text" name=""  required> <br> -->
        Berat Surat Jalan : <input type="text" name="travelPassWeight" value="<?= $travelPassWeight ?>" required> <br>
        
        <button type="submit" name="calculateButton" > Calculate & Print </button>
    </form>
</body>
</html>