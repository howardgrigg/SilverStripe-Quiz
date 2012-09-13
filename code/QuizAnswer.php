<?php
class QuizAnswer extends DataObject {
	 
	static $db = array(
	 "Answer"  =>  "Text",
	 "Explanation" =>  "Text",
	 "Correct" =>  "Boolean"
	);

	static $has_one =array(
	 "QuizQuestion" =>  "QuizQuestion"
	);
	static $summary_fields = array(
      'Answer',
      'Correct'
   );
}