<?php

use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Participants\GestionEquipe;
use App\Http\Livewire\Participants\PreselectionQuiz;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'App\Http\Controllers\AdminController@welcome')->name('welcome');
Route::get('/test-direct', function() { return "L'infrastructure fonctionne !"; });
Route::get('/inscription-now', 'App\Http\Controllers\AdminController@inscription')->name('Participants.inscription');
Route::get('/test-final-99', 'App\Http\Controllers\AdminController@inscription');

    Route::get('/fin-preselections', 'App\Http\Controllers\AdminController@finPreselection')->name('finPreselection');

    // Gestion d'Équipe et Quiz
    Route::get('/equipe/gestion', GestionEquipe::class)->name('equipe.gestion');
    Route::get('/preselection', PreselectionQuiz::class)->name('preselection');

    Route::post('/dashboard/up', [VideoController::class, 'uploadVideo'])->name('uploadvideo');

    // Administration
    Route::get('/restauration', 'App\Http\Controllers\AdminController@restauration')->name('restauration');
    Route::post('/commander', 'App\Http\Controllers\AdminController@getCommandes')->name('get.commande');

    Route::group(['middleware' => ['auth', 'role:super-admin|Administrateur']], function () {
        Route::get('/admin', function() {
            return redirect()->route('Admin.parametres.index');
        })->name('admin');
        Route::get('/admin/parametres',  'App\Http\Controllers\AdminController@index')->name('Admin.parametres.index');
        Route::get('/admin/groupes',  'App\Http\Controllers\AdminController@selectionGroupe')->name('Admin.groupe.selection');
        Route::get('/admin/groupes/down', [VideoController::class, 'downloadVideo'])->name('Admin.groupe.downloadvideo');
        Route::get('/admin/impression',  'App\Http\Controllers\AdminController@impression')->name('Admin.groupe.impression');
        Route::get('/admin/restauration',  'App\Http\Controllers\AdminController@gestionRestaurant')->name('Admin.restauration');
        Route::get('/admin/etudiants', 'App\Http\Controllers\AdminController@participantAddView')->name('Admin.participantAdd');



        Route::get('/pdf/listeEquipe/niveau1', 'App\Http\Controllers\pdfController@listeEquipeN1')->name('liste.equipe.n1');
        Route::get('/pdf/listeEquipe/niveau2', 'App\Http\Controllers\pdfController@listeEquipeN2')->name('liste.equipe.n2');
        Route::get('/pdf/listeEquipe/niveau3t', 'App\Http\Controllers\pdfController@listeEquipeN3T')->name('liste.equipe.n3t');
        Route::get('/pdf/listeEquipe/niveau3i', 'App\Http\Controllers\pdfController@listeEquipeN3I')->name('liste.equipe.n3i');
        Route::get('/pdf/listeEquipe/niveau3s', 'App\Http\Controllers\pdfController@listeEquipeN3S')->name('liste.equipe.n3s');

        Route::get('/pdf/listeEquipe/selection/niveau1', 'App\Http\Controllers\pdfController@listeselectEquipeN1')->name('liste.equipe.select.n1');
        Route::get('/pdf/listeEquipe/selection/niveau3t', 'App\Http\Controllers\pdfController@listeselectEquipeN3T')->name('liste.equipe.select.n3t');
        Route::get('/pdf/listeEquipe/selection/niveau3i', 'App\Http\Controllers\pdfController@listeselectEquipeN3I')->name('liste.equipe.select.n3i');
        Route::get('/pdf/listeEquipe/selection/niveau3s', 'App\Http\Controllers\pdfController@listeselectEquipeN3S')->name('liste.equipe.select.n3s');

        Route::get('/pdf/repartitions/equipes', 'App\Http\Controllers\pdfController@repartition')->name('pdf.repartition');
        Route::get('/pdf/salles/commandes', 'App\Http\Controllers\pdfController@commandes')->name('pdf.commandes');

        Route::post('/admin/restauration/soumission', 'App\Http\Controllers\AdminController@Soumission')->name('qrcode.Soumission');
        Route::post('/admin/sendMail', 'App\Http\Controllers\AdminController@ContacterLesChefs')->name('selection.sendmail');
    });

    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->hasRole('super-admin') || $user->hasRole('Administrateur') || $user->email === env('ADMIN_EMAIL')) {
            return redirect()->route('Admin.parametres.index');
        }
        return view('dashboard');
    })->name('dashboard');

Route::get('/inscription-terminer', 'App\Http\Controllers\AdminController@inscriptionterminer')->name('terminer');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {});

Route::get('/pdf/listeEquipe/selection/niveau2', 'App\Http\Controllers\pdfController@listeselectEquipeN2')->name('liste.equipe.select.n2');

Route::get('/force-admin-setup', function () {
    $email = 'admin_final@hackathon.com';
    $password = 'password123';

    $user = \App\Models\User::firstOrCreate(
        ['email' => $email],
        ['name' => 'Final Admin', 'password' => bcrypt($password)]
    );

    $user->assignRole('super-admin');
    $user->assignRole('Administrateur');

    return "✅ Admin created successfully! Email: $email, Password: $password";
});

Route::get('/assign-password', 'App\Http\Controllers\PasswordAssignmentController@show')->name('password.assign.show');
Route::post('/assign-password', 'App\Http\Controllers\PasswordAssignmentController@assign')->name('password.assign');
