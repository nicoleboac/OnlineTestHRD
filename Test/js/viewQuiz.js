var questionNumber = 1;
function viewNextQuestion(){
   var questionsDiv = document.getElementsByClassName('questions')[0];

   questionsDiv.getElementsByClassName('activeQuestion')[0].className = "panel panel-warning question row";
   questionsDiv.getElementsByClassName('question')[questionNumber].className = "panel panel-warning activeQuestion question row";
   

   var activeQuestion = document.getElementsByClassName('questionNumber')[0];

   activeQuestion.getElementsByTagName('button')[questionNumber].className = "btn btn-default active";
   questionNumber++;
}