lines=open("dropdown.html").readlines()

for line in lines:
	print line.split("value='")[1].split("'")[0];