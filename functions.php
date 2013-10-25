<?php 
function kreiraj_meni(){
	global $db;
	?>
	<a href="?kat=1">All</a> | 

<?php 
$sql = "SELECT DISTINCT productType from products";
$result2 = mysql_query($sql, $db);
$br_redova = mysql_num_rows($result2);

$no = 1;
while ($row = mysql_fetch_assoc($result2)):
?>
	<a href="?kat=<?php echo strtolower($row['productType']); ?>"><?php echo $row['productType']; ?></a>

<?php
	if ($no != $br_redova) echo "|";

	$no++;
endwhile;

}


function kreiranje_tabele($kategorija) {
	global $db;

	$kategorija = str_replace("_", " ", $kategorija);
	$filter = "WHERE productType = '$kategorija'";
	$sql = "SELECT * FROM products";
	if( $kategorija != 1 && $kategorija ) $sql = $sql . " " . $filter;
	$result = mysql_query($sql, $db);

	ob_start();
	while( $row = mysql_fetch_assoc($result)):
 ?>
	<tr>
		<td><?php echo $row['productID']; ?></td>
		<td><?php echo $row['productType']; ?></td>
		<td><?php echo $row['productName']; ?></td>
		<td><?php echo $row['price']; ?></td>
		<td><?php echo $row['description']; ?></td>
		<td><img src="images/<?php echo $row['imageName']; ?>"></td>
		<td><?php echo $row['partNum']; ?></td>
		<td>EDIT | <a href="?id=<?php echo $row['productID']; ?>&akcija=delete">DELETE</a></td>

	</tr>
<?php 
	endwhile;
	$buffer = ob_get_clean();
	return $buffer;

}

function sanitize_input($input) {
	$input = mysql_real_escape_string($input);
	return $input;
}


function brisanje_reda( $id ) {
	global $db;

	
 	$sql = "DELETE FROM products WHERE productID = $id";
	mysql_query($sql, $db);
}


function dodaj_novi_unos($ime, $cena, $opis, $tip) {
	global $db;
	
	$sql = "INSERT INTO products SET productName = '$ime', price = '$cena', productType='$tip', description = '$opis'";
	mysql_query($sql, $db);
}
?>