    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4 text-center">Quiz</h1>

        <form id="quiz-form" action="" method="POST">
            @csrf
            @foreach ($questions as $index => $question)
                <div class="mb-6">
                    <p class="font-semibold mb-2">{{ $index + 1 }}. {{ $question->content }}</p>
                    @foreach ($question->answers as $answer)
                        <div class="flex items-center mb-2">
                            <input type="radio" id="answer_{{ $answer->id }}" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" class="mr-2">
                            <label for="answer_{{ $answer->id }}" class="text-gray-700">{{ $answer->content }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <div class="flex justify-center">
                <button type="submit" class="bg-primary hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded transition duration-200">Soumettre</button>
            </div>
        </form>
    </div>

<script>
    // Définir la durée du quiz en minutes
    const quizDuration = 10;

    // Calculer la date et l'heure de fin du quiz
    const endTime = new Date().getTime() + quizDuration * 60000;

    // Mettre à jour le compte à rebours toutes les secondes
    const countdownTimer = setInterval(() => {
        const currentTime = new Date().getTime();
        const remainingTime = endTime - currentTime;

        // Calculer les minutes et secondes restantes
        const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

        // Afficher le compte à rebours dans la vue
        document.getElementById("countdown").innerHTML = `Temps restant: ${minutes}m ${seconds}s`;

        // Si le temps est écoulé, soumettre automatiquement le formulaire
        if (remainingTime < 0) {
            clearInterval(countdownTimer);
            document.getElementById("quiz-form").submit();
        }
    }, 1000);
</script>