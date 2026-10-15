file="pom_flags.txt"

# Put each flag on a separate line
sed 's/\-\-/\n\-\-/g' $file > clean1_${file}

#Move < to new line
sed 's/</\n</g' clean1_${file} > clean2_${file}

# move " to new line
sed 's/"/\n"/g' clean2_${file} > clean3_${file}

# move ) to new line 
sed 's/)/\n)/g' clean3_${file} > clean4_${file}

# Move > to new line
sed 's/>/\n>/g' clean4_${file} > clean5_${file}

# Remove non-flag lines
grep '\-\-' clean5_${file} > clean6_${file}

# Grab only the first field (which is a flag, with garbage at end, maybe)
awk '{print $1}' clean6_${file} > clean7_${file}


# Get unique list of webflags
cat clean7_${file} | sort | uniq > uniq_${file}

rm clean[1234567]_${file}



