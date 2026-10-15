
##################################
## Download datasets

rsync -avze ssh shaun@silver.broad.mit.edu:/fg/wgas3/projects/bipolar/bipolar_freeze_120506/bipolar_freeze_120706_Nsp.ped . 
rsync -avze ssh shaun@silver.broad.mit.edu:/fg/wgas3/projects/bipolar/bipolar_freeze_120506/bipolar_freeze_120706_Sty.ped . 

rsync -avze ssh shaun@silver.broad.mit.edu:/fg/wgas/affy/Nsp250.map .
rsync -avze ssh shaun@silver.broad.mit.edu:/fg/wgas/affy/Sty250.map .


##################################
## Edit MAP files to reflect PARs

perl edit-map-par.pl Nsp250.map < par.nsp > nsp.map
perl edit-map-par.pl Sty250.map < par.sty > sty.map


##################################
## Create main genotype data files

plink --ped bipolar_freeze_120706_Nsp.ped \
      --map nsp.map \
      --make-bed \
      --out nsp0

plink --ped bipolar_freeze_120706_Sty.ped \
      --map sty.map \
      --make-bed \
      --out sty0


##################################
## Merge Nsp and Sty

plink --bfile nsp0 \
      --bmerge sty0.bed sty0.bim sty0.fam \
      --make-bed \
      --out bp0

######################################
## Merge in final remaining individual

rsync -avze ssh shaun@silver.broad.mit.edu:/fg/wgas3/projects/bipolar/bipolar_freeze_120506/new_indiv_Nsp.ped .
rsync -avze ssh shaun@silver.broad.mit.edu:/fg/wgas3/projects/bipolar/bipolar_freeze_120506/new_indiv_Sty.ped .

plink --ped new_indiv_Nsp.ped \
      --map nsp.map \
      --merge new_indiv_Sty.ped sty.map \
      --make-bed \
      --out new_indiv

# This person already exists, previous genotyping was bad, so use "Always overwrite" mode (5)

plink --bfile bp0 \
      --bmerge new_indiv.bed new_indiv.bim new_indiv.fam \
      --merge-mode 5 \
      --make-bed \
      --out bp1


##################################
## Thresholds

# 1) Exclude HapMap control sample, or if excluded from study
# 2) Separate out Bipolar 2 diagnosis, MDD diagnosis
# 3) Exclude bad Affy SNPs w/ multiple hits, monomorphic SNPs 
#    and SNPs with < 90% genotyping rate
# 4) Sex check
# 5) Per-individual heterozygosity
# 6) Individuals with call rate < 95%
# 7) Close relatives, duplications
# 8) Population stratification outliers
# 9) Known non-Caucasians; make homogeneous group
# 10) Genome-wide IBD calculations
# 11) Contamination (too much low-level relatedness)
# 12) Exclude SNPs with genotyping rate < 95%
# 13) Exclude SNPs with HWD failure p < 1e-6
# 14) Exclude SNPs with MAF < 0.01
# 15) Exclude SNPs with CHI-MISSING p < 1e-3
# 16) Exclude SNPs with MISHAP p < 1e-10
# 17) Exclude SNPs with PLATE-ASSOCIATION p < 1e-10 for at least one plate 
# 18) Perform final cluster solution(s)
# 19) Split to STEP and UK datasets


############################################################################
# 1) Exclude HapMap control sample, or if excluded from study
# 2) Separate out Bipolar 2 diagnosis, MDD diagnosis
# 3) Exclude bad Affy SNPs w/ multiple hits, monomorphic SNPs 
#    and SNPs with < 90% genotyping rate

# HapMap control:     remove.hapmap           N=1
# Exclusions:         remove.exclusion        N=2
# MDD:                remove.mdd              N=103
# BP2:                remove.bp2              N=63

# Sub-total (unique)  remove.invalid          N=158

cat remove.hapmap remove.exclusion remove.mdd remove.bp2 | sort | uniq > remove.invalid


# Monomophic SNPs                             N=157
# Genotyping rate < 90% SNPs                  N=6530
# SNPs hitting multiple places in the genome: N=3605

rsync -avze ssh shaun@silver.broad.mit.edu:/fg/wgas/affy/affy_multiple_hits.rs.txt remove.mult.hit.snps

plink --bfile bp1 \
      --remove remove.invalid \
      --exclude remove.mult.hit.snps \
      --maf 1e-50 \
      --geno 0.1 \
      --make-bed \
      --out bp2

# Summary:
# SNPs:    500568 -> 490276
# Indiv:   4139   -> 3981


############################################################################
# 4) Sex check

# Perform separately for Nsp and Sty also.

plink --bfile nsp0 \
      --check-sex \
      --out nsp0.sexcheck

plink --bfile sty0 \
      --check-sex \
      --out sty0.sexcheck

# Individual with discordant sex between chips?

paste nsp0.sexcheck.sexcheck sty0.sexcheck.sexcheck | gawk ' $4 != $10 { print $1,$2 } ' > remove.bad.sex
gawk ' $4 == 0 { print $1,$2 } ' nsp0.sexcheck.sexcheck sty0.sexcheck.sexcheck >> remove.bad.sex
sort remove.bad.sex | uniq > tmpfile
mv tmpfile remove.bad.sex

# 11 individuals overall (some already removed, i.e. first sex-check based on
# early Nsp and Sty files)

# We are ignoring the fact that some individuals have discrepancies between 
# sex based on genetics and reported sex -- assuming this is just error and 
# seems to be contained within cases or within controls (i.e. very unlikely to
# reflect sample swaps between cases and controls).  Therefore just impute correct
# sex

plink --bfile bp2 \
      --remove remove.bad.sex \
      --impute-sex \
      --make-bed \
      --out bp3

# Summary:
# SNPs:    490276  -> 490276
# Indiv:     3981  ->   3971


############################################################################
# 5) Per-individual heterozygosity
# 6) Individuals with call rate < 95%

plink --bfile bp3 \
      --het \
      --out bp3.hetero

gawk ' NR>1 && ( $6 < -0.05 || $6 > 0.05 ) { print $1, $2 } ' bp3.hetero.het > remove.hetero

plink --bfile bp3 \
      --remove remove.hetero \
      --mind 0.05 \
      --make-bed \
      --out bp4

# Removed based on heterozygosity: N = 75
# Removed based on genotyping rate: N = 0

# Summary:
# SNPs:    490276  -> 490276
# Indiv:     3971  ->   3896


############################################################################
# 7) Close relatives, duplications
# 8) Population stratification outliers
# 9) Known non-Caucasians

# ( create genome file on Broad cluster -- "bp4.genome.genome" copied back here )

gawk ' $8 > 0.2 ' bp4.genome.genome 

# summary of results of this are in files "close.relatives"
# and the individuals to remove based on this are in "remove.related" (N=30)


plink --bfile bp4 \
      --read-genome bp4.genome.genome \
      --cluster \
      --mds-plot 10 \
      --ppc 1e-3 \
      --cc \
      --neighbour 1 5 \
      --out bp4.cluster

# (ignore cluster solution -- phenotype is missing in this analysis)

# N=118 outliers (both too far from another individual and too near)
gawk ' NR>1 && ( $5 < -3 || $5 > 3 ) { print $1,$2 } ' bp4.cluster.nearest > remove.outliers

# Outliers: N = 118
# Related/duplicated: N = 30
# Non-caucasian: N = 29 additional individuals
# Total: 152 individuals removed here

cat remove.outliers remove.related | sort | uniq > remove.ibs

plink --bfile bp4 \
      --remove remove.ibs \
      --keep caucasian.list \
      --make-bed \
      --out bp5 

# Summary:
# SNPs:    490276  -> 490276
# Indiv:     3896  ->   3744


############################################################################
# 10) Repeat IBS/IBD calculations after having removed gross outliers

# Take a subset of markers for this next IBS/IBD analysis

plink --bfile bp5 \
      --indep-pairwise 100 50 0.5 \
      --out bp5.pruning

plink --bfile bp5 \
      --extract bp5.pruning.prune.in \
      --geno 0 \
      --make-bed \
      --out bp5.pruned

# ( create genome file on Broad cluster -- "bp5.genome.genome" copied back here )

plink --bfile bp5 \
      --read-genome bp5.genome.genome \
      --cluster \
      --mds-plot 10 \
      --out bp5.cluster.all

# Looking at plots from 
#   bp5.cluster.all.mds
#   bp5.cluster.all.cluster3 

# Biggest cluster is : 

# table( d[,3739] ) 

#    0    1    2    3    4    5    6    7 
# 3541  152   20   18    7    3    1    2 

gawk ' $3739 > 0 { print $1,$2 } ' bp5.cluster.all.cluster3 > remove.strat

# N = 203 removed for not being in the single large cluster

plink --bfile bp5 \
      --remove remove.strat \
      --make-bed \
      --out bp6

# Summary:
# SNPs:    490276  -> 490276
# Indiv:     3744  ->   3541


############################################################################
# 11) Contamination (too much low-level relatedness)

plink --bfile bp6 \
      --extract bp5.pruning.prune.in \
      --geno 0 \
      --make-bed \
      --out bp6.pruned

# ( 'bp6.pruned.genome' calculated on cluster, copied over again )

gawk ' $8 > 0.05 { print $1,$2; print $3,$4 }' bp6.pruned.genome.genome \
  | sort | uniq -c | gawk ' $1>200 { print $2,$3 } ' > remove.contam


# Contamination: N=72 individuals

plink --bfile bp6 \
      --remove remove.contam \
      --make-bed \
      --out bp7

# Summary:
# SNPs:    490276  -> 490276
# Indiv:     3541  ->   3469


############################################################################
# 12) Exclude SNPs with genotyping rate < 95%
# 13) Exclude SNPs with HWD failure p < 1e-6
# 14) Exclude SNPs with MAF < 0.01

# GENO < 5%    : 23673 SNPs
# MAF < 1%     : 67661 SNPs
# HWE p < 1e-6 : 11671 SNPs

# also merge in phenotype

plink --bfile bp7 \
      --pheno wgas_alt_pheno_txt.1 \
      --geno 0.05 \
      --maf 0.01 \
      --hwe 1e-6 \
      --make-bed \
      --out bp8

# Summary:
# SNPs:    490276  -> 391952
# Indiv:     3469  ->   3469


############################################################################
# 15) Exclude SNPs with CHI-MISSING p < 1e-3
# 16) Exclude SNPs with MISHAP p < 1e-10

plink --bfile bp8 \
      --test-missing \
      --out bp8.missing

plink --bfile bp8 \
      --test-mishap \
      --out bp8.mishap

gawk ' $6 < 1e-3 { print $2 } ' bp8.missing.missing > remove.chimiss
gawk ' $8 < 1e-10 && $3 > 0.02 && $4 > 0.02 { print $1 } ' bp8.mishap.missing.hap | sort | uniq > remove.mishap

# N = 388 SNPs  (chi-missing)
# N = 17021 SNPs (mishap test) 

# (note: also imposed a frequency threshold (2% MAF in both for MISHAP test)

cat remove.chimiss remove.mishap > remove.missing


############################################################################
# 17) Exclude SNPs with PLATE-ASSOCIATION p < 1e-10 for at least one plate 

gawk ' { print $3 } ' plate.list | sort | uniq > sty.plates
gawk ' { print $4 } ' plate.list | sort | uniq > nsp.plates

let i=1 a=50
while [ $i -le $a ]
do
d=`gawk ' NR==l ' l=$i sty.plates`
e=`gawk ' NR==l ' l=$i nsp.plates`
gawk ' $3 == d { print $1,$2,2 } $3 != d { print $1,$2,1 } ' d=$d plate.list > sty-$i.pheno
gawk ' $4 == e { print $1,$2,2 } $4 != e { print $1,$2,1 } ' e=$e plate.list > nsp-$i.pheno
let i=$i+1
done


let i=1 a=50
while [ $i -le $a ]
do

plink --bfile bp8 \
      --pheno sty-$i.pheno \
      --extract sty.list \
      --assoc \
      --out plate-sty-$i

plink --bfile bp8 \
      --pheno nsp-$i.pheno \
      --extract nsp.list \
      --assoc \
      --out plate-nsp-$i

let i=$i+1
done

let i=1 a=50
while [ $i -le $a ]
do
echo -ne "$i "
gawk ' BEGIN { c=0 } $8 < 1e-20 { c++ } END { printf c" " } ' plate-sty-$i.assoc
gawk ' BEGIN { c=0 } $8 < 1e-20 { c++ } END { printf c" " } ' plate-nsp-$i.assoc
echo
let i=$i+1
done

# N = 2497 SNPs removed for large between-plate allele frequency differences
# (these tend to be monomophic in all but 1 or 2 plates, where calling
#  has clearly failed)

gawk ' $8 < 1e-10 { print $2 } ' plate-*assoc | sort | uniq > remove.plates

cat remove.missing remove.plates | sort | uniq > remove.biased.snps

# 19759 unique SNPs to be removed from CHI-MISS, MISHAP and PLATE

plink --bfile bp8 \
      --exclude remove.biased.snps \
      --make-bed \
      --out bpfinal


# Summary:
# SNPs:    391952  -> 372193
# Indiv:     3469  ->   3469

# 1461 cases, 2008 controls and 0 missing
# 1628 males, 1841 females, and 0 of unspecified sex

# Create an ordered set of the main covariate file

plink --bfile bpfinal \
      --covar wgas_alt_pheno_txt.1 \
      --write-covar \
      --out variables

# Create some key helper files

gawk ' $8 == 1 { print $1,$2 } ' variables.cov > grp1.list
gawk ' $8 == 2 { print $1,$2 } ' variables.cov > grp2.list
gawk ' $8 == 3 { print $1,$2 } ' variables.cov > grp3.list
gawk ' { print $1,$2,$8 } ' variables.cov > grp.phe

############################################################################
# 18) Analysis clustering scheme

# ( use same set of independent SNPs from bp5 )

plink --bfile bpfinal \
      --extract bp5.pruning.prune.in \
      --make-bed \
      --out bpfinal.pruned

# ( create genome file on Broad cluster -- "bpfinal.pruned.genome.genome" copied back here )

# Cluster within panel, at three levels of PPC

plink --bfile bpfinal \
      --read-genome bpfinal.pruned.genome.genome \
      --cluster \
      --cc \
      --ppc 1e-3 \
      --match grp.phe \
      --mds-plot 6 \
      --out bpfinal.cluster.A

plink --bfile bpfinal \
      --read-genome bpfinal.pruned.genome.genome \
      --cluster \
      --cc \
      --ppc 1e-5 \
      --match grp.phe \
      --mds-plot 6 \
      --out bpfinal.cluster.B

plink --bfile bpfinal \
      --read-genome bpfinal.pruned.genome.genome \
      --cluster \
      --cc \
      --ppc 0.01 \
      --match grp.phe \
      --mds-plot 6 \
      --out bpfinal.cluster.C



############################################################################
# 19) Analysis clustering scheme

bsub -q ten-normal plink --bfile bpfinal \
      --remove grp3.list \
      --make-bed \
      --out bpfinal.step

bsub -q ten-normal plink --bfile bpfinal \
      --keep grp3.list \
      --make-bed \
      --out bpfinal.uk
      

#############################################################################
###                                                                       ###
###               FINISHED -- BPFINAL DATASET CREATED                     ###
###                                                                       ###
#############################################################################


