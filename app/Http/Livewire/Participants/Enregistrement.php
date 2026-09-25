<?php

namespace App\Http\Livewire\Participants;

use App\Models\Classe;
use App\Models\Equipe;
use App\Models\Etudiant;
use App\Models\Hackaton;
use App\Models\Matricule;
use App\Models\Niveau;
use App\Models\Participant;
use App\Models\User;
use App\Models\Qsession;
use App\Models\Quiz;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Enregistrement extends Component
{
    // variables de groupe

    public $niveau = 0;
    public $nom_groupe;
    public $photo_groupe;

    public $esatic = 1;

    // variables relative au chef

    public $matricule_chef;
    public $nom_chef;
    public $prenom_chef;
    public $classe_chef = "c";
    public $email_chef;
    public $genre_chef = "g";


    // variables relatives au membre 2

    public $matricule_m2;
    public $nom_m2;
    public $prenom_m2;
    public $classe_m2 = "c";
    public $email_m2;
    public $genre_m2 = "g";
    // variables relatives au membre 3

    public $matricule_m3;
    public $nom_m3;
    public $prenom_m3;
    public $classe_m3 = "c";
    public $email_m3;
    public $genre_m3 = "g";

    public $errorEmail = false;
    public $errorMatricule = false;


    public function render()
    {
        return view('livewire.participants.enregistrement', [
            'niveaux' => Niveau::all(),
            'classes' => Classe::where('niveau_id', $this->niveau)->where('esatic', $this->esatic)->get()
        ]);
    }

    public function VerifEmail()
    {
        if (
            $this->email_chef == $this->email_m2 or
            $this->email_chef == $this->email_m3 or
            $this->email_m2 == $this->email_m3
        ) {
            $this->errorEmail = true;
        }
    }

    public function matInDb($mat){

        $mindb = Matricule::where('matricule', $mat)->first();
        if($mindb){
            if($mindb->state == 1){
                return true;
            }
            return false;
        }
    }

    public function VerifMatricule()
    {
        if (
            $this->matricule_chef == $this->matricule_m2 or
            $this->matricule_chef == $this->matricule_m3 or
            $this->matricule_m2 == $this->matricule_m3
        ) {
            $this->errorMatricule = true;
        }
    }

  
    public function getRandomInt($n)
    {
        $characters = '0123456789';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public function getRandomString($n)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }


    public function setMAtricule()
    {
        if ($this->esatic == 0) {
            $this->matricule_chef = $this->getRandomInt(2) . "-" . $this->classe_chef . $this->getRandomInt(4) . $this->getRandomString(2);
            $this->matricule_m2 = $this->getRandomInt(2) . "-" . $this->classe_m2 . $this->getRandomInt(4) . $this->getRandomString(2);
            $this->matricule_m3 = $this->getRandomInt(2) . "-" . $this->classe_m3 . $this->getRandomInt(4) . $this->getRandomString(2);
        }
    }

    public function resetInput()
    {
        $this->niveau = "1";
        $this->nom_groupe = "";
        $this->photo_groupe  = "";

        // variables relative au chef

        $this->matricule_chef = "";
        $this->nom_chef = "";
        $this->prenom_chef = "";
        $this->classe_chef = "c";
        $this->email_chef = "";

        $this->genre_chef = "g";
        $this->genre_m3 = "g";
        $this->genre_m2 = "g";


        // variables relatives au membre 2

        $this->matricule_m2 = "";
        $this->nom_m2 = "";
        $this->prenom_m2 = "";
        $this->classe_m2 = "c";
        $this->email_m2 = "";

        // variables relatives au membre 3

        $this->matricule_m3 = "";
        $this->nom_m3 = "";
        $this->prenom_m3 = "";
        $this->classe_m3 = "c";
        $this->email_m3 = "";
    }

    public function createEquipe()
    {
        $this->setMAtricule();

        $validate = $this->validate([
            'niveau' => 'required',
            'nom_groupe' => 'required',

            'nom_chef' => 'required',
            'prenom_chef' => 'required',
            'classe_chef' => 'required',
            'email_chef' => 'required|email|unique:users,email',
            'genre_chef' => 'required',
        ]);

        $this->errorEmail = false;
        // No longer checking against m2/m3 since they are handled in GestionEquipe

        try {
            \DB::beginTransaction();

            $hackaton = Hackaton::where('inscription', 1)->first();
            if (!$hackaton) {
                throw new \Exception('Aucun hackathon actif trouvé pour les inscriptions.');
            }

            $equipe = Equipe::create([
                'nom' => $this->nom_groupe,
                'logo' => $this->photo_groupe,
                'niveau_id' => $this->niveau,
                'hackaton_id' => $hackaton->id
            ]);

            if (Niveau::find($this->niveau)->quiz_available == 1) {
                Qsession::create([
                    'quiz_id' => Quiz::where('niveau_id', $this->niveau)->first()->id,
                    'equipe_id' => $equipe->id
                ]);
            }

            $user = User::create([
                'name' => trim($this->matricule_chef),
                'email' => $this->email_chef,
                'password' => Hash::make("sdi23@TH12345")
            ]);

            $etudiant = Etudiant::create([
                'nom' => $this->nom_chef,
                'prenom' => $this->prenom_chef,
                'matricule' => trim($this->matricule_chef),
                'genre' => $this->genre_chef,
                'classe' => $this->esatic == 1 ? (Classe::find($this->classe_chef)->libelle ?? $this->classe_chef) : $this->classe_chef,
                'user_id' => $user->id
            ]);

            Participant::create([
                'chef' => true,
                'etudiant_id' => $etudiant->id,
                'equipe_id' => $equipe->id,
                'hackaton_id' => $hackaton->id
            ]);

            \DB::commit();

            // Store password in session to display it on the finish page
            session([
                'registered_email' => $user->email,
                'registered_password' => "sdi23@TH12345",
                'registered_nom' => $this->nom_chef
            ]);

            return redirect()->to('/inscription-terminer');

        } catch (\Exception $e) {
            \DB::rollBack();
            session()->flash('error', 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage());
        }
    }
}
