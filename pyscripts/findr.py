lines=open("jobsclean.txt").readlines()


print "<select>"

for line in lines:
	print "<option value='"+line+"''>"+line+"</option>"

print "</select>"