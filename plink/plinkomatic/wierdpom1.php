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
<h1>Some basic information first...</h1>

<?php
session_start();
if(isset($_SESSION['fmt'])) {
 unset($_SESSION['fmt']); }
if(isset($_SESSION['sel'])) {
 unset($_SESSION['sel']); }
?>

</p>&nbsp;</p>


<div id=layer1 style="position:relative; left:20px;width:80%;">

<b>What type of input data do you wish to use?</b> The default is the standard text, 
white-spaced-delimited (tab and/or space) PED and MAP files. The required format for PED 
and MAP files is described in the main PLINK website. Binary filesets are compressed to 
load faster and require less disk space. You can convert a PED/MAP into a binary fileset 
by selecting the <em>Create binary fileset</em> data management option on the 
next page (but still select PED/MAP file on this page).

</p>

<form action="pom1b.php" method="get">

<input type="hidden" name="e" value="0">

&nbsp; &nbsp; &nbsp;
<input type="radio" align="MIDDLE" name="fmt1" value="ped" checked> 
Standard text-based PED/MAP fileset <br>

&nbsp; &nbsp; &nbsp;
<input align="TOP" type="radio" name="fmt1" value="bed"> 
Binary BED/BIM/FAM fileset <br>

&nbsp; &nbsp; &nbsp;
<input type="radio" align="MIDDLE" name="fmt2" value="one" checked> 
Default single phenotype <br>

&nbsp; &nbsp; &nbsp;
<input align="TOP" type="radio" name="fmt2" value="mul"> 
Alternate phenotype fileset <br>

<?php
//if ($fmt1=="ped" && $fmt2== "one")
//	{?> <input type="hidden" name="fmt" value="pedone"> <?php}
//elseif ($fmt1=="ped" && $fmt2=="mul")
//	{?> <input type="hidden" name="fmt" value="pedmul"> <?php}
//elseif ($fmt1=="bed" && $fmt2== "one")
//	{?> <input type="hidden" name="fmt" value="bedone"> <?php}
//elseif ($fmt1=="bed" && $fmt2=="mul")
//	{?> <input type="hidden" name="fmt" value="bedmul"> <?php}
?>

</p>&nbsp;</p>

<b>Define filters to exclude SNPs and/or individuals?</b> Second, please indicate 
whether you will wish to include all SNPs and all individuals in whatever procedure you next select, 
or if you want the option to impose a set of filters based on factors such as 
allele frequency and missing genotype rate.
</p>

&nbsp; &nbsp; &nbsp;
<input type="radio" name="sel" value="no" checked> 
Do not define SNP or individual filtering thresholds <br>
&nbsp; &nbsp; &nbsp;
<input type="radio" name="sel" value="yes"> 
Define SNP and/or individual filtering thresholds <br>

</p>

<div align="right">
<input type="submit" value="Select type of analysis">
</div>
</form>

<hr>
</div>

</body>
</html>

