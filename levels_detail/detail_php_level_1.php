<?php
    
    $levelSolution = $levelDataMgr->GetData('level_question');
    if($levelSolution == NULL) {
        //We need to set a solution for this question over here. 
        //For this stage it will be set 
        $questionsArray = [["envy", "rail"], ["sync", "flap"], ["cheryl", "purely"], ["terra", "green"], ["clerk", "pyrex"]];
        $selectedQuestion = $questionsArray[array_rand($questionsArray)];
        //Add this as question and answer
        $levelDataMgr->SetData('level_solution', $selectedQuestion[0]);
        $levelSolution = $selectedQuestion[1];
        $levelDataMgr->SetData('level_question', $selectedQuestion[1]);
    }

    $template->setTemplateVar('level_question', $levelSolution);
?>