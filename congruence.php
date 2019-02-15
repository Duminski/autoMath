<?php

include "entete.html";

echo '<h1>Congruences</h1>';

echo 	'<form action=' . $_SERVER['PHP_SELF'] . ' method="post">
		  pgcd: <input type="text" name="pgcd"><br>
		  modulo: <input type="text" name="modulo"><br>
		  <input type="submit" value="Submit">
		</form>';

if (isset($_POST['pgcd']) && isset($_POST['modulo'])) {
	$pgcd = $_POST['pgcd'];
	$mod = $_POST['modulo'];

	echo '<table id="pgcd">';

	echo '<tr>';
		echo '<td>a</td>';
		echo '<td>b</td>';
		echo '<td>r</td>';
		echo '<td>q</td>';
	echo '</tr>';

	$keys = array(array('modulo', 'pgcd', 'res', 'quotient'));
	$i = 0;
	do {

	echo '<tr>';
		$res = $mod%$pgcd;
		$quotient = (int)($mod/$pgcd);
		echo '<td>' . $mod . '</td>';
		echo '<td>' . $pgcd . '</td>';
		echo '<td>' . $res . '</td>';
		echo '<td>' . $quotient . '</td>';

		$tabRes[$i]['modulo'] = $mod;
		$tabRes[$i]['pgcd'] = $pgcd;
		$tabRes[$i]['res'] = $res;
		$tabRes[$i]['quotient'] = $quotient;
		
		$mod = $pgcd;
		$pgcd = $res;
		$i += 1;
	echo '</tr>';

	}while($res!==0);

	echo '<tr>';
			echo '<td>' . $mod . '</td>';
			echo '<td>' . $pgcd . '</td>';
	echo '</tr>';


	echo '</table>';

	
	$preserved = array_reverse($tabRes, true);
	$keys = array(array('u','v'));
	$i = 0;
	//if ($pgcd == 1)	{
	$u = 1;
	$v = 0;
		do {

			foreach ($preserved as $val){
					$tabUv[$i]['u'] = $u;
					$tabUv[$i]['v'] = $v;
					$tmp_v = $v;
					$v = $u-$val['quotient']*$v;
					$u = $tmp_v;
					$i+=1;
			}
			

		}while($res!==0);

	}
	$tabUv[$i]['u'] = $u;
	$tabUv[$i]['v'] = $v;
	$preservedUv = array_reverse($tabUv, true);
	
	echo '<table>';

	echo '<tr>';
		echo '<td>u</td>';
		echo '<td>v</td>';
	echo '</tr>';
	foreach($preservedUv as $val){
		echo '<tr>';
		echo '<td>' . $val['u'] . '</td>';
		echo '<td>' . $val['v'] . '</td>';
		echo '</tr>';
	}
	echo '</table>';

echo '<table>';

	echo '<tr>';
		echo '<td>a</td>';
		echo '<td>b</td>';
		echo '<td>r</td>';
		echo '<td>q</td>';
		echo '<td>u</td>';
		echo '<td>v</td>';
	echo '</tr>';
	$i = 0;
foreach($tabRes as $val){
	echo '<tr>';
		echo '<td>' . $val['modulo'] . '</td>';
		echo '<td>' . $val['pgcd'] . '</td>';
		echo '<td>' . $val['res'] . '</td>';
		echo '<td>' . $val['quotient'] . '</td>';
		
		echo '<td>' . $tabUv[$i]['u'] . '</td>';
		echo '<td>' . $tabUv[$i]['v'] . '</td>';
	echo '</tr>';
	$i+=1;
}
echo '</table>';

//}
//else {
	//echo '<p>Valeur non init</p>';
//}

include "fin.html";

?>