function startup() {
	ajax(
		"get-quiz.php",
		response => {
			const quizbox = document.querySelector("#quizbox");
			quizbox.textContent = response;
		}
	);
}

window.addEventListener("load", startup);