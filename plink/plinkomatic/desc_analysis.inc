<?php 

echo "<h1>The analysis you requested was...</h1>";

	if ($m=="recode")
	{
		echo "Data management<br />";
		echo "Create new PED/MAP fileset (reordered)<br />";
		echo "Preserve original allele coding<br />";
	}

	if ($m=="recode12")
	{
		echo "Data management<br />";
		echo "Create new PED/MAP fileset (reordered)<br />";
		echo "Recode genotypes 11, 12 and 22 (00 missing)<br />";
	}

	if ($m=="makebed")
	{
		echo "Data management<br />";
		echo "Create a binary bED fileset<br />";
	}

	if ($m=="merge")
	{
		echo "Data management<br />";
		echo "Merge two PED files<br />";
	}

	if ($m=="extract")
	{
		echo "Data management<br />";
		echo "Extract a subset of SNPs<br />";
	}

	if ($m=="exclude")
	{
		echo "Data management<br />";
		echo "Exclude a subset of SNPs<br />";
	}

	if ($m=="keep")
	{
		echo "Data management<br />";
		echo "Extract a subset of individuals<br />"; 
	}

	if ($m=="remove")
	{
		echo "Data management<br />";
		echo "Exclude of subset of individuals<br />"; 

	}

	if ($m=="flip")
	{
		echo "Data management<br />";
		echo "Flip SNP strand<br />";
	}


	if ($m=="merge" || $m=="extract" || $m=="exclude" || $m=="keep" || $m=="remove" || $m=="flip")
	{
		if ($p==1) {echo "Output standard PED/MAP fileset<br />";}
		elseif ($p==2) {echo "Output a binary bED fileset<br />";}
	}


?>