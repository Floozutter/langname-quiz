let COUNT;
let CURR;
let SCORE;

function enableButty() {
	const butty = document.querySelector("#butty");
	butty.disabled = false;
	butty.addEventListener("click", _ => {
		butty.disabled=true;
		CURR += 1;
		if (CURR < COUNT) {
			getQuestion();
		}
		else {
			updateSession();
			endQuiz();
		}
	}, { once: true });
}

function getQuestion() {
	ajax(
		`get-quiz.php?question=${CURR}`,
		setQuestion
	);
}

function setQuestion(response) {
	const question = JSON.parse(response);
	const promptDiv = document.querySelector("#prompt");
	promptDiv.innerHTML = question.prompt;
	const choicesDiv = document.querySelector("#choices");
	choicesDiv.innerHTML = "";
	question.choices.forEach((c, i) => {
		const cDiv = document.createElement("div");
		cDiv.classList.add("choice", "list-group-item");
		cDiv.classList.add();
		cDiv.dataset.index = i;
		cDiv.innerHTML = c.content;
		choicesDiv.appendChild(cDiv);
		cDiv.addEventListener("click", choiceListener, { once: true });
	});
	const progressSpan = document.querySelector("#progress");
	progressSpan.textContent = `${CURR+1} of ${COUNT}`;
}

function choiceListener(e) {
	e.target.classList.add("selected", "list-group-item-primary");
	document.querySelectorAll(".choice").forEach(cDiv => {
		cDiv.removeEventListener("click", choiceListener);
	});
	ajax(
		`get-quiz.php?full=${CURR}`,
		processAnswer
	);
}

function processAnswer(response) {
	const question = JSON.parse(response);
	document.querySelectorAll(".choice").forEach(cDiv => {
		const index = parseInt(cDiv.dataset.index, 10);
		const correct = question.choices[index].correct;
		cDiv.classList.add(
			correct
			? cDiv.classList.add("correct")
			: cDiv.classList.add("incorrect")
		);
		const badge = document.createElement("span");
		badge.classList.add(
			"badge",
			correct ? "badge-success" : "badge-danger",
			"badge-pill",
			"float-right"
		);
		badge.textContent = correct ? '\u2713' : '\u2717';
		cDiv.appendChild(badge);
		const explanation = document.createElement("div");
		explanation.classList.add("text-muted");
		explanation.innerHTML = question.choices[index].explain;
		cDiv.appendChild(explanation);
	});
	const selected = document.querySelector(".choice.selected");
	const selectedIndex = parseInt(selected.dataset.index, 10);
	if (question.choices[selectedIndex].correct) {
		SCORE += 1;
	}
	const scoreSpan = document.querySelector("#score");
	scoreSpan.textContent = `${SCORE}`;
	enableButty();
}

function updateSession() {
	ajax(
		`get-quiz.php?score=${SCORE}`,
		() => {}
	);
}

function endQuiz() {
	document.querySelector("#prompt").innerHTML = (
		"Great job, you're done! Submit your score using the button below."
	)
	document.querySelector("#choices").innerHTML = "";
	const butty = document.querySelector("#butty");
	butty.textContent = "Submit";
	butty.addEventListener("click", _ => {
		location.href = "score.php";
	});
	butty.disabled = false;
}

function startup() {
	COUNT = -1;
	CURR = -1;
	SCORE = 0;
	ajax(
		'get-quiz.php?count=true',
		response => {
			COUNT = parseInt(response, 10);
			enableButty();
		}
	);
}

window.addEventListener("load", startup);