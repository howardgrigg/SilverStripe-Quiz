<?php
class QuizPage extends Page {

  static $has_many =array(
    "QuizQuestions"  =>  "QuizQuestion"
  );
  
  function getCMSFields() {
		$f = parent::getCMSFields();
		
		$QuestionsGridConfig = GridFieldConfig_RelationEditor::create();
		$QuestionsGrid = new GridField('Questions', 'Questions', $this->QuizQuestions(), $QuestionsGridConfig) ;
		
		$f->addFieldToTab( 'Root.Questions', $QuestionsGrid );
		return $f;
	}

}


class QuizPage_Controller extends Page_Controller {
	
  function Questions(){
    $questions = $this->QuizQuestions();
    $justOne = new PaginatedList($questions, $this->request);
    $justOne->setPageLength(1);
    return $justOne;

  }

  function addQuestionForm() {

    $fields = new FieldList(
      new TextField('Question','<h4>Question:</h4>'),
      $uploadField = new FileField('Image','Add an Image (file must be below 300kb)'),
      new LiteralField('tabs',"<div id='multichoice' class='quizanswertab'>Multi Choice/True False</div><div id='shortanswer' class='quizanswertab'>Short Answer</div>"),
      $answers = new CompositeField(
        $single = new CompositeField(
          $singlefield = new TextField('ShortAnswer','Short Answer:')
        ),
        $multi = new CompositeField(
          new CompositeField(
            new TextField('Answer1','Answer 1:'),
            new TextField('Explanation1','Explanation 1: (optional)'),
            new CheckboxField('Correct1','Correct?')
          ),
          new CompositeField(
            new TextField('Answer2','Answer 2:'),
            new TextField('Explanation2','Explanation 2: (optional)'),
            new CheckboxField('Correct2','Correct?')
          ),
          new CompositeField(
            new TextField('Answer3','Answer 3: (optional)'),
            new TextField('Explanation3','Explanation 3: (optional)'),
            new CheckboxField('Correct3','Correct?')
          ),
          new CompositeField(
            new TextField('Answer4','Answer 4: (optional)'),
            new TextField('Explanation4','Explanation 4: (optional)'),
            new CheckboxField('Correct4','Correct?')
          )
        )
      ),
      new HiddenField (
        $name = "Page",
        $title = "Page",
        $value = "$this->ID")
    );
    $answers->addExtraClass('answertab');
    $multi->addExtraClass('multichoicetab');
    $multi->addExtraClass('answertab');
    $single->addExtraClass('answertab');
    $single->addExtraClass('singletab');
    $singlefield->addExtraClass('singlefield');
    $singlefield->addExtraClass('validate[required]');

    $uploadField->getValidator()->setAllowedExtensions(array('jpg','jpeg','JPG','JPEG', 'gif','GIF','png','PNG'));
    $uploadField->getValidator()->setAllowedMaxFileSize('315000');
    //   $uploadField->setVar('buttonText','Click here to add an Image');
    $actions = new FieldList(
      new FormAction('doAddQuestion', 'Submit')
    );

    $validator = new RequiredFields('Question');

    return new Form($this, 'addQuestionForm', $fields, $actions, $validator);
  }

  function doAddQuestion($data, $form){
    $data = $form->getData();
    $question = new QuizQuestion();
    $question->QuizPageID = $this->ID;
    $form->saveInto($question);
    $question->write();

    if (!empty($data['Answer1'])) {
      $answer1 = new QuizAnswer();
      $answer1->Answer = $data['Answer1'];
      $answer1->Explanation = $data['Explanation1'];
      $answer1->Correct = $data['Correct1'];
      $answer1->QuizQuestionID = $question->ID;
      $answer1->write();
    }

    if (!empty($data['Answer2'])) {
      $answer2 = new QuizAnswer();
      $answer2->Answer = $data['Answer2'];
      $answer2->Explanation = $data['Explanation2'];
      $answer2->Correct = $data['Correct2'];
      $answer2->QuizQuestionID = $question->ID;
      $answer2->write();
    }

    if (!empty($data['Answer3'])) {
      $answer3 = new QuizAnswer();
      $answer3->Answer = $data['Answer3'];
      $answer3->Explanation = $data['Explanation3'];
      $answer3->Correct = $data['Correct3'];
      $answer3->QuizQuestionID = $question->ID;
      $answer3->write();
    }

    if (!empty($data['Answer4'])) {
      $answer4 = new QuizAnswer();
      $answer4->Answer = $data['Answer4'];
      $answer4->Explanation = $data['Explanation4'];
      $answer4->Correct = $data['Correct4'];
      $answer4->QuizQuestionID = $question->ID;
      $answer4->write();
    }

    Controller::redirect($this->link().'#quiz');
  }


}