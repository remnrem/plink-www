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
<h1>Step 1) What type of input file...</h1>

<form action="pom1b.php" method="get">

include("xmltree.php");

$tree = new tree; 

$html = $tree->makeTree("display.xml");

// Print out Tree Html
print $html . "<br>";

?>

<hr>
</body>
</html>

