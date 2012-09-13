<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
		<div id="quiz">
			<div id="show-questions">Show Questions</div>
			<div id="quiz-block">
				<% if QuizQuestions %>
					<% include QuizBlock %>
				<% else %>
					<h3>No Questions added yet - anyone is welcome to add some.</h3>
				<% end_if %>
			</div>
			<% if CurrentMember %>
				<span id="add-question-button" class="add-button add-question">Add a question</span>
				<div id="add-question">
					$addQuestionForm
				</div>
			<% else %>
				<span class="add-button"><a href="$LoginURL">Sign in to add a Question</a></span>
			<% end_if %>			
		</div>
	</article>
		$Form
		$PageComments
</div>
<% include SideBar %>