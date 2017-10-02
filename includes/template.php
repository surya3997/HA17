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

    //This function is used to get the page title for the template page. Should change for every page.
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
            case '2' : $levelCSSLinks = '<link rel="stylesheet" href="./css/levels/level2/l2.css">';
                        $levelJSLinks = '<script type="text/javascript" src="js/levels/level2/l2.js"></script>';
                
                break;
            case '3': $levelCSSLinks = '<link rel="stylesheet" href="./css/levels/level3/l3.css">';
                        $levelJSLinks = '<script type="text/javascript" src="js/general/jQuery.js"></script>';
                break;
            case '4':
                        $levelCSSLinks = '<link href="./css/levels/level4/facebook.css" rel="stylesheet">';
                        $levelJSLinks = '<script type="text/javascript" src="./js/levels/level4/facebook.js"></script>';
                break;
            case '5':
                
                break;
            case '6': $levelCSSLinks = '<link rel="stylesheet" href="./css/levels/level6/wa.css">';
                        $levelJSLinks = '<script type="text/javascript" src="./js/levels/level6/level6.js"></script>';
                
                break;
            case '7': $levelCSSLinks = '<link rel="stylesheet" href="./css/levels/level7/l7.css">';
                        $levelJSLinks = '<script type="text/javascript" src="js/levels/level7/l7.js"></script>';
                    
                break;

            case '8':
            $levelCSSLinks = '<link rel="stylesheet" href="./css/levels/level8/l8.css">';
            $levelJSLinks = '<script type="text/javascript" src="js/levels/level8/l8.js"></script>';
                
                break;
            case '9':
                        $levelCSSLinks = '<link rel="stylesheet" href="./css/levels/level9/firstLevel.css"><link rel="stylesheet" href="./css/levels/level9/hex.css">';
                        $levelJSLinks = '<script type="text/javascript" src="./js/levels/level9/jquery-landpiece.js"></script><script type="text/javascript" src="./js/levels/level9/main_botwar_ui.js"></script><script type="text/javascript" src="./js/levels/level9/hex.js"></script>';
                break;
            case '10':

                    $levelCSSLinks = '<link rel="stylesheet" href="./css/levels/level10/l10.css">';
                    $levelJSLinks = '<script type="text/javascript" src="js/levels/level7/l7.js"></script>';
                
                break;
            case '11':  $levelJSLinks = //'<script src="../js/jquery-1.7.1.min.js"></script>'.
                                        '<script src="./js/levels/level11/jquery.mousewheel-min.js"></script>
                                        <script src="./js/levels/level11/jquery.terminal.min.js"></script>
                                        <script src="./js/levels/level11/terminal_cd.js"></script>
                                        <script src="./js/levels/level11/bootstrap.js"></script>';
                        $levelCSSLinks = '<link href="./css/levels/level11/jquery.terminal1.css" rel="stylesheet" />';

                break;
            case '12':
                break;
            default:
                break;
        }
        
        //Something else now. For all other pages this will work
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

