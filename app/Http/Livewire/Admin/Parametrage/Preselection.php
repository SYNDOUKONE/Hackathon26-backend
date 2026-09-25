<?php

namespace App\Http\Livewire\Admin\Parametrage;

use App\Models\Qsession;
use App\Models\Qvideo;
use Livewire\Component;

use App\Models\Niveau;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QsessionResponse;
use App\Models\Response;

use Livewire\WithPagination;


class Preselection extends Component
{

    use WithPagination;

    public $niveau = 1;
    public $track = null;
    public $newQuestion;
    public $newResponseC;
    public $newResponseS;
    public $editModeR = false;
    public $editModeQ = false;
    public $resp_id;
    public $que_id;
    public $quiz_score;
    public $quiz_duration;

    public function render()
    {
        $quiz = null;
        if ($this->track) {
            $quiz = Quiz::where('niveau_id', $this->niveau)->where('title', $this->track)->first();
        } else {
            $quiz = Quiz::where('niveau_id', $this->niveau)->first();
        }

        $qvideo = Qvideo::where('niveau_id', $this->niveau)->first();
        $niveau = Niveau::find($this->niveau);

        $questions = [];
        $sessions = [];
        if ($quiz) {
            $questions = Question::where('quiz_id', $quiz->id)->orderBy('created_at', 'desc')->get();
            $sessions = Qsession::with('equipe')
                ->where('quiz_id', $quiz->id)
                ->orderBy('score', 'desc')
                ->get();
        }

        return view('livewire.admin.parametrage.preselection', [
            'quiz' => $quiz,
            'qvideo' => $qvideo,
            '_niveau' => $niveau,
            'quizzes' => Quiz::where('niveau_id', $this->niveau)->get(),
            'questions' => $questions,
            'niveaux' => Niveau::all(),
            'sessions' => $sessions
        ]);
    }

    public function updateQuiz($qid)
    {
        $qi = Quiz::find($qid);

        $qi->score = $this->quiz_score;
        $qi->duration_per_question = $this->quiz_duration;
        $qi->save();

        $this->resetVars();
    }

    public function storeNewQuestion()
    {
        $quiz = Quiz::where('niveau_id', $this->niveau)->first();

        if (!$quiz) {
            // Création automatique du quiz si aucun n'existe pour ce niveau
            $quiz = Quiz::create([
                'niveau_id' => $this->niveau,
                'title' => 'Quiz Niveau ' . $this->niveau,
                'score' => 0,
                'state' => 1
            ]);
        }

        Question::create([
            'content' => $this->newQuestion,
            'quiz_id' => $quiz->id,
        ]);

        $this->resetVars();
    }

    public function editQuestion($qid)
    {
        $que = Question::find($qid);

        $this->newQuestion = $que->content;
        $this->editModeQ = true;
        $this->que_id = $qid;
    }

    public function updateQuestion()
    {
        $que = Question::find($this->que_id);
        $que->content = $this->newQuestion;
        $que->save();

        $this->resetVars();
    }

    public function deleteQuestion($qid)
    {

        $que = Question::find($qid);
        $que->delete();
    }

    public function storeNewResponse($qid)
    {
        $r = Response::create([
            'content' => $this->newResponseC[$qid],
            'score' => $this->newResponseS[$qid],
            'question_id' => $qid
        ]);

        $quiz = null;
        if ($this->track) {
            $quiz = Quiz::where('niveau_id', $this->niveau)->where('title', $this->track)->first();
        } else {
            $quiz = Quiz::where('niveau_id', $this->niveau)->first();
        }

        if ($quiz && $quiz->qsessions) {
            foreach ($quiz->qsessions as $qs) {
                QsessionResponse::create([
                    'score' => $r->score,
                    'state' => 0,
                    'qsession_id' => $qs->id,
                    'response_id' => $r->id,
                    'question_id' => $r->question_id
                ]);
            }
        }

        $this->resetVars();
    }

    public function editResponse($qid, $rid)
    {
        $res = Response::find($rid);

        $this->newResponseC[$qid] = $res->content;
        $this->newResponseS[$qid] = $res->score;
        $this->resp_id = $rid;
        $this->editModeR = true;
    }

    public function updateResponse($qid)
    {
        $res = Response::find($this->resp_id);
        $res->content = $this->newResponseC[$qid];
        $res->score = $this->newResponseS[$qid];
        $res->save();

        $quiz = null;
        if ($this->track) {
            $quiz = Quiz::where('niveau_id', $this->niveau)->where('title', $this->track)->first();
        } else {
            $quiz = Quiz::where('niveau_id', $this->niveau)->first();
        }

        if ($quiz && $quiz->qsessions) {
            foreach ($quiz->qsessions as $qs) {
                $qsres = QsessionResponse::where('qsession_id', $qs->id)->where('response_id', $this->resp_id)->where('question_id', $res->question_id)->first();
                if ($qsres) {
                    $qsres->score = $res->score;
                    $qsres->save();
                }
            }
        }

        $this->resetVars();
    }

    public function deleteResponse($rid)
    {
        $res = Response::find($rid);
        $res->delete();
    }

    public function openCloseQuiz($qid)
    {
        $q = Quiz::find($qid);

        if ($q->state == 1)
            $q->state = 0;
        else
            $q->state = 1;

        $q->save();
    }

    public function openCloseQvideo($qid)
    {
        $q = Qvideo::find($qid);

        if ($q->state == 1)
            $q->state = 0;
        else
            $q->state = 1;

        $q->save();
    }

    public function resetVars()
    {
        // $this->niveau = 1;
        $this->newQuestion = "";
        $this->newResponseC = [];
        $this->newResponseS = [];
        $this->editModeR = false;
        $this->editModeQ = false;
        $this->resp_id = 0;
        $this->quiz_score = "";
        $this->quiz_duration = "";
    }
}
