<?php
header("Content-Type: image/svg+xml");

$output = NULL;

$output .= "<?xml version=\"1.0\" standalone=\"no\"?>\n";
$output .= "<svg width=\"640\" height=\"640\" viewBox=\"0 0 640 640\"  id=\"svgAll\"  ";
$output .= "xmlns=\"http://www.w3.org/2000/svg\" xmlns:a=\"http://www.adobe.com/svg10-extensions\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" >\n\n";

$output .= "<script> <![CDATA[ ";
$output .= " function changeText(id) { var t = \"Individual ID : \" + id; var dID = document.getElementById(\"vID\"); dID.firstChild.setData(t); } ]]> </script> \n";

$output .= "<script>   \n";
$output .= "function syncRect()  {  \n";

$output .= "   var b = document.getElementById(\"vID\")  \n ";
$output .= "   var r = document.rootElement   \n";
$output .= "   var s = 1/r.currentScale    \n";
$output .= "   b.setAttribute( \"transform\", \"scale(\" + s + \",\" + s + \")\" )    \n";
$output .= "   b.setAttribute( \"x\", -r.currentTranslate.x + 20 )   \n";
$output .= "   b.setAttribute( \"y\", -r.currentTranslate.y + 20 )   \n";
//$output .= "   b.setAttribute( \"width\", getInnerWidth() - 20 )     \n";
//$output .= "   b.setAttribute( \"height\", getInnerHeight() - 20 )  \n";
$output .= " } \n ";

$output .= " document.rootElement.addEventListener( \"SVGScroll\", syncRect, false )  \n";
$output .= " document.rootElement.addEventListener( \"SVGResize\", syncRect, false )  \n";
$output .= " document.rootElement.addEventListener( \"SVGZoom\", syncRect, false )    \n";
$output .= " syncRect() </script>   \n ";


$output .= " <defs> <filter id=\"DropShadowFilter\" filterUnits=\"objectBoundingBox\" x=\"-10%\" y=\"-10%\" width=\"120%\" height=\"120%\">  \n";
$output .= " <feGaussianBlur in=\"SourceAlpha\" stdDeviation=\"2\" result=\"BlurAlpha\"/>  \n ";
$output .= " <feOffset in=\"BlurAlpha\" dx=\"4\" dy=\"4\" result=\"OffsetBlurAlpha\"/>  \n";
$output .= " <feMerge>  <feMergeNode in=\"OffsetBlurAlpha\"/>  <feMergeNode in=\"SourceGraphic\"/>   </feMerge>  </filter>  </defs>  \n";


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

// Get min and max of X and Y

// Are we in TEXT MODE?

$myFile = "id.txt";
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
fclose($fh);

$s = array( strtok($theData," \n\t") );
$s[0] = $s[0]." / ".strtok(" \n\t");

while ($fid !== false && $iid !== false ) {
   $fid = strtok(" \n\t");
   $iid = strtok(" \n\t");
   $s[] = $fid." / ".$iid;;
}


$csX=600;
$csY=600;


// Position (0,0) refers to the top-left corner of the grid, 
// and position (csX,csY) refers to the bottom right. 

// Create scatter plot
for ($i=0; $i<count($x); $i++)  {

$px = round($x[$i] * $csX);
$py = round($y[$i] * $csY) ;

$output .= "<circle id=\"circle$i\" cx=\"$px\" cy=\"$py\" r=\"5\" fill=\"lightblue\" stroke=\"#555555\" stroke-width=\"1\" ";
//$output .= " style=\"opacity: .5; cursor: pointer; filter:url(#DropShadowFilter) \"  \n";
$output .= " style=\"opacity: .5; cursor: pointer; \"  \n";
$output .= " onmouseover=\"changeText('$s[$i]');\" onmouseout=\"changeText('');\" > \n";
$output .= " </circle>\n";

}


// Display frame 
//$output .= "<g style=\"fill:none; stroke:blue; stroke-width:1; filter:url(#DropShadowFilter)  \"> \n";
$output .= "<g style=\"fill:none; stroke:blue; stroke-width:1;  \"> \n";
$output .= "<rect  id=\"frame1\" x=\"1\" y=\"1\" width=\"600\" height=\"600\"/> </g>\n";
$output .= " <text id=\"vID\" x=\"5\" y=\"5\" font-size=\"16\"> </text> \n "; 



$output .= "</svg>\n";

print $output;
?>

