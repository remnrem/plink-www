<html>
<head>
<title>Form processing</title>

<?php

session_start();

$cmdline = "";
$errcnt = 0;
$errlist = "";
$varlist="";

// Turn every variable you just got into a session variable.
foreach($_GET as $variable => $value) {
   $_SESSION[$variable] = $value;
}

	
// Form Processing:
// The form is broken down by section.  Commands are added to the $cmdline variable 
// and error messages accumulate when input doesn't match.  A count is kept of all errors.
// If $errcnt=0, we go to pom3 and display the commandline built.  If $errcnt > 0,
// we go back to pom2 so the form can be fixed.


// --- Input/Output Section --------------------------------------------------------------
 if ($file && !$ped && !$map) { $cmdline .= " --file ".$file; }
 elseif ($bfile && !$bed && !$bim && !$fam) { $cmdline .= " --bfile ".$bfile; }
 elseif ($ped && $map && !$file) { $cmdline .= " --ped ".$ped." --map ".$map; }
 elseif ($bed && $bim && $fam && !$bfile) { $cmdline .= " --bed ".$bed." --bim ".$bim." --fam ".$fam; }
 elseif ($file && ($ped || $map)) 
 	{ $errcnt++; $errlist .= "<strong> Error: too many input files.</strong><br />";}
 elseif ($bfile && ($bed || $bim || $fam))
 	{ $errcnt++; $errlist .= "<strong> Error: too many input files.</strong><br />";}
 else  { $errcnt++; $errlist .= "<strong> Error: missing input files.</strong><br />";}

 // If there is a value that isn't the default, add it, otherwise leave well
 // enough alone. 
 if ($missg && $missg !="0") 
 	{$cmdline .= " --missing-genotype ".$missg;}

 if ($missp && $missp !="-9") 
 	{$cmdline .= " --missing-phenotype ".$missp;}


 if ($fmt2=="mul")
 {
 	if ($pheno && !$mpheno) {$cmdline .= " --pheno ".$pheno;}
 	elseif ($pheno && $mpheno) {$cmdline .= " --pheno ".$pheno." --mpheno ".$mpheno;}
 	elseif ($mpheno && !$pheno) 
 		{$errcnt++; $errlist .= "<strong> Error: phenotype file required.</strong><br />";}
 }

 // The default output file is plink, doesn't need display. 
 if ($out) 
 {
  if ($out !== "plink")
 	{ $cmdline .= " --out ".$out;}
 }
 else 
 	{ $errcnt++; $errlist .= "<strong> Error: no output file.</strong><br />";}
 	
// --- End of Input/Output Section -------------------------------------------------------  



// --- Data Management Section -----------------------------------------------------------
 if ($m=="recode") $cmdline .= " --recode";
 if ($m=="recode12") $cmdline .= " --recode12";
 if ($m=="recodeAD") $cmdline .= " --recodeAD";
 if ($m=="makebed") $cmdline .= " --make-bed";

 if ($m=="merge") 
 {
 	$cmdline .= " --merge ".$mergeped." ".$mergemap." --merge-mode ".$mmode;
 	if (!$mergeped || !$mergemap || !$mmode) // If one of the merge files is missing
 		{$errcnt++; $errlist .= "<strong> Error: missing merge file.</strong><br />";}
 	
 }
 
 if ($m=="mmerge") 
 {
 	if ($mmerge) 
 		{$cmdline .= " --merge-list ".$mmerge;}
 	else
 		{$errcnt++; $errlist .= "<strong> Error: missing merge-list file.</strong><br />";}
 	
 }
 
 if ($m=="extract") $cmdline .= " --extract ".$extract; 
 if ($m=="extract" && !$extract) { $errcnt++; $errlist .= "<strong> Error: no extract file.</strong><br />";}
 
 if ($m=="exclude") $cmdline .= " --exclude ".$exclude;
 if ($m=="exclude" && !$exclude) { $errcnt++; $errlist .= "<strong> Error: no exclude file.</strong><br />";} 
 
 if ($m=="keep") $cmdline .= " --keep ".$keep; 
 if ($m=="keep" && !$keep) { $errcnt++; $errlist .= "<strong> Error: no keep file.</strong><br />";}
 
 if ($m=="remove") $cmdline .= " --remove ".$remove; 
 if ($m=="remove" && !$remove) { $errcnt++; $errlist .= "<strong> Error: no remove file.</strong><br />";}
 
 if ($m=="flip") $cmdline .= " --flip ".$flip;
 if ($m=="flip" && !$flip) { $errcnt++; $errlist .= "<strong> Error: no flip file.</strong><br />";}  

 if ($m=="merge" || $m=="mmerge" || $m=="extract" || $m=="exclude" || $m=="keep" || $m=="remove" || $m=="flip")
 { 
 	if ($p=="1") $cmdline .= " --recode";
 	if ($p=="2") $cmdline .= " --make-bed";
 }
// --- End of Data Management Section ----------------------------------------------------



// --- Summary Stats Section -------------------------------------------------------------

 if ($m=="missing") { $cmdline .= " --missing"; }
 if ($m=="test-missing") { $cmdline .= " --test-missing"; }
 if ($m=="freq") { $cmdline .= " --freq"; }
 
 if ($m=="hardy") { $cmdline .= " --hardy "; }
 if ($m=="mendel") { $cmdline .= " --mendel ";}


// --- End of Summary Stats Section ------------------------------------------------------


// --- Population Stratification Section--------------------------------------------------

 if ($m=="cluster") 
 {
 	$cmdline .= " --cluster";
 	if ($pmerge) {$cmdline .= " --ppc ".$pmerge;}
 	if ($ch_matrix=="yes") $cmdline .= " --matrix";
 	
 	if (($mcc1 && !$mcc2) || ($mcc2 && !$mcc1))
 		{$errcnt++; $errlist .= "<strong>Error: Either both values or neither are required for mcc.</strong><br />";}
 	if (($mcc1 || $mcc2) && ($mc || $ch_cc=="yes"))
 		{$errcnt++; $errlist .= "<strong>Error: too many optional clustering parameters.</strong><br />";}
 	if ($mcc1 && $mcc2)
 		{$cmdline .= " --mcc ".$mcc1." ".$mcc2;}
 	if ($mc)
 		{$cmdline .= " --mc ".$mc;}
 	if ($ch_cc=="yes")
 		{$cmdline .= " --cc";}
 	
 	// Two choices: match (with matchtype optional)
 	// or qmatch and qt (both required)
 	if ($p==2)
 	{
 		if ($match) {$cmdline .= " --match ".$match;}
 		if ($matchtype) {$cmdline .= " --match-type ".$matchtype;}
		if ($qmatch && $qt) {$cmdline .= " --qmatch ".$qmatch." --qt ".$qt;}
		if ($match && ($qmatch || $qt))
			{$errcnt++; $errlist .= "<strong>Error: too many cluster files.</strong><br />";}
		// One of qmatch or qt is missing, and match is missing
		if (!$match && (!$qmatch || !$qt))
			{$errcnt++; $errlist .= "<strong>Error: missing cluster file.</strong><br />";}
 	}
 }
 
 if ($m=="genome") $cmdline .= " --genome --min " .$min;
 if ($m=="genome" && !$min) {$errcnt++; $errlist .= "<strong>Error: no min value.</strong><br />";}
 
 if ($m=="inbreeding") $cmdline .= " --het ";
 
 if ($m=="homo-run-snps")  $cmdline .= " --homo-run-snps " .$homo_run_snps;
 if ($m=="homo-run-snps" && !$homo_run_snps) {$errcnt++; $errlist .= "<strong>Error: no homo-run-snps value.</strong><br />";} 

// --- End of Population Stratification Section-------------------------------------------



// --- Linkage Disequilibrium Section--------------------------------------------------

 if ($m=="ld-r")
 {
	if ($ld==1) 
		{ $cmdline .= " --r"; }
	elseif ($ld==2) 
		{ $cmdline .= " --r2"; }
 }
 
 if ($m=="hap")
 {
 	if ($hap) {$cmdline .= " --hap ".$hap;}
 	if (!$hap) {$errcnt++; $errlist .= "<strong>Error: no hap file.</strong><br />";}

 	
 	if ($p==1) 
 		{ $cmdline .= " --hap-freq"; }
 	elseif ($p==2) 
 		{ $cmdline .= " --hap-phase"; }
 	elseif ($p==3) 
 		{ $cmdline .= " --hap-assoc"; }
 	elseif ($p==4)
 	{ 
 		$cmdline .= " --hap-impute --pp ".$pp; 
 		if ($p==4 && !$pp) {$errcnt++; $errlist .= "<strong>Error: no pp value.</strong><br />";}
 	}
 }

// --- End of Linkage Disequilibrium Section-------------------------------------------



// --- Association Analysis/Single SNP Section-----------------------------------------

 if ($m=="assoc") { $cmdline .= " --assoc"; }
 if ($m=="model") { $cmdline .= " --model"; }
 if ($m=="qt") { $cmdline .= " --assoc"; }

 if ($m=="assoc" || $m=="model" || $m=="qt" || $m=="within-file" || $m=="qt-within-file")
 {
	if ($p==2)
	{
		$cmdline .= " --perm";
	}
	elseif ($p==3)
	{
		$cmdline .= " --mperm ".$mperm;
		if (!$mperm) {$errcnt++; $errlist .= "<strong>Error: missing number of permutations.</strong><br />";}
	}
 }

 
 if ($m=="mh") { $cmdline .= " --mh"; }
 if ($m=="mh2") { $cmdline .= " --mh2"; }
 
 if ($m=="homog")
 {
 	if ($homog==1) { $cmdline .= " --bd"; }
 	elseif ($homog==2) { $cmdline .= " --homog"; }
 }
 
 if ($m=="within-file" || $m=="mh" || $m=="mh2" || $m=="homog" || $m=="qt-within-file")
 {
 	if ($within && !$ch_family=="yes") { $cmdline .= " --within ".$within; }
 	elseif ($ch_family=="yes" && !$within) { $cmdline .= " --family"; }
 	else {$errcnt++; $errlist .= "<strong>Error: choose exactly one of --within or --family.</strong><br />";}
 	
 }

 if ($m=="tdt")
 {
	
	if ($tdt==1) 
		{ $cmdline .= " --tdt"; }
	elseif ($tdt==2) 
		{ $cmdline .= " --parentdt1"; }
	elseif ($tdt==3) 
		{ $cmdline .= " --parentdt2"; }

        if ($p==2) 
                { $cmdline .= " --perm"; }

        if ($p==3) 
                { 
			$cmdline .= " --mperm ".$mperm; }
		        if (!$mperm) {$errcnt++; $errlist .= "<strong>Error: missing number of permutations.</strong><br />";
		}

 }
 
 // Currently $p=1 and $p=2 are identical, this may change later.
 if ($m=="qtdt") { $cmdline .= " --genedrop"; }


 if ($m=="gxe")
 { 	
   $cmdline .= " --gxe";
   if ($covar && !$mcovar && !$ncovar) 
   	{$cmdline .= " --covar ".$covar;}
 	elseif ($mcovar && $ncovar && !$covar) 
 		{$cmdline .= " --mcovar ".$mcovar." ".$ncovar;}
 	elseif ($covar && ($mcovar || $ncovar)) 
 		{$errcnt++; $errlist .= "<strong> Error: too many covariate files.</strong><br />";}
 	else 
 		{ $errcnt++; $errlist .= "<strong> Error: missing covariate files.</strong><br />";}
 
 }

// --- End of Association Analysis/Single SNP Section----------------------------------



// --- Association Analysis/Epistatic Analysis Section---------------------------------

if ($m=="epi")
{
	$cmdline .= " --epistasis";
	if ($p==1) 
	{ 
		$cmdline .= " --case-only"; 
	}
	
	if ($epi==1) 
		{}
	elseif ($epi==2) 
		{ $cmdline .= " --set ".$set;}
	elseif ($epi==3) 
		{ $cmdline .= " --set ".$set ." --set-by-all";}
	elseif ($epi==4)
	 	{ $cmdline .= " --set ".$set;}
	 	
	if (($epi==2 || $epi==3 || $epi==4) && (!$set))
		{$errcnt++;  $errlist .= "<strong>Error: no set file.</strong> <br />"; }
			
	$cmdline .= " --epi1 ".$epi1;
 	if (!$epi1) {$errcnt++; $errlist .= "<strong>Error: no epi1 value.</strong><br />";}
	
	$cmdline .= " --epi2 ".$epi2;	 
	if (!$epi2) {$errcnt++; $errlist .= "<strong>Error: no epi2 value.</strong><br />";}
}

if ($m=="genepi")
{
	$cmdline .= " --genepi --R";
	
	if ($p==1) { $cmdline .= " --case-only"; }
	
	$cmdline .= " --set ".$set;
	if (!$set) {$errcnt++; $errlist .= "<strong>Error: no set file.</strong><br />";}
	
	$cmdline .= " --mperm ".$perm;
	if (!$perm) {$errcnt++; $errlist .= "<strong>Error: missing number of permutations.</strong><br />";}
}

if ($m=="t2")
{
	$cmdline .= " --T2";
	
	$cmdline .= " --set ".$set;
	if (!$set) {$errcnt++; $errlist .= "<strong>Error: no set file.</strong><br />";}

	if ($p==2)
		{$cmdline .= " --perm";}
	elseif ($p==3)
	{
		$cmdline .= " --mperm ".$mperm;
		if (!$mperm) {$errcnt++; $errlist .= "<strong>Error: missing number of permutations.</strong><br />";}		
	}

}

if ($m=="sumstat")
{
	$cmdline .= " --assoc";

	$cmdline .= " --set ".$set;
	if (!$set) {$errcnt++; $errlist .= "<strong>Error: no set file.</strong><br />";}

	if ($setmin && $setmin!="1") { $cmdline .= " --set-min ".$setmin; }
	if ($setmax && $setmax!="n/a") { $cmdline .= " --set-max ".$setmax; }

	$cmdline .= " --mperm ".$mperm;
	if (!$mperm) {$errcnt++; $errlist .= "<strong>Error: missing number of permutations.</strong><br />";}			
}

// --- End of Association Analysis/Epistatic Analysis Section--------------------------



// --- Sel Global Variable Section ----------------------------------------------------

if ($sel1=="yes")
{
	if ($mind && $mind!="0.1") {$cmdline .= " --mind " .$mind;}
	if ($geno && $geno!="0.1") {$cmdline .= " --geno " .$geno;}
	if ($maf && $maf!="0.01") {$cmdline .= " --maf " .$maf;}
	if ($m=="model" && $cell && $cell!="5")
	{
		$cmdline .= " --cell " .$cell;
	}
	if ($hwe && $hwe!="0.001")
	{
		$cmdline .= " --hwe " .$hwe;
	}
	if ($ime && $fme) 
	{
		$cmdline .= " --me ".$ime ." " .$fme;		
	}
	if (($ime && !$fme) || (!$ime && $fme)) 
	{
		{$errcnt++; $errlist .= "<strong>Error: either both or neither Mendel values are required. </strong><br />";}
	}
}

if ($sel2=="yes")
{
	if ($chr && !$from && !$to) 
        	{$cmdline .= " --chr " .$chr;}
	elseif ($from && $to && !$chr)
	{
		$cmdline .= " --from " .$from;
		$cmdline .= " --to " .$to;
	}
	elseif ($chr && ($from || $to)) 
		{$errcnt++; $errlist .= "<strong>Error: too many location files. </strong><br />";}
}

// --- End Sel Global Variable Section ------------------------------------------------


// --- Cleanup and form redirection -----------------------------------------


// Errchecked means "came from build_command.  We need to set this so pom2 won't look
// for new m and p values 
$_SESSION['errchecked']='yes'; 
$_SESSION['errcnt'] = $errcnt;
$_SESSION['errlist'] = $errlist;
$_SESSION['cmdline']= $cmdline;

// CODE FOR DEBUGGING:
foreach($_SESSION as $variable => $value) {
	$varlist .= "Variable Name: " . $variable . " Value: $value<br>";
}


if ($errcnt > 0) {
  echo "<meta http-equiv='refresh' content='0;URL=pom2.php'>";
} else {
  echo "<meta http-equiv='refresh' content='0;URL=pom3.php'>";
}

// --- End cleanup and form redirection -------------------------------------
?>


</head>

<body>
<!-- This page checks the form on pom2, and should never display 
for more than a second. -->
<?php
// CODE FOR DEBUGGING:
//echo "There are $errcnt errors";
//echo "Variable list: <br />";
//echo $varlist;
?>
</body>
</html>



