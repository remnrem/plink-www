<?php 

$input = "";
$warning = "";
$output = "";


// ___ Data Management____________________________________________________________ 
	if ($m=="recode")
	{

		$input .= "Data management<br />";
		$input .= "-->Create new PED/MAP fileset (reordered)<br />";
		$input .= "----><a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml#recode>Preserve original allele coding</a><br />";
		$warning .= "";
		$output .= "<tr><td>" .$out."-recode.ped </td>";
		$output .= "<td>Recoded PED file</td></tr>";
		$output .= "<tr><td>".$out."-recode.map</td>";
		$output .= "<td>Recoded MAP file</td></tr>";

	}

	if ($m=="recode12")
	{
		$input .= "Data management<br />";
		$input .= "-->Create new PED/MAP fileset (reordered)<br />";
		$input .= "----><a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml#recode>Recode genotypes 11, 12 and 22 (00 missing)</a><br />";
		$output .= "<tr><td>" .$out."-recode.ped </td>";
		$output .= "<td>Recoded PED file</td></tr>";
		$output .= "<tr><td>" .$out."-recode.map </td>";
		$output .= "<td>Recoded MAP file</td></tr>";
	}

	if ($m=="recodeAD")
	{
		$input .= "Data management<br />";
		$input .= "-->Create new PED/MAP fileset (reordered)<br />";
		$input .= "----><a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml#recode>Recode genotypes as additive and dominant components</a><br />";
		$output .= "<tr><td>" .$out."-recode.raw </td>";
		$output .= "<td>Recoded raw data file</td></tr>";
	}

	if ($m=="makebed")
	{
		$input .= "Data management<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml#makebed>Create a binary bED fileset</a><br />";
		$output .= "<tr><td>" .$out.".bed </td>";
		$output .= "<td> Binary PED file</td></tr>";
		$output .= "<tr><td>" .$out.".bim </td>";
		$output .= "<td> Binary MAP file</td></tr>";
		$output .= "<tr><td>" .$out.".fam </td>";
		$output .= "<td> Binary FAM file</td></tr>";
	}

	if ($m=="merge" || $m=="mmerge")
	{
		$input .= "Data management<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml#merge>Merge two PED files</a><br />";
		if ($m=="mmerge" || ($mmode>=1 && $mmode<=5))
		{
			if ($p==1)
			{
				$output .= "<tr><td>" .$out."-recode.ped </td>";
				$output .= "<td>Recoded PED file</td></tr>";
				$output .= "<tr><td>".$out."-recode.map</td>";
				$output .= "<td>Recoded MAP file</td></tr>";
			}
			elseif ($p==2)
			{
				$output .= "<tr><td>" .$out.".bed </td>";
				$output .= "<td> Binary PED file</td></tr>";
				$output .= "<tr><td>" .$out.".bim </td>";
				$output .= "<td> Binary MAP file</td></tr>";
				$output .= "<tr><td>" .$out.".fam </td>";
				$output .= "<td> Binary FAM file</td></tr>";			
			}
		}
		elseif ($mmode==6 || $mmode==7) 
		{
			$output .= "<tr><td>" .$out.".diff </td>";
			$output .= "<td>Difference file</td></tr>";
		}
	}

	if ($m=="extract")
	{
		$input .= "Data management<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml#extract>Extract a subset of SNPs</a><br />";
	}

	if ($m=="exclude")
	{
		$input .= "Data management<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml#exclude>Exclude a subset of SNPs</a><br />";
	}

	if ($m=="keep")
	{
		$input .= "Data management<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml#keep>Extract a subset of individuals</a><br />"; 
	}

	if ($m=="remove")
	{
		$input .= "Data management<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml#remove>Exclude of subset of individuals</a><br />"; 

	}

	if ($m=="flip")
	{
		$input .= "Data management<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/dataman.shtml#flip>Flip SNP strand</a><br />";
	}


	if ($m=="extract" || $m=="exclude" || $m=="keep" || $m=="remove" || $m=="flip")
	{
		if ($p==1) 
		{
			$input .= "---->Output standard PED/MAP fileset<br />";
			$output .= "<tr><td>" .$out."-recode.ped </td>";
			$output .= "<td>Recoded PED file</td></tr>";
			$output .= "<tr><td>" .$out."-recode.map </td>";
			$output .= "<td>Recoded MAP file</td></tr>";
		}
		elseif ($p==2) 
		{
			$input .= "---->Output a binary bED fileset<br />";
			$output .= "<tr><td>" .$out.".bed </td>";
			$output .= "<td>Binary PED file</td></tr>";
			$output .= "<tr><td>" .$out.".bim </td>";
			$output .= "<td>Binary MAP file</td></tr>";
			$output .= "<tr><td>" .$out.".fam </td>";
			$output .= "<td>Binary FAM file</td></tr>";		
		}
	}
//_____End Data Management______________________________________________________________ 


//_____Summary Statistics_______________________________________________________________

	if ($m=="missing")
	{
	 	$input .= "Summary statistics<br />";
	 	$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/summary.shtml#missing>Missingness rates</a><br />";
	 	$input .= "---->SNP and individual missing rates<br />";
	 	$output .= "<tr><td>" .$out.".imiss </td>";
		$output .= "<td>Missing rates, per individual</td></tr>";
		$output .= "<tr><td>" .$out.".lmiss </td>";
		$output .= "<td>Missing rates, per locus</td></tr>";
	}

	if ($m=="test-missing")
	{
	 	$input .= "Summary statistics<br />";
	 	$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/summary.shtml#missing>Missingness rates</a><br />";
	 	$input .= "---->Test for different rates between cases and controls<br />";
		$output .= "<tr><td>" .$out.".missing </td>";
		$output .= "<td>Test of differences in C/C missing rates</td></tr>";
	}

	if ($m=="freq")
	{
	 	$input .= "Summary statistics<br />";
	 	$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/summary.shtml#freq>Allele frequencies</a><br />"; 
		$output .= "<tr><td>" .$out.".frq </td>";
		$output .= "<td>Allele frequency table</td></tr>";
	}

	if ($m=="hardy")
	{
	 	$input .= "Summary statistics<br />";
	 	$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/summary.shtml#hwd>Hardy-Weinberg equilibrium tests</a><br />";
	 	$output .= "<tr><td>" .$out.".hwe </td>";
	 	$output .= "<td>Hardy-Weinberg test statistics</td></tr>";
	 	
	 	if ($p==1) {$input .= "---->Ignore phenotype<br />"; }
	 	elseif ($p==2) {$input .= "---->Stratify by case/control statues<br />";}  
	}

	if ($m=="mendel")
	{
	 	$input .= "Summary statistics<br />";
	 	$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/summary.shtml#mendel>Mendel error rates for nuclear family data</a><br />";    
		$output .= "<tr><td>" .$out.".mendel </td>";
		$output .= "<td>Mendel errors, per error</td></tr>";
		$output .= "<tr><td>" .$out.".imendel </td>";
		$output .= "<td>Mendel errors, per individual</td></tr>";
		$output .= "<tr><td>" .$out.".fmendel </td>";
		$output .= "<td>Mendel errors, per family</td></tr>";	
		$output .= "<tr><td>" .$out.".lmendel </td>";
		$output .= "<td>Mendel errors, per locus</td></tr>";	
	}
//_____End Summary Statistics___________________________________________________________


//_____Population Stratification________________________________________________________


	if ($m=="cluster" && $p==1)
	{
		$input .= "Population stratification and matching<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/strat.shtml>IBS distance-based clustering</a><br />";
		$input .= "---->Cluster on genome-wide IBS<br />";   
		$output .= "<tr><td>".$out.".cluster0</td>";
		$output .= "<td>Progress of IBS clustering</td></tr>";
		$output .= "<tr><td>".$out.".cluster1</td>";
		$output .= "<td>IBS cluster solution, format 1</td></tr>";
		$output .= "<tr><td>".$out.".cluster2</td>";
		$output .= "<td>IBS cluster solution, format 2</td></tr>";
		$output .= "<tr><td>".$out.".cluster3</td>";
		$output .= "<td>IBS cluster solution, format 3</td></tr>";								
	}
	
	if ($m=="cluster" && $p==2)
	{
		$input .= "Population stratification and matching<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/strat.shtml>IBS distance-based clustering</a><br />";
		$input .= "---->Cluster on genome-wide IBS and external matching criteria<br />"; 
		$output .= "<tr><td>".$out.".cluster0</td>";
		$output .= "<td>Progress of IBS clustering</td></tr>";
		$output .= "<tr><td>".$out.".cluster1</td>";
		$output .= "<td>IBS cluster solution, format 1</td></tr>";
		$output .= "<tr><td>".$out.".cluster2</td>";
		$output .= "<td>IBS cluster solution, format 2</td></tr>";
		$output .= "<tr><td>".$out.".cluster3</td>";
		$output .= "<td>IBS cluster solution, format 3</td></tr>";	
	}
	
	if ($m=="cluster" && $matrix)
	{
		$output .= "<tr><td>".$out.".mdist</td>";
		$output .= "<td>IBS distance matrix</td></tr>";
	}

	if ($m=="genome")
	{
		$input .= "Population stratification and matching<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/ibdibs.shtml#genome>IBD estimation (genome-wide)</a><br />";    
		$output .= "<tr><td>" .$out.".genome </td>";
		$output .= "<td>Genome-wide IBD/IBS pairwise measures</td></tr>";
	}
	
	if ($m=="inbreeding")
	{     
		$input .= "Population stratification and matching<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/ibdibs.shtml#genome>Heterozygosity / inbreeding coefficients</a><br />";   
		$output .= "<tr><td>" .$out.".het </td>";
		$output .= "<td>Individual inbreeding coefficients</td></tr>";
	}
	
	if ($m=="homo-run-snps")
	{
		$input .= "Population stratification and matching<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/ibdibs.shtml#genome>Runs of homozygosity</a><br />";   
		$output .= "<tr><td>" .$out.".hom </td>";
		$output .= "<td>Runs of homozygosity</td></tr>";
 	}
//_____End Population Stratification____________________________________________________


//_____Linkage Disequilibrium___________________________________________________________

	if ($m=="ld-r")
	{
		$input .= "Linkage disequilibrium and haplotype inference<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/misc.shtml#ld>Pairwise r and r-squared</a><br />";
		if ($ld==1)
		{
			$output .= "<tr><td>" .$out.".ld </td>";
			$output .= "<td>Pairwise LD (genotype correlation)</td></tr>";
		}
		elseif ($ld==2)
		{
			$output .= "<tr><td>" .$out.".ld </td>";
			$output .= "<td>Pairwise LD (squared genotype correlation)</td></tr>";			
		}	
	}
	
	if ($m=="hap"  && $p==1)
	{
		$input .= "Linkage disequilibrium and haplotype inference<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/haplo.shtml>haplotype inference</a><br />";
		$input .= "---->Calculate haplotype frequencies<br />";
		$output .= "<tr><td>" .$out.".freq.hap </td>";
		$output .= "<td>Haplotype frequencies (and C/C test)</td></tr>";			
	}

	if ($m=="hap"  && $p==2)
	{
		$input .= "Linkage disequilibrium and haplotype inference<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/haplo.shtml>haplotype inference</a><br />";
		$input .= "---->List individuals' haplotype phases<br />";	
		$output .= "<tr><td>" .$out.".phase-* </td>";
		$output .= "<td>Haplotype phases (one file per locus)</td></tr>";		
	}
	
	if ($m=="hap"  && $p==3)
	{
		$input .= "Linkage disequilibrium and haplotype inference<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/haplo.shtml>haplotype inference</a><br />";
		$input .= "---->Test case/control haplotype association<br />";
		$output .= "<tr><td>" .$out.".assoc.hap </td>";
		$output .= "<td>Haplotype frequencies (and C/C test)</td></tr>";		
	}

	if ($m=="hap"  && $p==4)
	{
		$input .= "Linkage disequilibrium and haplotype inference<br />";
		$input .= "--><a href=http://pngu.mgh.harvard.edu/~purcell/plink/haplo.shtml>haplotype inference</a><br />";
		$input .= "---->Create imputed most-likely haplotype dataset<br />";
		$output .= "<tr><td>" .$out."-impute.ped </td>";
		$output .= "<td>PED file of imputed SNPs</td></tr>";		
		$output .= "<tr><td>" .$out."-impute.map </td>";
		$output .= "<td>MAP file of imputed SNPs</td></tr>";		
	}
//_____End Linkage Disequilibrium_______________________________________________________

//_____Association Analysis_____________________________________________________________


	if ($m=="assoc")
	{
		$input .="Association analysis<br />";
		$input .="-->Single SNP analyses<br />";
		$input .="---->Population based sample<br />"; 
		$input .="------>Disease trait<br />";
		$input .="--------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/anal.shtml#cc>Basic allelic test</a><br />"; 
		if ($p==1) 
		{
			$input .="---------->Without permutation<br />";
			$output .= "<tr><td>" .$out.".assoc </td>";
			$output .= "<td>Association results</td></tr>";
		}
		elseif ($p==2) 
		{
			$input .="----------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/perm.shtml#aperm>With adaptive permutation</a><br />";
			$output .= "<tr><td>" .$out.".assoc.perm </td>";
			$output .= "<td>Adaptive permutation empirical p-values</td></tr>";	
		}
		elseif ($p==3) 
		{
			$input .="----------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/perm.shtml#mperm>With maxT permutation</a><br />";
			$output .= "<tr><td>" .$out.".assoc.mperm </td>";
			$output .= "<td> maxT permutation empirical p-values</td></tr>";		
		}
	}

   if ($m=="model")
   {
   	$input .="Association analysis<br />";
		$input .="-->Single SNP analyses<br />";
		$input .="---->Population based sample<br />"; 
		$input .="------>Disease trait<br />";
		$input .="--------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/anal.shtml#model>Cochran-Armitage trend test and genotypic test</a><br />";
		if ($p==1) 
		{
			$input .="---------->Without permutation<br />";
			$output .= "<tr><td>" .$out.".model </td>";
			$output .= "<td> Full-model association results</td></tr>";	
		}
		elseif ($p==2) 
		{
			$input .="----------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/perm.shtml#aperm>With adaptive permutation</a><br />";
			$output .= "<tr><td>" .$out.".model </td>";
			$output .= "<td>Full-model association results</td></tr>";
			$output .= "<tr><td>" .$out.".model.perm </td>";
			$output .= "<td>Empirical significance values</td></tr>";
		}
		elseif ($p==3) 
		{
			$input .="----------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/perm.shtml#mperm>With maxT permutation</a><br />";
			$output .= "<tr><td>" .$out.".model </td>";
			$output .= "<td>Full-model association results</td></tr>";
			$output .= "<tr><td>" .$out.".model.mperm </td>";
			$output .= "<td>Empirical significance values</td></tr>";
		}
   }
         

	if ($m=="within-file")
	{
		$input .="Association analysis<br />";
		$input .="-->Single SNP analyses<br />";
		$input .="---->Population based sample<br />"; 
		$input .="------>Disease trait<br />";
		$input .="--------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/anal.shtml#strat>Stratified/clustered sample tests</a><br />";
		$input .="---------->Within-cluster permutation<br />";
		if ($p==2) 
		{
			$input .="--------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/perm.shtml#aperm>With adaptive permutation</a><br />";
			$output .= "<tr><td>" .$out.".assoc </td>";
			$output .= "<td>Association results</td></tr>"; 	
			$output .= "<tr><td>" .$out.".assoc.perm </td>";
			$output .= "<td>Adaptive permutation empirical p-values</td></tr>";  
		}
		elseif ($p==3) 
		{
			$input .="--------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/perm.shtml#mperm>With maxT permutation</a><br />";
			$output .= "<tr><td>" .$out.".assoc </td>";
			$output .= "<td>Association results</td></tr>"; 	
			$output .= "<tr><td>" .$out.".assoc.mperm </td>";
			$output .= "<td>max(T) permutation empirical p-values</td></tr>";  
		}
    }

	if ($m=="mh")
	{    
    	$input .="Association analysis<br />";
		$input .="-->Single SNP analyses<br />";
		$input .="---->Population based sample<br />"; 
		$input .="------>Disease trait<br />";
		$input .="--------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/anal.shtml#strat>Stratified/clustered sample tests</a><br />";  
		$input .="---------->Cochran-Mantel-Haenszel tests<br />";
		$input .="------------>SNP-disease association conditional on cluster<br />";  
		$output .= "<tr><td>" .$out.".cmh </td>";
		$output .= "<td>Cochran-Mantel-Haenszel test 1</td></tr>";
	}      
		
	if ($m=="mh2")
	{			
		$input .="Association analysis<br />";
		$input .="-->Single SNP analyses<br />";
		$input .="---->Population based sample<br />"; 
		$input .="------>Disease trait<br />";
		$input .="--------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/anal.shtml#strat>Stratified/clustered sample tests</a><br />";  
		$input .="---------->Cochran-Mantel-Haenszel tests<br />";
		$input .="------------>SNP-cluster association conditional on disease<br />"; 
		$output .= "<tr><td>" .$out.".cmh2 </td>";
		$output .= "<td>Cochran-Mantel-Haenszel test 2</td></tr>";
	}  

	if ($m=="homog")
	{    
    	$input .="Association analysis<br />";
		$input .="-->Single SNP analyses<br />";
		$input .="---->Population based sample<br />"; 
		$input .="------>Disease trait<br />";
		$input .="--------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/anal.shtml#strat>Stratified/clustered sample tests</a><br />";  
		$input .="---------->Homogeneity of odds ratio tests<br />";   
		$output .= "<tr><td>" .$out.".homog </td>";
		$output .= "<td>Between strata homogeneity test</td></tr>";
   }
   
   if ($m=="t2")
   {
    	$input .="Association analysis<br />";
		$input .="-->Single SNP analyses<br />";
		$input .="---->Population based sample<br />"; 
		$input .="------>Disease trait<br />";
		$input .="-------->Set based test<br />";
		$input .="----------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/anal.shtml#hotel>Hotelling's T2 multilocus test</a><br />";  	
		if ($p==1) 
		{
			$input .="------------>Without permutation<br />";
			$output .= "<tr><td>" .$out.".T2 </td>";
			$output .= "<td>Hotelling's T(2) test results</td></tr>";	
		}
		elseif ($p==2) 
		{
			$input .="------------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/perm.shtml#aperm>With adaptive permutation</a><br />";
			$output .= "<tr><td>" .$out.".T2 </td>";
			$output .= "<td>Hotelling's T(2) test results</td></tr>";
			$output .= "<tr><td>" .$out.".T2.perm </td>";
			$output .= "<td>Empirical significance values</td></tr>";
		}
		elseif ($p==3) 
		{
			$input .="------------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/perm.shtml#mperm>With maxT permutation</a><br />";
			$output .= "<tr><td>" .$out.".T2 </td>";
			$output .= "<td>Hotelling's T(2) test results</td></tr>";
			$output .= "<tr><td>" .$out.".T2.mperm </td>";
			$output .= "<td>Empirical significance values</td></tr>";
		}

   }

	if ($m=="sumstat")
	{
		$input .="Association analysis<br />";
                $input .="-->Single SNP analyses<br />";
                $input .="---->Population based sample<br />";
                $input .="------>Disease trait<br />";
                $input .="-------->Set based test<br />";
                $input .="---------->Sum-statistics gene-based test<br 
/>";
           	$output .= "<tr><td>" .$out.".assoc.set</td>";
		$output .= "<td>Sum-statistics set-based tests</td></tr>";

	}


	if ($m=="qt")
	{
		$input .="Association analysis<br />";
		$input .="-->Single SNP analyses<br />";
		$input .="---->Population based sample<br />";
		$input .="------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/anal.shtml#qt>Quantitative trait</a><br />"; 
		if ($p==1) 
		{ 
			$input .="-------->Without permutation<br />";
			$output .= "<tr><td>" .$out.".qassoc </td>";
			$output .= "<td>Quantitative trait association results</td></tr>"; 
			$output .= "<tr><td>" .$out.".assoc </td>";
			$output .= "<td>Association results</td></tr>";			
		}
		elseif ($p==2) 
		{ 
			$input .="-------->With adaptive permutation<br />";
			$output .= "<tr><td>" .$out.".qassoc </td>";
			$output .= "<td>Quantitative trait association results</td></tr>"; 
			$output .= "<tr><td>" .$out.".assoc </td>";
			$output .= "<td>Association results</td></tr>";	
			$output .= "<tr><td>" .$out.".assoc.perm </td>";
			$output .= "<td>Adaptive permutation empirical p-values</td></tr>";			 
		}
		elseif ($p==3) 
		{ 
			$input .="-------->With maxT permutation<br />";
			$output .= "<tr><td>" .$out.".qassoc </td>";
			$output .= "<td>Quantitative trait association results</td></tr>"; 
			$output .= "<tr><td>" .$out.".assoc </td>";
			$output .= "<td>Association results</td></tr>";	
			$output .= "<tr><td>" .$out.".assoc.mperm </td>";
			$output .= "<td>max(T) permutation empirical p-values</td></tr>";			 
		} 
   } 


	if ($m=="qt-within-file")
	{  
		$input .="Association analysis<br />";
		$input .="-->Single SNP analyses<br />";
		$input .="---->Population based sample<br />";	  
		$input .="------>Within-cluster permutation<br />";
		if ($p==2) 
		{
			$input .="--------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/perm.shtml#aperm>With adaptive permutation</a><br />";
			$output .= "<tr><td>" .$out.".qassoc </td>";
			$output .= "<td>Quantitative trait association results</td></tr>"; 
			$output .= "<tr><td>" .$out.".assoc </td>";
			$output .= "<td>Association results</td></tr>";	
			$output .= "<tr><td>" .$out.".assoc.perm </td>";
			$output .= "<td>Adaptive permutation empirical p-values</td></tr>";	
		}
		elseif ($p==3) 
		{
			$input .="--------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/perm.shtml#mperm>With maxT permutation</a><br />";
			$output .= "<tr><td>" .$out.".qassoc </td>";
			$output .= "<td>Quantitative trait association results</td></tr>"; 
			$output .= "<tr><td>" .$out.".assoc </td>";
			$output .= "<td>Association results</td></tr>";	
			$output .= "<tr><td>" .$out.".assoc.mperm </td>";
			$output .= "<td>max(T) permutation empirical p-values</td></tr>";	
		}
	}


	if ($m=="gxe")
	{  
		$input .="Association analysis<br />";
		$input .="-->Single SNP analyses<br />";
		$input .="---->Population based sample<br />";	  
		$input .="------>Quantitative trait GxE analysis<br />";
		$output .= "<tr><td>" .$out.".qassoc.gxe </td>";
		$output .= "<td>Quantitative GxE results</td></tr>"; 
	}



// --- Association Analysis/Single SNP analyses/Family-based Sample -----------------

	if ($m=="tdt")
	{
		$input .= "Association analysis<br />";
		$input .= "-->Single SNP analyses<br />";
		$input .= "---->Family-based sample<br />";    
		$input .= "------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/anal.shtml#tdt>Disease traits: TDT analysis</a><br />"; 
		$output .= "<tr><td>" .$out.".tdt </td>";
		$output .= "<td>TDT/parenTDT asymptotic results</td></tr>";
		if ($p==2)
		{
		$output .= "<tr><td>" .$out.".tdt.perm </td>";
		$output .= "<td>TDT/parenTDT adaptive permutaion results</td></tr>";
		}

		if ($p==3)
		{
		$output .= "<tr><td>" .$out.".tdt.mperm </td>";
		$output .= "<td>TDT/parenTDT maxT permutaion results</td></tr>";
		}

		if ($set=="no") {	$input .= "-------->Single SNP TDT only<br />";}
		elseif ($set=="true") {	$input .= "-------->Single SNP and set-based TDT<br />";}
	}  
	
	if ($m=="qtdt")
	{
		$input .= "Association analysis<br />";
		$input .= "-->Single SNP analyses<br />";
		$input .= "---->Family-based sample<br />";
		$input .= "------><a href=http://pngu.mgh.harvard.edu/~purcell/plink/perm.shtml#genedropmodel>Quantitative trait: gene-dropping permutation</a><br />"; 
		$output .= "<tr><td>" .$out."[[]]</td>";
		$output .= "<td></td></tr>";

		if ($p==1) {$input .= "-------->Gene-drop from founders<br />";}
		if ($p==2) {$input .= "-------->Gene-drop from parents<br />";}
		
	} 
	
   
// ----- Epistatic Analysis -------------------------------------------------

	if ($m=="epi")
	{
		$input .= "Association analysis<br />";
		$input .= "-->Epistatic analyses<br />";
		$input .= "----><a href=http://pngu.mgh.harvard.edu/~purcell/plink/epi.shtml#snp>SNP x SNP epistasis</a><br />";
		if ($p==1) 
		{ 
			$output .= "<tr><td>" .$out.".epi-co1 </td>";
			$output .= "<td>Epistasis: case-only pairwise results</td></tr>";
			$output .= "<tr><td>" .$out.".epi-co2 </td>";
			$output .= "<td>Epistasis: case-only summary results</td></tr>";
		}
		elseif ($p==2)
		{
			$output .= "<tr><td>" .$out.".epi-cc1 </td>";
			$output .= "<td>Epistasis: case/control pairwise results</td></tr>";
			$output .= "<tr><td>" .$out.".epi-cc2 </td>";
			$output .= "<td>Epistasis: case/control summary results</td></tr>";
		}
	}

   if ($m=="genepi")
   {
   	$input .= "Association analysis<br />";
		$input .= "-->Epistatic analyses<br />";
		$input .= "----><a href=http://pngu.mgh.harvard.edu/~purcell/plink/epi.shtml#gene>Gene-based epistasis</a><br />";
		$output .= "<tr><td>" .$out.".genepi.dat </td>";
		$output .= "<td></td></tr>";
		$output .= "<tr><td>" .$out.".genepi.R </td>";
		$output .= "<td></td></tr>";
	}	
   
 	if ($m=="epi" || $m=="genepi")
 	{
 		if ($p==1) {$input .= "------>Case-only analysis<br />";}
 		elseif ($p==2) {$input .= "------>Case/control analysis<br />";}
 	}



//_____End Association Analysis_________________________________________________________


?>
