#!/bin/bash
ROOT=$(cd $(dirname $0) && pwd)

shopt -s nullglob
function installDistributionFiles
{
	for distFile in "$ROOT/$1/"*.dist.php
	do
		file=${distFile/".dist.php"/".php"} # Change the .dist.php into .php
		fileName=$(basename "$file") # Get the name of the file
		if [ ! -f $file ]; then
			cp -f $distFile $file
			echo -e "\e[32m - Installing $fileName\e[39m"
		else
			echo -e "\e[90m - Skipping $fileName\e[39m"
		fi
	done
}

echo "+-----------------------------------------------------+"
echo "|          Installer for distribution files           |"
echo "+-----------------------------------------------------+"

installDistributionFiles "application"
installDistributionFiles "application/config"

echo "+-----------------------------------------------------+"
echo "| Do not forget to edit the installed files if needed |"
echo "+-----------------------------------------------------+"
