<?php
    
    $levelSolution = $levelDataMgr->GetData('level_question');
    if($levelSolution == NULL) {
        //We need to set a solution for this question over here. 
        //For this stage it will be set 
        $questionsArray = [["antelope", "lspr t@ew nehs ei@o o@ad apts"], ["elephant", "hspr e@ew lths pi@o a@ad ents"], ["hedgehog", "espr d@ew eghs gi@o h@ad hots"], ["kangaroo", "aspr n@ew aohs gi@o r@ad kots"], ["mongoose", "ospr n@ew oehs gi@o o@ad msts"], ["squirrel", "rspr u@ew qlhs ii@o r@ad sets"]];
        $selectedQuestion = $questionsArray[array_rand($questionsArray)];
        //Add this as question and answer
        $levelDataMgr->SetData('level_solution', $selectedQuestion[0]);
        $levelSolution = $selectedQuestion[1];
        $levelDataMgr->SetData('level_question', $selectedQuestion[1]);
    }

    $template->setTemplateVar('level_question', $levelSolution);
?>