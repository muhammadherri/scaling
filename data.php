<!DOCTYPE html>
<html>
<head>
    <title>BM Scaling</title>
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">
</head>
<body>
<form method="POST" >
	<input type="date" id="tgl" name="tgl">
	<input type="submit"name="search" value="search" />
</form>
<br>
<br>
<table id="scaling" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Supplier Name</th>
            <th>No Polisi</th>
            <th>Adj</th>
            <th>Gross</th>
			<th>Tara</th>
			<th>Surat Jalan</th>
			<th>Act Netto</th>
			<th>Adj Netto</th>
			<th>Adj Gross</th>
			<th>Created At</th>
        </tr>
    </thead>
    <tbody>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "timbangan";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	if(isset($_POST["search"])){
		$tgl = $_POST["tgl"] ;
		$sqlsearch = "SELECT * FROM bm_scaling where date ='".$tgl."'";
		$result = $conn->query($sqlsearch);
		if ($result->num_rows > 0) {
		  // output data of each row
			while($row = $result->fetch_assoc()) {
			echo "<tr>
					<td>".$row['supplier_name']."</td>
					<td>".$row['nopol']."</td>
					<td>".$row['adjustment']."</td>
					<td>".$row['gross']."</td>
					<td>".$row['tara']."</td>
					<td>".$row['surat_jalan']."</td>
					<td>".$row['act_netto']."</td>
					<td>".$row['adj_netto']."</td>
					<td>".$row['adj_gross']."</td>
					<td>".$row['created_at']."</td>
				</tr>";
			}
		} else {
		  // echo "No Data Available";
		}
		$conn->close();
	}
?>
</tbody>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
    <script>
		$(document).ready(function() {
			$('#scaling').DataTable( {
				searching: false,
				dom: 'Bfrtip',
				 buttons: [
					 'excel'
				]
			} );
		} );
	</script>

</table>
</body>
</html>