<?php 
error_reporting(2);
require_once('config.php');
require_once('db.php');
require_once('functions.php');

// BRISANJE 

if ($_REQUEST['akcija'] == 'delete') {
	brisanje_reda($_GET['id']);

} else if ( $_REQUEST['akcija'] == 'add') {
	dodaj_novi_unos($_REQUEST['ime'], $_REQUEST['cena'], $_REQUEST['opis'], $_REQUEST['tip']);

}

	$kategorija = sanitize_input($_GET['kat']);
	$tabela = kreiranje_tabele($kategorija);
?>
<html>
<head>
	<style>
	table td, table th{
		border: 1px solid black;
		padding: 10px;
	}	

	</style>		
</head>
<body>
<?php 
	kreiraj_meni();
 ?>
<table>
	<tr>
		<th>ID</th>
		<th>Product Type</th>
		<th>Name</th>
		<th>Price</th>
		<th>Description</th>
		<th>Picture</th>
		<th>PartNum</th>
		<th>Akcije</th>
	</tr>
<?php 
	echo $tabela;
 ?>



</table>


<form action="" method="post">
	Name: <input type="text" name="ime"><br>
	Type: 
	<select name="tip" id="tip">
		<?php 
		$sql = "SELECT DISTINCT productType FROM products";
		$result = mysql_query($sql, $db);
		while( $row = mysql_fetch_assoc($result) ): ?>
			<option value="<?php echo $row['productType']; ?>"><?php echo $row['productType']; ?></option>
		<?php
		endwhile;
		 ?>
		
	</select>
	<br>
	Price: <input type="text" name="cena"><br>
	Description: <input type="text" name="opis"><br>
	<input type="hidden" name="akcija" value="add">
	<input type="submit" value="Send">
</form>

</body>
</html>
