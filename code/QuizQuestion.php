<?php
class QuizQuestion extends DataObject {
	 
	static $db = array(
	 "Question"  =>  "Text",
	 "ShortAnswer" =>  "Text"
	);

	static $has_one =array(
	 "QuizPage"  =>  "QuizPage",
	 "Image" =>  "Image"
	);

	static $has_many =array(
	 "Answers" =>  "QuizAnswer"
	);
	
	static $many_many =array(
	);

	static $belongs_many_many = array(
	);
	
	static $summary_fields = array(
      'Question'
   );

	function getCMSFields() {
		$AnswersGridConfig = GridFieldConfig_RelationEditor::create();
		
		$f = new FieldList(
		  new TextField("Question"),
		  new TextField("ShortAnswer"),
		  new UploadField("Image"),
		  
		  $AnswersGrid = new GridField('Answers', 'Answers', $this->Answers(), $AnswersGridConfig)
		  
		);

		return $f;
	}
	
	function RandAnswers(){
    $questions = DataList::create('QuizAnswer')
      ->filter(array(
  	     'QuizQuestionID' => $this->ID
  	   ))
  	  ->sort('RAND()');
    
    return $questions;
  }
  
	function ImageMaxWidth(){
		if($this->Image()->getWidth() < 760) {
			return $this->Image();} 
		else {
			return $this->Image()->setWidth(760);}
	}
}