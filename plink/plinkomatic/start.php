<?php

$x1 = 0;
$y1 = 0;
$x2 = 1;
$y2 = 1;

$filename = "mds.txt.meta";
$handle = fopen($filename, 'w'); 
fwrite($handle, $x1." ");
fwrite($handle, $y1." ");
fwrite($handle, $x2." ");
fwrite($handle, $y2." ");
fclose($handle);

echo "<form action=\"coord.php\">";
echo "<input type=image src=\"main.php\" name=\"pt\">";
echo "<input type=submit name=clear value=\"Reset\">";
echo "<input type=hidden name=x1 value=".$x1.">";
echo "<input type=hidden name=x2 value=".$x2.">";
echo "<input type=hidden name=y1 value=".$y1.">";
echo "<input type=hidden name=y2 value=".$y2.">";
echo "</form>";
echo "<BR>";
?>

