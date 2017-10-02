# Hack-A-Venture 2017
    Repository for Hack-A-Venture 2017 developers.
	
	
## Pre-requisites
- HTML
- CSS
- JavaScript
- PHP
- MySQL


## Description
	Object model is used in PHP to frame the server-side operations of the website.
	
	
## File Management
	Ajax calls should be kept in ./ajax/ directory
	CSS in ./css/
	JavaScript files in ./js/
	Php class models are to be kept in ./includes/
	Images are kept in subdirectories under ./res/images/levels/ for each level to be included.
	Fonts to be used are kept in ./res/fonts/
	Database files are kept in ./sql/
	General html pages (or part of the pages) such as login, register, navigation bar, header, footer are places ./templates/
	Html of the levels are kept in ./levels_detail/
	
	For general libraries of CSS and JavaScript, they are to be placed under ./css/general/ and ./js/general/ respectively.
	
**If files become unmanagable under these directories, then it can be moved to sub-directories based on the levels.**
	
	
## Naming Conventions
- File and Folder names are given fully lowercase characters seperated by underscore (except class files, they are named same as class names).
- Variable and object names follow camelCase conventions.
- Class names have first letter capital and each first character of the remaining words capital.
- Class methods and other functions follow camelCase conventions.


## Installation
	Place this folder in htdocs in xampp installation folder.
	Create mysql user with username and password as 'ha'.
	Import sql/ha_final.sql with database name 'ha'.
