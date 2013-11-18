#git update from remote & merge

	git fetch origin master:tmp
	git diff tmp 
	git merge tmp
