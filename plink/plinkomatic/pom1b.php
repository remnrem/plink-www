<html>
<head>
<STYLE>
<!--
a {text-decoration:none}
//-->
</STYLE>
</head>
<body>

<head>
<link rel="stylesheet" href="plink.css" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<title>PLINK: Whole genome data analysis toolset</title>
</head>

<font size="6" color="darkgreen"><b>plink-o-matic...</b></font>
<h1>Choose the analysis you want from the tree...</h1>

<div align=right style="width:87%;">
<a href="pom1.php">Start over on page 1</a>
</div>

<?php

session_start(); 

// Errchecked means "came from build_command.  We need to unset this for pom2 to 
// use the new m and p values. 
unset ($_SESSION['errchecked']);
unset ($_SESSION['m']);
unset ($_SESSION['p']);

if(!isset($_SESSION['fmt1'])) {
 $_SESSION['fmt1'] = $_GET['fmt1']; }
 
 if(!isset($_SESSION['fmt2'])) {
 $_SESSION['fmt2'] = $_GET['fmt2']; }

if(!isset($_SESSION['sel1'])) {
 $_SESSION['sel1'] = $_GET['sel1']; }
 
if(!isset($_SESSION['sel2'])) {
 $_SESSION['sel2'] = $_GET['sel2']; } 


$fmt1 = $_SESSION['fmt1'];
$fmt2 = $_SESSION['fmt2'];
$sel1 = $_SESSION['sel1'];
$sel2 = $_SESSION['sel2'];

/*
echo "sel1 ".$sel1."<br ?>";
echo "sel2 ".$sel2."<br ?>";
*/

include("xmltree.php");

$tree = new tree; 

$html = $tree->makeTree("display.xml");

// Print out Tree Html
print $html . "<br>";

?>


</body>
</html>

