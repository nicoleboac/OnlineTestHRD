var questionCount = 1;
function addQuestion(){
	
	if(!checkBlank() ){
	questionCount++;
	var q = document.getElementsByClassName("questions")[0];

	var tabDiv = document.createElement("div");
	tabDiv.setAttribute("id", "tabs-"+questionCount);
	tabDiv.setAttribute("class", "panel panel-warning  question row");
	tabDiv.setAttribute("aria-labelledby","ui-id-"+questionCount);
	tabDiv.setAttribute("role","tabpanel");
	tabDiv.setAttribute("aria-hidden","true");
	tabDiv.setAttribute("style","display:none");

	var tabHeading = document.createElement("div");
	tabHeading.setAttribute("class","panel-heading col-md-12 col-xs-12");

	var tabHeadingInput = document.createElement("input");
	tabHeadingInput.setAttribute("placeholder","Enter Question here");
	tabHeadingInput.setAttribute("class","col-md-10 newQuizHeader3 col-xs-12");
	tabHeadingInput.setAttribute("name","q"+questionCount+"-desc");

	var tabHeadingP = document.createElement("p");
	tabHeadingP.setAttribute("class"," col-md-2 col-xs-12 text-center");

	var tabHeadingSpan = document.createElement("span");
	tabHeadingSpan.setAttribute("class", "badge");
	
	var tabHeadingSpanInput = document.createElement("input");
	tabHeadingSpanInput.setAttribute("type","number");
	tabHeadingSpanInput.setAttribute("class","points col-md-10");
	tabHeadingSpanInput.setAttribute("value","1");
	tabHeadingSpanInput.setAttribute("name","q-points-"+questionCount);
	tabHeadingSpanInput.setAttribute("onkeyup","updateTotalPoints()");

	var tabHeadingPText = document.createTextNode("Points");

	var totalChoicesInput = document.createElement("input");
	totalChoicesInput.setAttribute("type","hidden");
	totalChoicesInput.setAttribute("class","choiceCount");
	totalChoicesInput.setAttribute("name","totalChoice"+questionCount);
	totalChoicesInput.setAttribute("value","2");

	tabHeading.appendChild(tabHeadingInput);
	tabHeading.appendChild(tabHeadingP);
	tabHeadingSpan.appendChild(tabHeadingSpanInput);
	tabHeadingP.appendChild(tabHeadingSpan);
	tabHeadingP.appendChild(tabHeadingPText);
	tabDiv.appendChild(tabHeading);
	tabDiv.appendChild(totalChoicesInput);

	var tabFirstChoice = document.createElement("div");
	tabFirstChoice.setAttribute("class","input-group col-md-6 col-xs-12");

	var tabFirstChoiceInput = document.createElement("input");
	tabFirstChoiceInput.setAttribute("type","text");
	tabFirstChoiceInput.setAttribute("class","form-control choice");
	tabFirstChoiceInput.setAttribute("placeholder","Enter answer to blank here");
	tabFirstChoiceInput.setAttribute("name","cvalue"+questionCount+"-1");

	tabFirstChoice.appendChild(tabFirstChoiceInput);
	tabDiv.appendChild(tabFirstChoice);

	q.appendChild(tabDiv);

	//create new question number index
	var questionNumberDiv = document.getElementsByClassName('questionNumber')[0];

	var questionNumberDivLi = document.createElement('li');

	var questionNumberDivLiA = document.createElement("a");
	questionNumberDivLiA.setAttribute("role","presentation");
	questionNumberDivLiA.setAttribute("tabindex","-1");
	questionNumberDivLiA.setAttribute("id","ui-id-"+questionCount);

	var questionNumberDivLiAButton = document.createElement("button");
	questionNumberDivLiAButton.setAttribute("type","button");
	questionNumberDivLiAButton.setAttribute("class","btn btn-default");
	questionNumberDivLiAButton.setAttribute("onclick","changeActiveClass("+(questionCount-1)+")");
	questionNumberDivLiAButton.innerHTML = questionCount;

	questionNumberDiv.appendChild(questionNumberDivLi);
	questionNumberDivLi.appendChild(questionNumberDivLiA);
	questionNumberDivLiA.appendChild(questionNumberDivLiAButton);
	
	questionNumberDivLiAButton.click();
	updateTotalPoints();
	updateTotalQuestions();
	document.getElementById('removeQuestionButton').removeAttribute("disabled");
	}
}
function removeQuestion(){
	questionCount--;
	var questionNumber = parseInt(document.getElementsByClassName('activeQuestion')[0].id.substr(5));
	var questionNumberDiv = document.getElementsByClassName('questionNumber')[0];
	var questionDiv = document.getElementsByClassName('activeQuestion')[0];

for(var i = (questionNumber+1); document.getElementById('tabs-' + i) != null;i++){
	var currentDiv = document.getElementById('tabs-' + i);
	if(document.getElementById('tabs-' + i) != null){
		var questionDiv = document.getElementById('tabs-' + i);
		questionDiv.id = "tabs-"+(i-1);

		questionDiv.getElementsByClassName('newQuizHeader3').name="q"+(i-1)+"-desc";
		questionDiv.getElementsByClassName('points').name="q-points"+(i-1);

		for(var x=0; currentDiv.getElementsByClassName('radioChoice')[x] != null; x++){
			currentDiv.getElementsByClassName('radioChoice')[x].name = "choice"+questionNumber;
		}

		for(var y=0; currentDiv.getElementsByClassName('choice')[y] != null; y++){
			currentDiv.getElementsByClassName('choice')[y].name = "cvalue"+questionNumber+'-'+(y+1);
		}
	}
}

if(questionNumber==1){
	changeActiveClass((questionNumber));
}else{
	changeActiveClass((questionNumber-2));
}
document.getElementsByClassName('questions')[0].removeChild(document.getElementsByClassName('question')[questionNumber-1]);
questionNumberDiv.removeChild(questionNumberDiv.getElementsByTagName('li')[questionNumberDiv.getElementsByTagName('button').length-1]);
document.getElementsByClassName('btn btn-default')[(questionNumber-1)].className="btn btn-default active";
checkIfLast();
}

function checkIfLast(){
	if(document.getElementsByClassName('question').length == 1){
		document.getElementById('removeQuestionButton').setAttribute("disabled","");
	}
}


updateTotalPoints();
function updateTotalPoints(){
	var total = 0;
	for(var i = 0; document.getElementsByClassName('points')[i] != null;i++ ){
		total += parseInt(document.getElementsByClassName('points')[i].value);
	}
	document.getElementById('totalPoints').innerHTML  = total;
	document.getElementById('totalP').value = total;
}
updateTotalQuestions();
function updateTotalQuestions(){
	document.getElementById('totalQuestions').innerHTML = questionCount;
	document.getElementById('totalQ').value = questionCount;
}

function checkRadioButtons(){
	var q = document.getElementsByClassName('activeQuestion')[0];

	checked = false;
	var radioChoiceArray = q.getElementsByClassName('radioChoice');
	for(var i = 0; radioChoiceArray[i] != null ; i++){
		if(radioChoiceArray[i].checked){
			checked = true;
		}
	}
	return checked;
}

function checkBlank(){
	var q = document.getElementsByClassName('activeQuestion')[0];

	noBlank = false;

	if(q.getElementsByClassName("newQuizHeader3")[0].value.indexOf("___") == -1){
		alert("No blanks found");
		noBlank = true;
	}

	return noBlank;
}

function changeActiveClass(number){
	
	document.getElementsByClassName('activeQuestion')[0].className = "panel panel-warning  question row";
	var x = document.getElementsByClassName('question')[number];
	x.className = "";
	x.className = "panel panel-warning activeQuestion question row ";
	document.getElementsByClassName('btn btn-default active')[0].className="btn btn-default";

	var questionUL = document.getElementsByClassName('questionNumber')[0];
	questionUL.getElementsByClassName('btn-default')[number].className = "btn btn-default active";
	
}
function checkTitle(){
	var isNotNull = true;
	var title = document.getElementsByName("quiz-title")[0].value;

	if(title == "" || title== null){
		isNotNull = false;
	}
	if(!isNotNull){
		alert("Please fill out the title of the Test.");
	}
	return isNotNull;
}
