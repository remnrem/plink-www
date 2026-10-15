<?php

// Read in data to plot and make into pairs

$myFile = "mds.txt";
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
fclose($fh);

$d = array( strtok($theData," \n\t") );

while ($mds !== false) {
   $mds = strtok(" \n\t");
   $d[] = $mds;
}

$c=0;
for($i=0; $i<count($d)-1; $i+=2) {
 $x[$c] = $d[$i];
 $y[$c] = $d[$i+1];
 $c++;
}

// Read in data the keeps track of where we are 
// in terms of being zoomed in/out
// format X1 Y1 X2 Y2 
// scale is 0 to 100

$myFile = "mds.txt.meta";
$fh = fopen($myFile, 'r');
$theData = fread($fh,filesize($myFile));
fclose($fh);

$curX1 = strtok($theData," \n\t");
$curY1 = strtok(" \n\t");
$curX2 = strtok(" \n\t");
$curY2 = strtok(" \n\t");

// Process user click: 
// Determine range for graph, given user input

$minX = min($x); $maxX = max($x);
$minY = min($y); $maxY = max($y);

// Finally make some extra space around the edge

$rangeX = $maxX - $minX;
$rangeY = $maxY - $minY;

$maxX += $rangeX/10;
$maxY += $rangeY/10;
$minX -= $rangeX/10;
$minY -= $rangeY/10;

// And rescale to 0->1

for($i=0; $i<count($x); $i++) { 

 $x[$i] = ( $x[$i] - $minX ) / ( $maxX - $minX ); 
 $y[$i] = ( $y[$i] - $minY ) / ( $maxY - $minY ); 

}

// Now determine instead of 0 to 1 range, base on the current window

for($i=0; $i<count($x); $i++) { 

 $x[$i] = ( $x[$i] - $curX1 ) / ( $curX2 - $curX1 ); 
 $y[$i] = ( $y[$i] - $curY1 ) / ( $curY2 - $curY1 ); 

}

// Get min and max of X and Y

// Are we in TEXT MODE?

if ($mode == 2) 
{

$myFile = "id.txt";
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
fclose($fh);

$s = array( strtok($theData," \n\t") );
$s[0] = $s[0]."/".strtok(" \n\t");

while ($fid !== false && $iid !== false ) {
   $fid = strtok(" \n\t");
   $iid = strtok(" \n\t");
   $s[] = $fid."/".$iid;;
}
}


// Define .PNG image
header("Content-type: image/png");
$csX=640;
$csY=640;

// Create image and define colors
$image=imagecreate($csX+1, $csY+1);
$colorWhite=imagecolorallocate($image, 255, 255, 255);
$colorBlack=imagecolorallocate($image, 0, 0, 0);
$colorGrey=imagecolorallocate($image, 192, 192, 192);
$colorBlue=imagecolorallocate($image, 0, 0, 255);

// Create border around image
imageline($image, 0, 0, 0, $csY, $colorGrey);
imageline($image, 0, 0, $csX, 0, $colorGrey);
imageline($image, $csX, $csY, $csX, $csY, $colorGrey);
imageline($image, 0, $csY, $csX, $csY, $colorGrey);

// Create grid
for ($i=1; $i<11; $i++){
imageline($image, $i*($csX/10), 0, $i*($csX/10), $csY, $colorGrey);
imageline($image, 0, $i*($csY/10), $csX, $i*($csY/10), $colorGrey);
}

// Position (0,0) refers to the top-left corner of the grid, 
// and position (csX,csY) refers to the bottom right. 


// Create scatter plot
for ($i=0; $i<count($x); $i++){

if ($mode==1)
{ imagefilledellipse($image, round($x[$i] * $csX), round($y[$i]*$csY) , 5 , 5 , $colorBlue); }
else
{ imagestring($image, 4 , round($x[$i] * $csX), round($y[$i]*$csY) , $s[$i] , $colorGrey); }

}

// Output graph and clear image from memory
imagepng($image);
imagedestroy($image);
?>

