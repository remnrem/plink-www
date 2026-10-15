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
function UndoForm()
{
	foreach ($_SESSION as $VarName => $Value)  
	{
	   unset ($_SESSION[$VarName]);
	}
}


session_start();
UndoForm();

//if(isset($_SESSION['fmt1'])) {
// unset($_SESSION['fmt1']); }
//if(isset($_SESSION['fmt2'])) {
// unset($_SESSION['fmt2']); } 
 
//if(isset($_SESSION['sel1'])) {
// unset($_SESSION['sel1']); }
//if(isset($_SESSION['sel2'])) {
// unset($_SESSION['sel2']); }
?>

</p>&nbsp;</p>


<div id=layer1 style="position:relative; left:20px;width:80%;">

<b>What type of input fileset do you wish to use?</b> The default is the standard text, 
white-spaced-delimited (tab and/or space) <a href="../data.shtml#ped">PED and MAP fileset</a>. 
Alternatively, <a href="../data.shtml#bed">binary filesets</a> are compressed to load faster and require 
less disk space. (To create a binary fileset, select <em>Create binary fileset</em> in the Data Management 
options on the next page.) In both cases, you can choose a phenotype from an <a 
href="../data.shtml#pheno">alternate file</a>.

</p>

<form action="pom1b.php" method="get">

<input type="hidden" name="e" value="0">


<table width=100%>
<tr>
	
	<td width=60% valign="top">
	&nbsp; &nbsp; &nbsp;
	<input type="radio" align="MIDDLE" name="fmt1" value="ped" checked> 
	Standard text-based PED/MAP fileset <br>

	&nbsp; &nbsp; &nbsp;
	<input align="TOP" type="radio" name="fmt1" value="bed"> 
	Binary BED/BIM/FAM fileset <br>
	</td>
	<td width=40% valign="top">
	&nbsp; &nbsp; &nbsp;
	<input type="radio" align="MIDDLE" name="fmt2" value="one" checked> 
	Default fileset phenotype <br>

	&nbsp; &nbsp; &nbsp;
	<input align="TOP" type="radio" name="fmt2" value="mul"> 
	Use alternate phenotype file<br>
	</td>
</tr>
</table>



</p>&nbsp;</p>

<b>Define filters to exclude SNPs and/or individuals?</b> Please indicate 
whether you will wish to include all SNPs and all individuals in whatever procedure you next select, 
or if you want the option to impose a set of filters based on factors such as 
allele frequency, missing genotype rate and/or chromosomal location.
</p>


<table width=100%>
<tr>
	<td width=60% valign="top">
	&nbsp; &nbsp; &nbsp;
	<input type="radio" align="MIDDLE" name="sel1" value="no" checked> 
	Do not define SNP or individual filtering thresholds <br>
	&nbsp; &nbsp; &nbsp;
	<input type="radio" align="TOP" name="sel1" value="yes"> 
	Define SNP and/or individual filtering thresholds <br>
	</td>
	
	<td width=40% valign="top">
	&nbsp; &nbsp; &nbsp;
	<input type="radio" align="MIDDLE" name="sel2" value="no" checked> 
	Do not filter SNPs by location <br>
	&nbsp; &nbsp; &nbsp;
	<input type="radio" align="TOP" name="sel2" value="yes"> 
	Filter SNPs by location <br>	
	</td>
</tr>
</table>



</p>

<div align="right">
<input type="submit" class="button" value="Select type of analysis">
</div>
</form>


<hr>
</div>

</body>
</html>

