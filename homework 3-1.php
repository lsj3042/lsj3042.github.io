<?php
$n = 30;
$sum = 0;
$prod = 1;
for ($i=0; $i<$n; $i++){
    $sum += $i;
    echo "$i + ";
}
echo " = $sum";
echo "<p>";
for ($j=1; $j<$n; $j++){
    $prod = $prod * $j;
    echo "$j * ";
}
echo " = $prod";
?>
