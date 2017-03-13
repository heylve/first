##!/bin/sh.exe
echo "cleaning up log directory"

#function clean_up_2() {     
#	if [[ ! -d "$1" ]]; then
#
#		echo "Argument 1 should be the path of an existing directory" 1>&2         
#		exit 1     
#	fi      
#	rm -r "$1" 
#}
#
#!/usr/bin/env bash  
function clean_up() {
	declare -r directory="$1"      
	if [[ ! -d "$directory" ]]; then         
		echo "Argument 1 should be the path of an existing directory" 1>&2         
		exit 1     
	fi      
	rm -r "$directory" 
}  
	#clean_up "build"
	clean_up

