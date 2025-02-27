<?php

namespace Database\Seeders;
use App\Models\Question;
use App\Models\Answer;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'question' => 'Si 2x + 5 = 11, quelle est la valeur de 4x + 10 ?',
                'points' => 1,
                'answers' => [
                    ['content' => '15', 'is_correct' => false],
                    ['content' => '20', 'is_correct' => false],
                    ['content' => '22', 'is_correct' => true],
                    ['content' => '26', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Quelle est la prochaine valeur dans la suite : 1, 4, 9, 16, 25, ... ?',
                'points' => 2,
                'answers' => [
                    ['content' => '30', 'is_correct' => false],
                    ['content' => '34', 'is_correct' => false],
                    ['content' => '36', 'is_correct' => true],
                    ['content' => '38', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Si un gâteau coûte 1/3 de son prix plus 2 dirhams, quel est le prix du gâteau ?',
                'points' => 1,
                'answers' => [
                    ['content' => '2 dirhams', 'is_correct' => false],
                    ['content' => '3 dirhams', 'is_correct' => true],
                    ['content' => '4 dirhams', 'is_correct' => false],
                    ['content' => '5 dirhams', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Deux nombres ont une somme de 48 et un produit de 432. Quels sont ces deux nombres ?',
                'points' => 3,
                'answers' => [
                    ['content' => '6 et 42', 'is_correct' => false],
                    ['content' => '12 et 36', 'is_correct' => true],
                    ['content' => '18 et 30', 'is_correct' => false],
                    ['content' => '24 et 24', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Si un nombre est divisé par 4, puis 3 est ajouté au quotient, le résultat est 8. Quel est ce nombre ?',
                'points' => 2,
                'answers' => [
                    ['content' => '17', 'is_correct' => false],
                    ['content' => '20', 'is_correct' => true],
                    ['content' => '23', 'is_correct' => false],
                    ['content' => '26', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Quel est le nombre manquant dans cette suite : 2, 5, 11, 23, 47, __, 191 ?',
                'points' => 3,
                'answers' => [
                    ['content' => '63', 'is_correct' => false],
                    ['content' => '79', 'is_correct' => false],
                    ['content' => '95', 'is_correct' => true],
                    ['content' => '111', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'La somme de trois nombres consécutifs est 87. Quels sont ces nombres ?',
                'points' => 2,
                'answers' => [
                    ['content' => '27, 28, 29', 'is_correct' => false],
                    ['content' => '28, 29, 30', 'is_correct' => true],
                    ['content' => '29, 30, 31', 'is_correct' => false],
                    ['content' => '30, 31, 32', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Si 5x - 3 = 2x + 15, quelle est la valeur de x ?',
                'points' => 1,
                'answers' => [
                    ['content' => '4', 'is_correct' => false],
                    ['content' => '5', 'is_correct' => false],
                    ['content' => '6', 'is_correct' => true],
                    ['content' => '7', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'La somme de deux nombres est 56 et leur différence est 24. Quels sont ces deux nombres ?',
                'points' => 3,
                'answers' => [
                    ['content' => '16 et 40', 'is_correct' => true],
                    ['content' => '18 et 38', 'is_correct' => false],
                    ['content' => '20 et 36', 'is_correct' => false],
                    ['content' => '22 et 34', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Un nombre est 5 de moins que le triple d\'un autre nombre. La somme de ces deux nombres est 23. Quels sont ces deux nombres ?',
                'points' => 3,
                'answers' => [
                    ['content' => '4 et 19', 'is_correct' => false],
                    ['content' => '5 et 18', 'is_correct' => false],
                    ['content' => '6 et 17', 'is_correct' => false],
                    ['content' => '7 et 16', 'is_correct' => true],
                ],
            ],
            [
                'question' => 'Quel est le résultat de 15 × (8 - 3) ÷ 5 ?',
                'points' => 1,
                'answers' => [
                    ['content' => '15', 'is_correct' => true],
                    ['content' => '18', 'is_correct' => false],
                    ['content' => '12', 'is_correct' => false],
                    ['content' => '20', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Un triangle a un périmètre de 24 cm. Si deux de ses côtés mesurent 7 cm et 9 cm, quelle est la longueur du troisième côté ?',
                'points' => 2,
                'answers' => [
                    ['content' => '6 cm', 'is_correct' => false],
                    ['content' => '8 cm', 'is_correct' => true],
                    ['content' => '10 cm', 'is_correct' => false],
                    ['content' => '12 cm', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Si 3x + 2 = 14, quelle est la valeur de x ?',
                'points' => 1,
                'answers' => [
                    ['content' => '3', 'is_correct' => false],
                    ['content' => '4', 'is_correct' => true],
                    ['content' => '5', 'is_correct' => false],
                    ['content' => '6', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Combien de fois 5 peut-il être soustrait de 100 avant d\'obtenir zéro ?',
                'points' => 1,
                'answers' => [
                    ['content' => '15', 'is_correct' => false],
                    ['content' => '20', 'is_correct' => true],
                    ['content' => '25', 'is_correct' => false],
                    ['content' => '30', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Un rectangle a une longueur de 12 cm et une largeur de 5 cm. Quel est son périmètre ?',
                'points' => 1,
                'answers' => [
                    ['content' => '24 cm', 'is_correct' => false],
                    ['content' => '34 cm', 'is_correct' => true],
                    ['content' => '44 cm', 'is_correct' => false],
                    ['content' => '54 cm', 'is_correct' => false],
                ],
            ]
        ];
        
        // Seeding logic
        foreach ($data as $questionData) {
            $question = Question::create([
                'content' => $questionData['question'],
                'points' => $questionData['points']
            ]);
        
            foreach ($questionData['answers'] as $answerData) {
                Answer::create([
                    'question_id' => $question->id,
                    'content' => $answerData['content'],
                    'is_correct' => $answerData['is_correct'],
                ]);
            }
        }
}
}