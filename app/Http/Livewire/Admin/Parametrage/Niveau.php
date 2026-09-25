<?php

namespace App\Http\Livewire\Admin\Parametrage;

use App\Models\Classe;
use App\Models\Niveau as ModelsNiveau;
use Livewire\Component;

use Livewire\WithPagination;

class Niveau extends Component
{

    use WithPagination;

    public $libelle ;
    public $niveau_id ;
    public $edit_mode = false ;
    public $classe_id ;

    // Niveau management
    public $niv_libelle;
    public $niv_id;
    public $niv_edit_mode = false;


    public function render()
    {
        return view('livewire.admin.parametrage.niveau',[
            'niveaux' => ModelsNiveau::all(),
            'classes' => Classe::orderBy('created_at', 'DESC')->paginate(6)
        ]);
    }

    public function resetInput()
    {
        $this->libelle = "";
    }

    public function createNiveau()
    {
        $this->validate([
            'niv_libelle' => 'required|min:3'
        ]);

        ModelsNiveau::create([
            'libelle' => $this->niv_libelle
        ]);

        $this->resetNivInput();
    }

    public function editNiveau(int $id)
    {
        $niveau = ModelsNiveau::find($id);
        $this->niv_libelle = $niveau->libelle;
        $this->niv_id = $niveau->id;
        $this->niv_edit_mode = true;
    }

    public function updateNiveau(int $id)
    {
        $this->validate([
            'niv_libelle' => 'required|min:3'
        ]);

        $niveau = ModelsNiveau::find($id);
        $niveau->update([
            'libelle' => $this->niv_libelle
        ]);

        $this->resetNivInput();
        $this->niv_edit_mode = false;
    }

    public function deleteNiveau(int $id)
    {
        $niveau = ModelsNiveau::find($id);
        $niveau->delete();
    }

    public function resetNivInput()
    {
        $this->niv_libelle = "";
        $this->niv_id = null;
    }

    public function createClasse()
    {
        $this->validate([
            'libelle' => 'required|min:4',
            'niveau_id' => 'required'
        ]);

        Classe::create([
            'libelle' => $this->libelle,
            'niveau_id' => $this->niveau_id
        ]);

        $this->resetInput();
    }

    public function editClasse(int $id)
    {
        $classe = Classe::find($id);


        $this->libelle = $classe->libelle ;
        $this->niveau_id = $classe->niveau->id ;
        $this->classe_id =  $classe->id ;
        $this->edit_mode = true ;
        
    }

    public function updateClasse(int $id)
    {
        $classe = Classe::find($id);

        $this->validate([
            'libelle' => 'required|min:4',
            'niveau_id' => 'required'
        ]);

        $classe->update([
            'libelle' => $this->libelle,
            'niveau_id' => $this->niveau_id
        ]);

        $this->resetInput();
        $this->edit_mode = false ;
    }

    public function deleteClasse(int $id)
    {
        if($id)
       {
           
           $classe = Classe::find($id);
           $classe->delete();
           //session()->flash('warning', 'Suppression éffectué avec succès.');
       }
        
    }




    
}
