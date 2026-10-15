<html>
<body>

<head>
<link rel="stylesheet" href="plink.css" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<title>PLINK: Whole genome data analysis toolset</title>
</head>

<font size="6" color="darkgreen"><b>plink-o-matic...</b></font>

<!-- Start Session, set variables -->
<?php
session_start();
?>

<!-- _____Describe analysis________________________________________ -->
<h1>Here is the analysis you requested...</h1>


<?php 
include("in_and_out.php"); 
echo $input;
echo $warning;
?>

<!-- _____End Describe Analysis____________________________________ -->



<!-- _____Build Command____________________________________________ -->
&nbsp;
</p>

<h1>Here is the command you should run...</h1>

<div align="center">
</p>&nbsp;</p>
<font size="+0">
<div style="margin-left:auto; margin-right:auto; width:70%; text-align: 
center;border: 1px dotted #000000; 
background-color:#e7e7ff;">
<?php
echo "<tt>plink " .$cmdline . " </tt><br>";
?>
</div>
</font>
<br />

<font size="-1">
<div style="margin-left:auto; margin-right:auto; width:60%; text-align: center">
<em>
Commands in PLINK should be entered as a single line.  If the command wraps onto multiple
lines, you may need to remove the extra spaces before running it.
</em>
</div>
</font>
</div>





<!-- _____End Build Command________________________________________ -->


<!-- _____Output Expected__________________________________________ -->
</p>
&nbsp;</p>

<h1>Here is the output you should expect...</h1>

<table border=0 width=80%>
<tr><td width=50% valign="top">
<table border=0 width=100%>
<tr><td width=30%><em><b>File</b></em></td>
<td><em><b>Description</b></em></td></tr>
<?php
echo $output
?>
</table>
</td>
<td width=50% valign="top">
<table border=0 width=100%>
<tr><td width=30%><em><b>File</b></em></td>
<td><em><b>Description</b></em></td></tr>
<tr><td><?php echo $out.".log"?></td>
<td>Log file</td></tr>
<tr><td><?php echo $out.".irem"?></td>
<td>Removed individuals (low genotyping)</td></tr>
<tr><td><?php echo $out.".hh"?></td>
<td>Heterozygous haploid genotype calls</td></tr>
</table>
</td></tr>
</table>
</p>

<!-- _____End Output Expected______________________________________ -->



<center>
<hr width=50%>
<em>Thanks for using PLINK and PLINK-O-MATIC!</em>

<hr width=50%>

<div align=right style="width:80%;">
<a href="pom1.php">Start over on page 1</a>
</div>
 
<div align=right style="width:80%;">
<a href="pom1b.php">Choose a new test on page 2</a>
</div>

<div align=right style="width:80%;">
<a href="pom2.php">Edit flags on page 3</a>
</div>

<div align=right style="width:80%;">

<!--
<?php
echo " <a href=\"pom2.php?m=".$m;
if ($p) echo "&amp;p=".$p;
echo "\">Return to the third page</a> ";
?>
-->

</div>

</body>
</html>

