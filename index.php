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
      <form action="tesprint.php" method="post">
        <fieldset>
		
          <legend></span> Form Input Scaling</legend>
		  <input type="text" name="nopol" placeholder="No Pol" value="" required>
          <input type="text" name="weightIn" placeholder="Bruto" value="" required>
          <input type="text" name="weightOut" placeholder="Tara" value=""required>
          <input type="text" name="supplierName" placeholder="Nama Supplier" value=""required>
          <input type="text" name="travelPassWeight" placeholder="Berat Surat Jalan" value=""required>
         <select name="armada" id="armada" required>
				<option >Potongan</option>
				<option value="100">Pickup - 100 kg</option>
				<option value="200">Colt Desel dll - 200 kg</option>
			</select>
          <table class="element" cellspacing='0' cellpadding='0' style='width:100%; font-size:10pt;  border-collapse: collapse;' border='0'>
            <tr>
              <td>
                <input style='width:80%;' href="print.php" type="submit"name="calculateButton" value="Print Baru" />
              </td>
              <td style='width:2%;'></td>
              <td>
                <input style='width:80%;'href="originalprint.php" type="submit"name="defaultbutton" value="Print Asli" />
              </td>
            </tr>
          </table>
        </fieldset>
      </form>
    </div>
	
	
  </body>
</html>