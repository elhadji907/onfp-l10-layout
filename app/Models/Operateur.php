<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Operateur
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $numero_agrement
 * @property string|null $name
 * @property string|null $sigle
 * @property string|null $typestructure
 * @property Carbon|null $date_depot
 * @property Carbon|null $annee_agrement
 * @property Carbon|null $date
 * @property Carbon|null $date_debut
 * @property Carbon|null $date_fin
 * @property Carbon|null $date_renew
 * @property string|null $ninea
 * @property string|null $rccm
 * @property string|null $quitus
 * @property Carbon|null $debut_quitus
 * @property Carbon|null $fin_quitus
 * @property string|null $telephone1
 * @property string|null $telephone2
 * @property string|null $fixe
 * @property string|null $email1
 * @property string|null $email2
 * @property string|null $adresse
 * @property string|null $nom_responsable
 * @property string|null $prenom_responsable
 * @property string|null $cin_responsable
 * @property string|null $telephone_responsable
 * @property string|null $email_responsable
 * @property string|null $fonction_responsable
 * @property string|null $operateur_type
 * @property string|null $statut
 * @property string|null $qualification
 * @property int|null $users_id
 * @property int|null $rccms_id
 * @property int|null $nineas_id
 * @property int|null $types_operateurs_id
 * @property int|null $specialites_id
 * @property int|null $courriers_id
 * @property int|null $communes_id
 * @property string|null $file1
 * @property string|null $file2
 * @property string|null $file3
 * @property string|null $file4
 * @property string|null $file5
 * @property string|null $file6
 * @property string|null $file7
 * @property string|null $file8
 * @property string|null $file9
 * @property string|null $file10
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Commune|null $commune
 * @property Courrier|null $courrier
 * @property Specialite|null $specialite
 * @property TypesOperateur|null $types_operateur
 * @property User|null $user
 * @property Collection|Agrement[] $agrements
 * @property Collection|Commentere[] $commenteres
 * @property Collection|Formation[] $formations
 * @property Collection|Module[] $modules
 * @property Collection|Niveaux[] $niveauxes
 * @property Collection|Region[] $regions
 * @property Collection|Traitement[] $traitements
 *
 * @package App\Models
 */
class Operateur extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'operateurs';

	protected $casts = [
		'users_id' => 'int',
		'rccms_id' => 'int',
		'nineas_id' => 'int',
		'types_operateurs_id' => 'int',
		'specialites_id' => 'int',
		'courriers_id' => 'int',
		'communes_id' => 'int'
	];

	protected $dates = [
		'date_depot',
		'annee_agrement',
		'date',
		'date_debut',
		'date_fin',
		'date_renew',
		'debut_quitus',
		'fin_quitus'
	];

	protected $fillable = [
		'uuid',
		'numero_agrement',
		'name',
		'sigle',
		'typestructure',
		'date_depot',
		'annee_agrement',
		'date',
		'date_debut',
		'date_fin',
		'date_renew',
		'ninea',
		'rccm',
		'quitus',
		'debut_quitus',
		'fin_quitus',
		'telephone1',
		'telephone2',
		'fixe',
		'email1',
		'email2',
		'adresse',
		'nom_responsable',
		'prenom_responsable',
		'cin_responsable',
		'telephone_responsable',
		'email_responsable',
		'fonction_responsable',
		'operateur_type',
		'statut',
		'qualification',
		'users_id',
		'rccms_id',
		'nineas_id',
		'types_operateurs_id',
		'specialites_id',
		'courriers_id',
		'communes_id',
		'file1',
		'file2',
		'file3',
		'file4',
		'file5',
		'file6',
		'file7',
		'file8',
		'file9',
		'file10'
	];

	public function commune()
	{
		return $this->belongsTo(Commune::class, 'communes_id');
	}

	public function courrier()
	{
		return $this->belongsTo(Courrier::class, 'courriers_id');
	}

	public function ninea()
	{
		return $this->belongsTo(Ninea::class, 'nineas_id');
	}

	public function rccm()
	{
		return $this->belongsTo(Rccm::class, 'rccms_id');
	}

	public function specialite()
	{
		return $this->belongsTo(Specialite::class, 'specialites_id');
	}

	public function types_operateur()
	{
		return $this->belongsTo(TypesOperateur::class, 'types_operateurs_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}

	public function agrements()
	{
		return $this->hasMany(Agrement::class, 'operateurs_id');
	}

	public function commenteres()
	{
		return $this->hasMany(Commentere::class, 'operateurs_id');
	}

	public function formations()
	{
		return $this->hasMany(Formation::class, 'operateurs_id');
	}

	public function modules()
	{
		return $this->belongsToMany(Module::class, 'modulesoperateurs', 'operateurs_id', 'modules_id')
					->withPivot('id', 'moduleoperateurstatut_id', 'specialites', 'deleted_at')
					->withTimestamps();
	}

	public function niveauxes()
	{
		return $this->belongsToMany(Niveaux::class, 'operateursniveaux', 'operateurs_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function regions()
	{
		return $this->belongsToMany(Region::class, 'operateursregions', 'operateurs_id', 'regions_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function traitements()
	{
		return $this->hasMany(Traitement::class, 'operateurs_id');
	}
}
