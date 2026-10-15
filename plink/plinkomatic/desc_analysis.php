<?php 

// ___ Data Management____________________________________________________________ 
	if ($m=="recode")
	{

		$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml>Data management</a><br />";
		$input .= "-->Create new PED/MAP fileset (reordered)<br />";
		$input .= "---->Preserve original allele coding<br />";
	}

	if ($m=="recode12")
	{
		$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml>Data management</a><br />";
		$input .= "-->Create new PED/MAP fileset (reordered)<br />";
		$input .= "---->Recode genotypes 11, 12 and 22 (00 missing)<br />";
	}

	if ($m=="makebed")
	{
		$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml>Data management</a><br />";
		$input .= "-->Create a binary bED fileset<br />";
	}

	if ($m=="merge")
	{
		$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml>Data management</a><br />";
		$input .= "-->Merge two PED files<br />";
	}

	if ($m=="extract")
	{
		$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml>Data management</a><br />";
		$input .= "-->Extract a subset of SNPs<br />";
	}

	if ($m=="exclude")
	{
		$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml>Data management</a><br />";
		$input .= "-->Exclude a subset of SNPs<br />";
	}

	if ($m=="keep")
	{
		$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml>Data management</a><br />";
		$input .= "-->Extract a subset of individuals<br />"; 
	}

	if ($m=="remove")
	{
		$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml>Data management</a><br />";
		$input .= "-->Exclude of subset of individuals<br />"; 

	}

	if ($m=="flip")
	{
		$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml>Data management</a><br />";
		$input .= "-->Flip SNP strand<br />";
	}


	if ($m=="merge" || $m=="extract" || $m=="exclude" || $m=="keep" || $m=="remove" || $m=="flip")
	{
		if ($p==1) {$input .= "---->Output standard PED/MAP fileset<br />";}
		elseif ($p==2) {$input .= "---->Output a binary bED fileset<br />";}
	}
//_____End Data Management______________________________________________________________ 


//_____Summary Statistics_______________________________________________________________

	if ($m=="missing")
	{
	 	$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/summary.shtml>Summary statistics</a><br />";
	 	$input .= "-->Missingness rates<br />";
	 	$input .= "---->SNP and individual missing rates<br />";
	}

	if ($m=="test-missing")
	{
	 	$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/summary.shtml>Summary statistics</a><br />";
	 	$input .= "-->Missingness rates<br />";
	 	$input .= "---->Test for different rates between cases and controls<br />";
	}

	if ($m=="freq")
	{
	 	$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/summary.shtml>Summary statistics</a><br />";
	 	$input .= "-->Allele frequencies<br />"; 
	}

	if ($m=="hardy" && $p==1)
	{
	 	$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/summary.shtml>Summary statistics</a><br />";
	 	$input .= "-->Hardy-Weinberg equilibrium tests<br />";
	 	$input .= "---->Ignore phenotype<br />";   
	}

	if ($m=="hardy" && $p==2)
	{
	 	$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/summary.shtml>Summary statistics</a><br />";
	 	$input .= "-->Hardy-Weinberg equilibrium tests<br />";
	 	$input .= "---->Stratify by case/control statues<br />";  
	}

	if ($m=="mendel")
	{
	 	$input .= "<a href=http://pngu.mgh.harvard.edu/~purcell/plink/summary.shtml>Summary statistics</a><br />";
	 	$input .= "-->Mendel error rates for nuclear family data<br />";    
	}
//_____End Summary Statistics___________________________________________________________


//_____Population Stratification________________________________________________________


	if ($m=="cluster" && $p==1)
	{
		$input .= "Population stratification and matching";
		$input .= "IBS distance-based clustering";
		$input .= "Cluster on genome-wide IBS";   
	}
	
	if ($m=="cluster" && $p==2)
	{
		$input .= "Population stratification and matching";
		$input .= "IBS distance-based clustering";
		$input .= "Cluster on genome-wide IBS and external matching criteria"; 
	}

	if ($m=="genome")
	{
		$input .= "Population stratification and matching";
		$input .= "IBD estimation (genome-wide)";    
	}
	
	if ($m=="inbreeding")
	{     
		$input .= "Population stratification and matching";
		$input .= "Heterozygosity / inbreeding coefficients";   
	}
	
	if ($m=="homo-run-snps")
	{
		$input .= "Population stratification and matching";
		$input .= "Runs of homozygosity";   
 	}
 	

//_____End Popluation Stratification____________________________________________________


?>