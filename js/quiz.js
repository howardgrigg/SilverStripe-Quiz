jQuery.noConflict();

(function($) {    
	$(document).ready(function() {
		$('.add-question').click(function(event) {
			$('.add-question').hide();
			$('#quiz-block').slideUp();
			$('#add-question').slideDown();
			$('#show-questions').fadeIn();
		});
    
		$('#show-questions').click(function(event) {
			$(this).hide();
			$('#quiz-block').slideDown();
			$('#add-question').slideUp();
			$('#show-questions').fadeOut();
			$('#add-question-button').fadeIn();
		});
		
		var numCorrect = $('.correct').length;
		var numCorrectLeft = numCorrect;
		
		$("#quiz ul li").click(function(event) {
			$(this).children().show();
			$(this).addClass("marked");
			if($(this).hasClass("correct")){
				numCorrectLeft = numCorrectLeft - 1;
			}
			if(numCorrectLeft == 0){
				$("#next").addClass("ready");
			}
		});
		
		$("#Form_addQuestionForm").validate({
			rules: {
				Questiion: "required",
				ShortAnswer: "required",
				Answer1: "required",
				Answer2: "required"
			}
		});
		
		$('#click-to-reveal').click(function(event) {     
			$('#short-answer-answer').slideDown();
			$(this).slideUp();  
			$(".next-holder").animate({ 'padding-top' : '20px' }, "slow");
		});
		
		$("#shortanswer").click(function() {
			$(".multichoicetab").slideUp();
			$(".CompositeField.singletab").slideDown();
		});
		
		$("#multichoice").click(function() {
			$(".multichoicetab").slideDown();
			$(".CompositeField.singletab").slideUp();
		});
		
 	});
}(jQuery));