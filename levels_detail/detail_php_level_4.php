<?php
    
    $levelSolution = $levelDataMgr->GetData('level_question');
    if($levelSolution == NULL) {
        //We need to set a solution for this question over here. 
        //For this stage it will be set 
        $a=array("oxyMoron","Slender","TeamSprit","IcanSeeYou","YouFoundThis","SimplyEasy","NiceWork");
        $random_keys=array_rand($a);
        $ans = $a[$random_keys];
        //Add this as question and answer
        $levelDataMgr->SetData('level_solution', $ans);
        $levelDataMgr->SetData('level_question', $ans);
        $levelSolution = $ans;
    }

    $template->setTemplateVar('level_question', $levelSolution);
?>