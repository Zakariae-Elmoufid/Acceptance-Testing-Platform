<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouCode -Coding School'</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ff5722',
                        secondary: '#212121',
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="font-poppins text-gray-800 bg-gray-50">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4 text-center">Quiz</h1>

        <form id="quiz-form" action="" method="">
            
            @csrf

            <div id="quiz-container" class="bg-white shadow-lg rounded-lg p-6">
                <div id="question-container" class="mb-6">

                </div>

                <div id="progress-bar" class="h-4 bg-gray-300 rounded-full mb-6">
                    <div id="progress" class="h-full bg-primary rounded-full transition-all duration-500"></div>
                </div>

                <div class="flex justify-between">
                    <button type="button" id="prev-btn" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded transition duration-200" onclick="showPreviousQuestion()">Précédent</button>
                    <div id="timer" class="text-2xl font-bold text-primary">00:30</div>
                    <button type="button" id="next-btn" class="bg-primary hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded transition duration-200" onclick="showNextQuestion()">Suivant</button>
              </div>

                <div id="submit-container" class=" justify-center hidden">
                    <button type="submit" class="bg-primary hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded transition duration-200">Soumettre</button>
                </div>
            </div>

        </form>   
        </div>


<script>
    const questions = @json($questions);
    const questionContainer = document.getElementById('question-container');
    const progressBar = document.getElementById('progress');
    const timerElement = document.getElementById('timer');
    const prevButton = document.getElementById('prev-btn');
    const nextButton = document.getElementById('next-btn');
    const submitContainer = document.getElementById('submit-container');
    let currentQuestionIndex = 0;
    let timeLeft = 30;
    let timer;

    function startTimer() {
        timeLeft = 30;
        timer = setInterval(() => {
            timeLeft--;
            updateTimerDisplay();

            if (timeLeft === 0) {
                clearInterval(timer);
                showNextQuestion();
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }

    function showQuestion() {
        const question =
        questions[currentQuestionIndex];
        const questionHtml = `
            <div class="bg-blue-100 border-l-4 border-primary p-4 mb-4">
                <p class="font-semibold mb-2 text-lg">${currentQuestionIndex + 1}. ${question.content}</p>
            </div>
            <div class="grid grid-cols-1 gap-4">
                ${question.answers.map(answer => `
                    <label class="flex items-center bg-white p-4 border-2 border-gray-300 rounded-lg cursor-pointer transition duration-200 hover:border-primary">
                        <input type="radio" name="answers[${question.id}]" value="${answer.id}" class="mr-2">
                        <span class="text-gray-700">${answer.content}</span>
                    </label>
                `).join('')}
            </div>
        `;
        questionContainer.innerHTML = questionHtml;

        prevButton.disabled = currentQuestionIndex === 0;
        nextButton.disabled = currentQuestionIndex === questions.length - 1;
        progressBar.style.width = `${((currentQuestionIndex + 1) / questions.length) * 100}%`;

        clearInterval(timer);
        startTimer();

        if (currentQuestionIndex === questions.length - 1) {
            nextButton.classList.add('hidden');
            submitContainer.classList.remove('hidden');
        } else {
            nextButton.classList.remove('hidden');
            submitContainer.classList.add('hidden');
        }
    }

    function showNextQuestion() {
        if (currentQuestionIndex < questions.length - 1) {
            currentQuestionIndex++;
            showQuestion();
        }
    }

    function showPreviousQuestion() {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            showQuestion();
        }
    }

    showQuestion();
</script>