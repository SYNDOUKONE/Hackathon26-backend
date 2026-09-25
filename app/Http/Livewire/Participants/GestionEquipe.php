<?php

namespace App\Http\Livewire\Participants;

use Livewire\Component;
use App\Models\Equipe;
use App\Models\Etudiant;
use App\Models\Participant;
use App\Models\User;
use App\Models\Classe;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class GestionEquipe extends Component
{
    public $nom_membre;
    public $prenom_membre;
    public $matricule_membre;
    public $email_membre;
    public $classe_membre;
    public $genre_membre = 'g';

    public function render()
    {
        $user = Auth::user();

        // Correction for the specific model structure of this project
        $etudiant = Etudiant::where('user_id', $user->id)->first();
        if (!$etudiant) {
            return view('livewire.participants.gestion-equipe', [
                'equipe' => null,
                'membres' => [],
                'classes' => Classe::all(),
            ]);
        }

        $equipe = Equipe::whereHas('participants', function($q) use ($etudiant) {
            $q->where('etudiant_id', $etudiant->id);
        })->first();

        return view('livewire.participants.gestion-equipe', [
            'equipe' => $equipe,
            'membres' => $equipe ? Participant::where('equipe_id', $equipe->id)->with('etudiant')->get() : [],
            'classes' => Classe::all(),
        ]);
    }

    public function addMembre()
    {
        $user = Auth::user();
        $etudiant = Etudiant::where('user_id', $user->id)->first();
        $equipe = Equipe::whereHas('participants', function($q) use ($etudiant) {
            $q->where('etudiant_id', $etudiant->id);
        })->first();

        if (!$equipe) {
            session()->flash('error', 'Vous n\'êtes pas membre d\'une équipe.');
            return;
        }

        if ($equipe->participants()->count() >= 3) {
            session()->flash('error', 'Une équipe ne peut pas dépasser 3 membres.');
            return;
        }

        $this->validate([
            'nom_membre' => 'required',
            'prenom_membre' => 'required',
            'email_membre' => 'required|email|unique:users,email',
            'classe_membre' => 'required',
            'genre_membre' => 'required',
        ]);

        try {
            \DB::beginTransaction();

            $newUser = User::create([
                'name' => trim($this->nom_membre),
                'email' => $this->email_membre,
                'password' => Hash::make("sdi23@TH12345"),
            ]);

            // Generate matricule automatically for new members
            $matricule_auto = "MEM-" . rand(1000, 9999) . "-" . strtoupper(substr($this->email_membre, 0, 3));

            $newEtudiant = Etudiant::create([
                'nom' => $this->nom_membre,
                'prenom' => $this->prenom_membre,
                'matricule' => $matricule_auto,
                'genre' => $this->genre_membre,
                'classe' => $this->classe_membre,
                'user_id' => $newUser->id,
            ]);

            Participant::create([
                'chef' => false,
                'etudiant_id' => $newEtudiant->id,
                'equipe_id' => $equipe->id,
                'hackaton_id' => $equipe->hackaton_id,
            ]);

            \DB::commit();
            $this->reset(['nom_membre', 'prenom_membre', 'email_membre', 'classe_membre']);
            session()->flash('success', 'Membre ajouté avec succès !');

        } catch (\Exception $e) {
            \DB::rollBack();
            session()->flash('error', 'Erreur lors de l\'ajout : ' . $e->getMessage());
        }
    }

    public function removeMembre($participantId)
    {
        $user = Auth::user();
        $etudiant = Etudiant::where('user_id', $user->id)->first();
        $equipe = Equipe::whereHas('participants', function($q) use ($etudiant) {
            $q->where('etudiant_id', $etudiant->id);
        })->first();

        $participant = Participant::find($participantId);

        if (!$participant || $participant->chef) {
            session()->flash('error', 'Vous ne pouvez pas supprimer le chef d\'équipe.');
            return;
        }

        if ($participant->equipe_id != $equipe->id) {
            session()->flash('error', 'Action non autorisée.');
            return;
        }

        try {
            // On supprime le lien participant, mais on garde l'utilisateur et l'étudiant pour l'historique
            $participant->delete();
            session()->flash('success', 'Membre retiré avec succès.');
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
}
