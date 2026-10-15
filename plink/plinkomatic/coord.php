<html>
</body>

<?php

//echo "Current window ( ".$x1." , ".$y1." , ".$x2." , ".$y2." )<br>";

$myFile = "mds.txt.meta";
$fh = fopen($myFile, 'r');
$theData = fread($fh,filesize($myFile));
fclose($fh);

$x1 = strtok($theData," \n\t");
$y1 = strtok(" \n\t");
$x2 = strtok(" \n\t");
$y2 = strtok(" \n\t");

//echo "You clicked ".$pt_x." ".$pt_y."<BR> and mode is ".$mode." <HR>";

// Zoom in (CURRENT PIXEL SIZE = 250 x 250)

$imgX = 640;
$imgY = 640;

// relative to whole image
$xcenter = $pt_x / $imgX;
$ycenter = $pt_y / $imgY;

// relative to current windo
$xcenter = $x1 + $xcenter * ( $x2 - $x1 ) ;
$ycenter = $y1 + $ycenter * ( $y2 - $y1 ) ;

$xwidth = $x2 - $x1;
$ywidth = $y2 - $y1;

$xwidth *= 0.85;  
$ywidth *= 0.85;

$x1 = $xcenter - $xwidth/2;
$x2 = $xcenter + $xwidth/2;

$y1 = $ycenter - $ywidth/2;
$y2 = $ycenter + $ywidth/2;

//echo "xcenter = ".$xcenter."<BR>";
//echo "ycenter = ".$ycenter."<BR>";
//echo "xwidth = ".$xwidth."<BR>";
//echo "ywidth = ".$ywidth."<BR>";

// Write Window location

$filename = "mds.txt.meta";
$handle = fopen($filename, 'w'); 
fwrite($handle, $x1." ");
fwrite($handle, $y1." ");
fwrite($handle, $x2." ");
fwrite($handle, $y2." ");
fclose($handle);

echo "<form action=\"clear.php\">";
echo "<input type=submit name=reset value=\"Reset\">";
echo "</form>";
echo "<HR>";


echo "<table border=0><tr><td>";

echo "<form action=\"coord.php\">";
echo "<input type=image src=\"draw.php?mode=".$mode."\" name=\"pt\">";
echo "<input type=hidden name=x1 value=".$x1.">";
echo "<input type=hidden name=x2 value=".$x2.">";
echo "<input type=hidden name=y1 value=".$y1.">";
echo "<input type=hidden name=y2 value=".$y2.">";

if ($mode == 1)
echo "<select name=\"mode\" size=2><option selected value=1>Dot</option><option value=2>ID</option></select>";
else
echo "<select name=\"mode\" size=2><option value=1>Dot</option><option selected value=2>ID</option></select>";

echo "</form>";
echo "<BR>";

echo "</td><td>";

echo "<form action=\"controls.php\">";

// Make combo box that contains list of IDs

$myFile = "id.txt";
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
fclose($fh);

echo "<select name=\"person\" multiple size=20>";

$d = array( strtok($theData," \n\t") );
$d[0] = $d[0]." ".strtok(" \n\t");

while ($fid !== false && $iid !== false ) {
   $fid = strtok(" \n\t");
   $iid = strtok(" \n\t");
   $d[] = $fid." ".$iid;;

   echo "<option>".$fid." ".$iid."</option>";
}

echo "</select>";

echo "</form>";

echo "</td></td></table>";

?>


<form enctype="multipart/form-data" action="uploader.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" value="Upload File" />
</form> 


</body>
</html>

