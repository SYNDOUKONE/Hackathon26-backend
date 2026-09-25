<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Niveau;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Response;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $niveauxData = [
            'Débutant',
            'Intermédiaire',
            'Avancé'
        ];

        $questionsData = [
            'Débutant' => [
                [
                    'q' => 'Que signifie HTML ?',
                    'r' => ['HyperText Markup Language', 'High Text Markup Language', 'Hyperlinks and Text Markup Language', 'Home Tool Markup Language'],
                    'correct' => 0
                ],
                [
                    'q' => 'Quel langage est utilisé pour styliser une page web ?',
                    'r' => ['HTML', 'CSS', 'JavaScript', 'PHP'],
                    'correct' => 1
                ],
                [
                    'q' => 'Que signifie CSS ?',
                    'r' => ['Creative Style Sheets', 'Cascading Style Sheets', 'Colorful Style Sheets', 'Computer Style Sheets'],
                    'correct' => 1
                ],
                [
                    'q' => 'Quelle balise HTML est utilisée pour créer un lien hypertexte ?',
                    'r' => ['<link>', '<a>', '<href>', '<ul>'],
                    'correct' => 1
                ],
                [
                    'q' => 'Lequel de ces éléments est une balise de titre en HTML ?',
                    'r' => ['<p>', '<div>', '<h1>', '<span>'],
                    'correct' => 2
                ],
                [
                    'q' => 'Que signifie JS ?',
                    'r' => ['JavaSource', 'JavaScript', 'JustScript', 'JointScript'],
                    'correct' => 1
                ],
                [
                    'q' => 'Quelle balise est utilisée pour insérer une image ?',
                    'r' => ['<picture>', '<src>', '<img>', '<image>'],
                    'correct' => 2
                ],
                [
                    'q' => 'Lequel de ces attributs est utilisé pour spécifier la destination d\'un lien ?',
                    'r' => ['src', 'href', 'link', 'dest'],
                    'correct' => 1
                ],
                [
                    'q' => 'Quel symbole est utilisé pour désigner un ID en CSS ?',
                    'r' => '.', '#', '*', '&', '@'],
                    'correct' => 1
                ],
                [
                    'q' => 'Quel symbole est utilisé pour désigner une classe en CSS ?',
                    'r' => '#', '.', '$', '%', '@'],
                    'correct' => 1
                ],
            ],
            'Intermédiaire' => [
                [
                    'q' => 'Qu\'est-ce qu\'une API REST ?',
                    'r' => ['Un protocole de transfert de fichiers', 'Une architecture pour les services web', 'Un langage de programmation', 'Un type de base de données'],
                    'correct' => 1
                ],
                [
                    'q' => 'En JavaScript, quelle méthode permet d\'ajouter un élément à la fin d\'un tableau ?',
                    'r' => ['shift()', 'pop()', 'push()', 'unshift()'],
                    'correct' => 2
                ],
                [
                    'q' => 'Qu\'est-ce que le DOM (Document Object Model) ?',
                    'r' => ['Un logiciel de design', 'Une interface de programmation pour les documents HTML/XML', 'Une base de données NoSQL', 'Un framework CSS'],
                    'correct' => 1
                ],
                [
                    'q' => 'Quel mot-clé JavaScript est utilisé pour déclarer une variable dont la valeur ne peut pas être modifiée ?',
                    'r' => ['let', 'var', 'const', 'static'],
                    'correct' => 2
                ],
                [
                    'q' => 'Qu\'est-ce que le "Responsive Design" ?',
                    'r' => ['Un design qui change de couleur', 'Un design qui s\'adapte à la taille de l\'écran', 'Un design très rapide', 'Un design minimaliste'],
                    'correct' => 1
                ],
                [
                    'q' => 'Quel est le rôle du fichier .htaccess dans un serveur Apache ?',
                    'r' => ['Stocker les images', 'Gérer la configuration du répertoire', 'Compiler le code PHP', 'Écrire des requêtes SQL'],
                    'correct' => 1
                ],
                [
                    'q' => 'Qu\'est-ce que le JSON ?',
                    'r' => ['Java Standard Object Notation', 'JavaScript Object Notation', 'Joint System Object Notation', 'JavaScript Online Notation'],
                    'correct' => 1
                ],
                [
                    'q' => 'En CSS, que fait la propriété "position: absolute" ?',
                    'r' => ['Place l\'élément par rapport au parent positionné', 'Place l\'élément au centre de la page', 'Fige l\'élément lors du scroll', 'Cache l\'élément'],
                    'correct' => 0
                ],
                [
                    'q' => 'Quel est l\'avantage principal d\'un framework comme React ou Vue.js ?',
                    'r' => ['Rendre le site plus lent', 'Permettre la création de composants réutilisables', 'Remplacer le HTML', 'Éviter d\'utiliser CSS'],
                    'correct' => 1
                ],
                [
                    'q' => 'Qu\'est-ce qu\'une promesse (Promise) en JavaScript ?',
                    'r' => ['Une fonction qui ne s\'exécute jamais', 'Un objet représentant la réussite ou l\'échec futur d\'une opération asynchrone', 'Une variable globale', 'Une boucle infinie'],
                    'correct' => 1
                ],
            ],
            'Avancé' => [
                [
                    'q' => 'Qu\'est-ce que le "Closure" en JavaScript ?',
                    'r' => ['Une méthode pour fermer le navigateur', 'Une fonction qui accède aux variables de son scope parent même après l\'exécution de ce dernier', 'Une boucle qui s\'arrête', 'Une erreur de syntaxe'],
                    'correct' => 1
                ],
                [
                    'q' => 'Que signifie le terme "Hydration" dans le contexte du Server Side Rendering (SSR) ?',
                    'r' => ['Nettoyer la base de données', 'L\'ajout d\'interactivité client à un HTML rendu par le serveur', 'Compresser les images', 'Mettre à jour le CSS'],
                    'correct' => 1
                ],
                [
                    'q' => 'Qu\'est-ce que le "Virtual DOM" ?',
                    'r' => ['Une copie légère du DOM réel pour optimiser les mises à jour', 'Un DOM qui n\'existe pas', 'Une base de données virtuelle', 'Un simulateur de navigateur'],
                    'correct' => 0
                ],
                [
                    'q' => 'Quel est le but du "Hoisting" en JavaScript ?',
                    'r' => ['L\'élévation des déclarations en haut de leur scope', 'Le chargement rapide des images', 'La compression du code', 'Le typage statique'],
                    'correct' => 0
                ],
                [
                    'q' => 'En PHP, qu\'est-ce qu\'un "Trait" ?',
                    'r' => ['Une interface', 'Un mécanisme de réutilisation de code pour simuler l\'héritage multiple', 'Un type de variable', 'Une classe abstraite'],
                    'correct' => 1
                ],
                [
                    'q' => 'Qu\'est-ce que le "Event Loop" (Boucle d\'événements) en JavaScript ?',
                    'r' => ['Une boucle for classique', 'Le mécanisme qui gère l\'exécution asynchrone et l\'empilement des callbacks', 'Une méthode de tri', 'Un cycle de vie de composant'],
                    'correct' => 1
                ],
                [
                    'q' => 'Quelle est la différence entre "==" et "===" en JavaScript ?',
                    'r' => ['Aucune différence', '"==" compare la valeur, "===" compare la valeur et le type', '"===" compare uniquement le type', 'L\'un est plus rapide que l\'autre'],
                    'correct' => 1
                ],
                [
                    'q' => 'Qu\'est-ce qu\'une "Higher-Order Function" ?',
                    'r' => ['Une fonction avec beaucoup de lignes', 'Une fonction qui prend une autre fonction en argument ou en retourne une', 'Une fonction privée', 'Une fonction récursive'],
                    'correct' => 1
                ],
                [
                    'q' => 'Comment fonctionne le "Debouncing" en JavaScript ?',
                    'r' => ['Il exécute la fonction immédiatement', 'Il limite le nombre d\'appels d\'une fonction sur une période donnée', 'Il accélère le rendu', 'Il supprime les doublons dans un tableau'],
                    'correct' => 1
                ],
                [
                    'q' => 'Qu\'est-ce que le "Cross-Site Scripting" (XSS) ?',
                    'r' => ['Une méthode d\'optimisation CSS', 'Une faille de sécurité permettant d\'injecter des scripts malveillants', 'Un protocole de transfert de données', 'Un framework JS'],
                    'correct' => 1
                ],
            ],
        ];

        foreach ($niveauxData as $nomNiveau) {
            // 1. Créer ou récupérer le niveau
            $niveau = Niveau::firstOrCreate(['nom' => $nomNiveau]);

            // 2. Créer un Quiz pour ce niveau
            $quiz = Quiz::create([
                'title' => 'Quiz Développement Web - ' . $nomNiveau,
                'score' => 0,
                'state' => 1, // Ouvert
                'niveau_id' => $niveau->id,
            ]);

            // 3. Ajouter les 10 questions
            if (isset($questionsData[$nomNiveau])) {
                foreach ($questionsData[$nomNiveau] as $qData) {
                    $question = Question::create([
                        'content' => $qData['q'],
                        'quiz_id' => $quiz->id,
                    ]);

                    // 4. Ajouter les réponses
                    foreach ($qData['r'] as $index => $responseContent) {
                        Response::create([
                            'content' => $responseContent,
                            'question_id' => $question->id,
                            'state' => ($index === $qData['correct']), // True pour la bonne réponse
                            'score' => ($index === $qData['correct']) ? 1 : 0,
                        ]);
                    }
                }
            }
        }
    }
}
