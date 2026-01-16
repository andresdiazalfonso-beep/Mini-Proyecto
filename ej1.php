<?php
// Rellena un array con 10 enteros aleatorios y los muestra separados por comasdasdasdasa
$num = [];
for ($i = 0; $i < 10; $i++) {
	$num[] = rand(0, 100);
}

echo implode(',', $num);

?>
