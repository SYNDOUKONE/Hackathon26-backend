<?php

namespace App\Http\Livewire\Participants;

use Livewire\Component;
use App\Models\Equipe;
use App\Models\Etudiant;
use App\Models\Participant;
use App\Models\Question;
use App\Models\Response;
use App\Models\Qsession;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class PreselectionQuiz extends Component
{
    public $equipe;
    public $questions = [];
    public $currentQuestionIndex = 0;
    public $userResponses = [];
    public $isSubmitted = false;
    public $isQuizOpen = false;
    public $finalScore = 0;
    public $totalScore = 0;

    public function mount()
    {
        $user = Auth::user();
        $etudiant = Etudiant::where('user_id', $user->id)->first();
        $this->equipe = Equipe::whereHas('participants', function($q) use ($etudiant) {
            $q->where('etudiant_id', $etudiant->id)->where('chef', true);
        })->first();

        if (!$this->equipe) {
            session()->flash('error', 'Seul le chef d\'équipe peut lancer le quiz.');
            return redirect()->route('dashboard');
        }

        $quiz = Quiz::where('niveau_id', $this->equipe->niveau_id)->first();
        if (!$quiz) {
            session()->flash('error', 'Aucun quiz disponible pour votre niveau.');
            return redirect()->route('dashboard');
        }

        $this->questions = Question::where('quiz_id', $quiz->id)->with('responses')->get();
        $this->totalScore = $quiz->score;
        $this->isQuizOpen = ($quiz->state == 1);

        // Vérifier si le quiz a déjà été passé
        $session = Qsession::where('equipe_id', $this->equipe->id)->first();
        if ($session && $session->state == 1) {
            $this->isSubmitted = true;
            $this->finalScore = $session->score;
        }
    }

    public function selectResponse($questionId, $responseId)
    {
        $this->userResponses[$questionId] = $responseId;
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
        }
    }

    public function prevQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }

    public function submitQuiz()
    {
        if (!$this->isQuizOpen) {
            session()->flash('error', 'Le quiz est actuellement fermé.');
            return;
        }
        if ($this->isSubmitted) return;

        $score = 0;
        foreach ($this->userResponses as $questionId => $responseId) {
            $res = Response::find($responseId);
            if ($res) {
                $score += $res->score;
            }
        }

        $session = Qsession::where('equipe_id', $this->equipe->id)->first();
        if (!$session) {
            $session = new Qsession();
            $session->equipe_id = $this->equipe->id;
            $session->quiz_id = $this->questions[0]->quiz_id;
        }

        $session->score = $score;
        $session->state = 1;
        $session->save();

        $this->finalScore = $score;
        $this->isSubmitted = true;

        session()->flash('success', 'Quiz soumis avec succès !');
    }

    public function render()
    {
        return view('livewire.participants.preselection-quiz');
    }
}
