lines=open("jobsclean.txt").readlines();

def caps(word):
	return word[0].upper() + word[1:]

for line in lines:
	title = map(caps, line.split(" "))
	print " ".join(title).strip()