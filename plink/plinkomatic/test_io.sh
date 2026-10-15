#!/usr/bin/bash
# Defaults:
# small.ped, small.map
# new.ped, new.map (merge)
# snplist.txt (extract, exclude, flip)
# indlist.txt (keep, remove)

# Data management

plink --file small --out Mrecode --recode
plink --file small --out Mrecode12 --recode12
plink --file small --out MrecodeAD --recodeAD

plink --file small --out Mmakebed --make-bed 

plink --file small --out MmergeP1 --merge new.ped new.map --merge-mode 1 --recode
plink --file small --out MmergeP2 --merge new.ped new.map --merge-mode 2 --recode 
plink --file small --out MmergeP3 --merge new.ped new.map --merge-mode 3 --recode
plink --file small --out MmergeP4 --merge new.ped new.map --merge-mode 4 --recode
plink --file small --out MmergeP5 --merge new.ped new.map --merge-mode 5 --recode 
plink --file small --out MmergeP6 --merge new.ped new.map --merge-mode 6 --recode
plink --file small --out MmergeP7 --merge new.ped new.map --merge-mode 7 --recode

plink --file small --out MextractP1 --extract snplist.txt --recode
plink --file small --out MextractP2 --extract snplist.txt --make-bed

plink --file small --out MexcludeP1 --exclude snplist.txt --recode 
plink --file small --out MexcludeP2 --exclude snplist.txt --make-bed 

plink --file small --out MkeepP1 --keep indlist.txt --recode
plink --file small --out MkeepP2 --keep indlist.txt --make-bed 

plink --file small --out MremoveP1 --remove indlist.txt --recode 
plink --file small --out MremoveP2 --remove indlist.txt --make-bed

plink --file small --out MflipP1 --flip snplist.txt --recode 
plink --file small --out MflipP2 --flip snplist.txt --make-bed

# Summary Stats
plink --file small --out Mmissing --missing 

plink --file small --out Mtestmissing --test-missing 

plink --file small --out Mfreq --freq 

plink --file small --out Mhardy --hardy 

plink --file small --out Mmendel --mendel 

# Population Stratification

plink --file small --out MclusterP1nomat --pmerge 0.01 
