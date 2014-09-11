lines=open("jobs.txt").readlines()

print "<select>"

for line in lines:
	size=len(line)
	print "\t<option value="+"'"+line[0:size-1]+"'"+">"+line[0:size-1]+"</option>"

print "</select>"