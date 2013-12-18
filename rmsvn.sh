#!/bin/bash
declare -i count=0
declare -a arr=($1)

while [ ${#arr[@]} -gt $count ];do
	files=$(ls --almost-all ${arr[$count]})
	for file in $files;do
		if [ -d ${arr[$count]}/$file ];then
			if [ $file == ".svn" ];then
				rm -fr ${arr[$count]}/.svn
			else
				arr+=(${arr[$count]}/$file)
			fi
		fi
	done
	count+=1
done
