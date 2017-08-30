<?php

/**
 * This class is mainly used for loading the required pages to the site.
 * This avoids unwanted trouble with the manual inclusion of files.
 */
class Template {
    //This holds the name of the page we want to load.
    private $pageName;
    private $pageTitle;
    private $templateVars;
    private $rootPath;
    private $levelId;
    //This is the constructor of template class. Nothing much to do.
    function __construct() {
        $this->rootPath = $_SERVER['DOCUMENT_ROOT'].'/HA17/';
        $this->pageName = '';
    }

    private function getUserName() {
        global $user;
        return $user->getUserName();
    }

    //This function is used to set the page name.
    public function setPage($page)  {
        $page = trim($page);
        if ($page != '')  {
            $this->pageName = $page;
            return true;
        }
        return false;
    }

    //This function is used to get the page name.
    public function getPage()  {
        return $this->pageName;
    }

    //This function is used to set the page title.
    public function setPageTitle($pageTitle)  {
        $this->pageTitle = $pageTitle;
    }

    //This function is used to get the page title for the template page.
    private function getPageTitle() {
        return $this->pageTitle;
    }

    /**
     * Setter for a custom level number so that only the required content can be included.
     */
     public function setLevelId($level) {
        $this->levelId = $level;
    }

    public function getLevelId() {
        return $this->levelId;
    }

    //Used for setting a single variable of So
    public function setTemplateVar($varName, $varValue) {
        $this->templateVars[$varName] = $varValue;
    }

    //This function is used to check if a template variable is set and print it.
    public function printVar($varName)  {
        if ( isset($this->templateVars[$varName]) )     {
            echo $this->templateVars[$varName];
        }
    }

    /** 
     * Method to compute some terms that are required on every page.
     */
     private function CalculateCommonData() {
        global $levelMgr, $user;
        
        //Score that will be displayed in the Navigation bar.
        $this->setTemplateVar('USER_SCORE', $levelMgr->GetUserScore());
        $this->setTemplateVar('USER_TYPE', $user->GetUserType());
        //Load some data based on the particular level.
        $levelCSSLinks = ''; //<link href="css/ha-general.css" rel="stylesheet">
        $levelJSLinks = '';
        
        switch($this->pageName) {
            case '1':   $levelCSSLinks = '<link rel="stylesheet" href="./css/levels/level1/l1.css">';
                        $levelJSLinks = '<script type="text/javascript" src="js/levels/level1/l1.js"></script>';
                break;
            case '2' :
                
                break;
            case '3':
                
                break;
            case '4':
                
                break;
            case '5':
                
                break;
            case '6':
                
                break;
            case '7':
                
                break;
            case '9':
                
                break;
            case '10':
                
                break;
            default:
                break;
        }
        
        //Something else now. For all other pages
        switch($this->pageName) {
            case 'index':
                
                break;
        }
        $this->setTemplateVar('LEVEL_CSS', $levelCSSLinks);
        $this->setTemplateVar('LEVEL_JS', $levelJSLinks);
    }

    //This function is used to load the whole page where required.
    public function loadPage()  {
        //Do some common data computation
        $this->CalculateCommonData();
        //Now we load all the pages.
        include $this->rootPath.'templates/level_source/template_header.php';
        include $this->rootPath.'templates/level_source/level_'.$this->pageName.'.php';
        include $this->rootPath.'templates/level_source/template_footer.php';
    }

    /**
     * Method used for loading a template which does not need Header / Footer details
     * Eg: Login page.
     */
    public function loadCustomPage($pageName) {
        $pageName = trim($pageName);
        if($pageName == '') {
            return false;
        }
        include $this->rootPath.'templates/c_template_'.$pageName.'.php';
    }
}

?>
