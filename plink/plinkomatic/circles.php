<?php
header("Content-Type: image/svg+xml");
$output = NULL;

$output .= "<?xml version=\"1.0\" standalone=\"no\"?>\n";

$output .= "<svg width=\"100%\" height=\"100%\" viewBox=\"0 0 0 0\" xmlns=\"http://www.w3.org/2000/svg\" 
xmlns:a=\"http://www.adobe.com/svg10-extensions\" a:timeline=\"independent\">\n\n";

srand((double)microtime()*1000000);
$nri = rand(15,50);


for ($i = 1; $i < $nri; $i++) {
srand((double)microtime()*1000000);
$string = '0123456789ABCDEF';
$r = rand(0,15);
$r = substr($string, $r, 1);
$g = rand(0,15);
$g = substr($string, $g, 1);
$b = rand(0,15);
$b = substr($string, $b, 1);
$color1 = $r . $g . $b;

$r = rand(0,15);
$r = substr($string, $r, 1);
$g = rand(0,15);
$g = substr($string, $g, 1);
$b = rand(0,15);
$b = substr($string, $b, 1);
$color2 = $r . $g . $b;

$r = rand(0,15);
$r = substr($string, $r, 1);
$g = rand(0,15);
$g = substr($string, $g, 1);
$b = rand(0,15);
$b = substr($string, $b, 1);
$color3 = $r . $g . $b;

$x = rand(1,1000);
$cx = ($x + rand(-150,150));
$y = rand(1,400);
$cy = ($y + rand(-150,150));

$x1 = rand(1,1000);
$x2 = rand(1,1000);

$y1 = 600;
$y2 = -200;

$cs = rand(5,30);
$r = rand(20,70);

$nr2 = rand(1,20);

$output .= " <circle id=\"circle$i\" cx=\"$x\" cy=\"$y1\" r=\"$r\" fill=\"#$color2\" stroke=\"#$color3\" stroke-width=\"$nr2\" style=\"opacity: .5; 
cursor: pointer;\">\n";

$output .= " <animate attributeName=\"cy\" from=\"$y1\" to=\"$y2\" dur=\"$cs\" repeatCount=\"indefinite\"/>\n";
$output .= " <animate attributeName=\"cx\" from=\"$x1\" to=\"$x2\" dur=\"$cs\" repeatCount=\"indefinite\"/>\n";


$output .= " </circle>\n";

}

$output .= "</svg>\n";

print $output;
?>

