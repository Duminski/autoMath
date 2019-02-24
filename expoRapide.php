<?php

include "enteteER.html";

echo '<h1>Exponentiation rapide</h1>';

echo 	'<form action=' . $_SERVER['PHP_SELF'] . ' method="post">
		  pgcd: <input type="text" name="pgcd"><br>
		  modulo: <input type="text" name="modulo"><br>
		  puissance: <input type="text" name="power"><br>
		  <input type="submit" value="Submit">
		</form>';
echo '</br>';

if (isset($_POST['pgcd']) && isset($_POST['modulo']) && isset($_POST['power'])) {
	$pgcdOr = $_POST['pgcd'];
	$mod = $_POST['modulo'];
	$power = $_POST['power'];

	if (is_numeric($pgcdOr) && is_numeric($mod) && is_numeric($power)) {
		if ($pgcdOr != 0 && $mod != 0 && $power != 0) {


			echo '<table>';

			echo '<tr>';
				echo '<th>i</th>';
				echo '<th>a(i)</th>';
				echo '<th>alpha^(2i)</th>';
			echo '</tr>';

			$binary = str_split(decbin($power));
			$binary = array_reverse($binary);

			$pgcd = $pgcdOr;
			$pgcdFinal = 1;

			foreach ($binary as $key => $value) {				
				echo '<tr>';
					echo '<td>' . $key . '</td>';
					echo '<td>' . $value . '</td>';
					echo '<td>' . $pgcd . ' mod ' . $mod . '</td>';
				echo '</tr>';

				if ($value == 1) {
					$pgcdFinal *= $pgcd;
				}

				$pgcd = ($pgcd * $pgcd) % $mod;

			}

			echo '</table>';

			echo '<p>(' . $pgcdOr . ' mod ' . $mod . ')^' . $power . ' => ' . $pgcdFinal%$mod . ' mod ' . $mod . '</p>';

		}
		else {
				echo '<p>Seulement des chiffres/nombres > 0</p>';
		}
	}
	else {
		echo '<p>Seulement des chiffres/nombres</p>';
	}
}
include "fin.html";

?>