<% require css(quiz/css/quiz.css) %> 
<% require javascript(http://code.jquery.com/jquery-1.7.2.js) %>
<% require javascript(quiz/js/validate.jquery.js) %>
<% require javascript(quiz/js/quiz.js) %>
  <% loop Questions %>
    <h3>$Question</h3>
    <% if Image %>
      <div id="question-image">
        $ImageMaxWidth
      </div>
    <% end_if %>
    <% if ShortAnswer %>
      <div id="click-to-reveal">Click to reveal answer</div>
      <div id="short-answer-answer">$ShortAnswer</div>
      
    <% else %>
    <ul>
      <% loop RandAnswers %>
        <li <% if Correct %>class="correct"<% else %>class="incorrect"<% end_if %>>
          <span>$Answer</span>
          <% if Explanation %>
            <br><span class="explain">$Explanation</span>
            <% end_if %>
        </li>
      <% end_loop %>
    </ul>
    <% end_if %>
  <% end_loop %>
  <% if Questions.NotLastPage %>
    <div class="next-holder">
      <a id="next" href="{$Questions.NextLink}#quiz">Next</a>
    </div>
  <% else %>
    <div class="next-holder">
      <a id="next" class="add-question no-more" href="#">No more - add some</a>
    </div>
  <% end_if %>
  <% if Questions.MoreThanOnePage %>
  <div class="pagination">
    <% if Questions.NotFirstPage %>
      <a id="prev" href="{$Questions.PrevLink}#quiz">Prev</a>
    <% end_if %>
    <% loop Questions.Pages %>
      <% if CurrentBool %>
        $PageNum
      <% else %>
        <% if Link %>
          <a href="{$Link}#quiz">$PageNum</a>
        <% else %>
          ...
        <% end_if %>
      <% end_if %>
    <% end_loop %>
    <% if Questions.NotLastPage %>
    <a  href="{$Questions.NextLink}#quiz">Next</a>
    <% end_if %>  
    <% end_if %>
  </div>