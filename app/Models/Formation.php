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
 * Class Formation
 * 
 * @property int $id
 * @property string $uuid
 * @property string $code
 * @property string|null $annee
 * @property string|null $name
 * @property string|null $qualifications
 * @property string|null $effectif_total
 * @property Carbon|null $date_pv
 * @property Carbon|null $date_suivi
 * @property Carbon|null $date_debut
 * @property Carbon|null $date_fin
 * @property string|null $adresse
 * @property string|null $titre
 * @property string|null $attestation
 * @property float|null $frais_operateurs
 * @property float|null $frais_add
 * @property float|null $autes_frais
 * @property float|null $frais_total
 * @property string|null $suivi_dossier
 * @property string|null $lieu
 * @property string|null $convention_col
 * @property string|null $decret
 * @property string|null $beneficiaires
 * @property string|null $membres_jury
 * @property string|null $niveau_qualification
 * @property int|null $effectif_prevu
 * @property int|null $prevue_h
 * @property int|null $prevue_f
 * @property int|null $forme_h
 * @property int|null $forme_f
 * @property int|null $total
 * @property string|null $appreciations
 * @property int|null $ingenieurs_id
 * @property int|null $agents_id
 * @property int|null $detfs_id
 * @property int|null $conventions_id
 * @property int|null $programmes_id
 * @property int|null $operateurs_id
 * @property int|null $traitements_id
 * @property int|null $niveauxs_id
 * @property int|null $specialites_id
 * @property int|null $courriers_id
 * @property int|null $statuts_id
 * @property int|null $types_formations_id
 * @property int|null $communes_id
 * @property int|null $antennes_id
 * @property int|null $projets_id
 * @property int|null $choixoperateurs_id
 * @property int|null $modules_id
 * @property int|null $regions_id
 * @property int|null $departements_id
 * @property int|null $arrondissements_id
 * @property int|null $localites_id
 * @property int|null $zones_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Agent|null $agent
 * @property Antenne|null $antenne
 * @property Arrondissement|null $arrondissement
 * @property Choixoperateur|null $choixoperateur
 * @property Commune|null $commune
 * @property Convention|null $convention
 * @property Courrier|null $courrier
 * @property Departement|null $departement
 * @property Detf|null $detf
 * @property Ingenieur|null $ingenieur
 * @property Localite|null $localite
 * @property Module|null $module
 * @property Niveaux|null $niveaux
 * @property Operateur|null $operateur
 * @property Programme|null $programme
 * @property Projet|null $projet
 * @property Region|null $region
 * @property Specialite|null $specialite
 * @property Statut|null $statut
 * @property Traitement|null $traitement
 * @property TypesFormation|null $types_formation
 * @property Zone|null $zone
 * @property Collection|Collective[] $collectives
 * @property Collection|Coment[] $coments
 * @property Collection|Demandeur[] $demandeurs
 * @property Collection|Detail[] $details
 * @property Collection|Employee[] $employees
 * @property Collection|Evaluation[] $evaluations
 * @property Collection|Facture[] $factures
 * @property Collection|Fcollective[] $fcollectives
 * @property Collection|Findividuelle[] $findividuelles
 * @property Collection|Individuelle[] $individuelles
 *
 * @package App\Models
 */
class Formation extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'formations';

	protected $casts = [
		'frais_operateurs' => 'float',
		'frais_add' => 'float',
		'autes_frais' => 'float',
		'frais_total' => 'float',
		'effectif_prevu' => 'int',
		'prevue_h' => 'int',
		'prevue_f' => 'int',
		'forme_h' => 'int',
		'forme_f' => 'int',
		'total' => 'int',
		'ingenieurs_id' => 'int',
		'agents_id' => 'int',
		'detfs_id' => 'int',
		'conventions_id' => 'int',
		'programmes_id' => 'int',
		'operateurs_id' => 'int',
		'traitements_id' => 'int',
		'niveauxs_id' => 'int',
		'specialites_id' => 'int',
		'courriers_id' => 'int',
		'statuts_id' => 'int',
		'types_formations_id' => 'int',
		'communes_id' => 'int',
		'antennes_id' => 'int',
		'projets_id' => 'int',
		'choixoperateurs_id' => 'int',
		'modules_id' => 'int',
		'regions_id' => 'int',
		'departements_id' => 'int',
		'arrondissements_id' => 'int',
		'localites_id' => 'int',
		'zones_id' => 'int'
	];

	protected $dates = [
		'date_pv',
		'date_suivi',
		'date_debut',
		'date_fin'
	];

	protected $fillable = [
		'uuid',
		'code',
		'annee',
		'name',
		'qualifications',
		'effectif_total',
		'date_pv',
		'date_suivi',
		'date_debut',
		'date_fin',
		'adresse',
		'titre',
		'attestation',
		'frais_operateurs',
		'frais_add',
		'autes_frais',
		'frais_total',
		'suivi_dossier',
		'lieu',
		'convention_col',
		'decret',
		'beneficiaires',
		'membres_jury',
		'niveau_qualification',
		'effectif_prevu',
		'prevue_h',
		'prevue_f',
		'forme_h',
		'forme_f',
		'total',
		'appreciations',
		'ingenieurs_id',
		'agents_id',
		'detfs_id',
		'conventions_id',
		'programmes_id',
		'operateurs_id',
		'traitements_id',
		'niveauxs_id',
		'specialites_id',
		'courriers_id',
		'statuts_id',
		'types_formations_id',
		'communes_id',
		'antennes_id',
		'projets_id',
		'choixoperateurs_id',
		'modules_id',
		'regions_id',
		'departements_id',
		'arrondissements_id',
		'localites_id',
		'zones_id'
	];

	public function agent()
	{
		return $this->belongsTo(Agent::class, 'agents_id');
	}

	public function antenne()
	{
		return $this->belongsTo(Antenne::class, 'antennes_id');
	}

	public function arrondissement()
	{
		return $this->belongsTo(Arrondissement::class, 'arrondissements_id');
	}

	public function choixoperateur()
	{
		return $this->belongsTo(Choixoperateur::class, 'choixoperateurs_id');
	}

	public function commune()
	{
		return $this->belongsTo(Commune::class, 'communes_id');
	}

	public function convention()
	{
		return $this->belongsTo(Convention::class, 'conventions_id');
	}

	public function courrier()
	{
		return $this->belongsTo(Courrier::class, 'courriers_id');
	}

	public function departement()
	{
		return $this->belongsTo(Departement::class, 'departements_id');
	}

	public function detf()
	{
		return $this->belongsTo(Detf::class, 'detfs_id');
	}

	public function ingenieur()
	{
		return $this->belongsTo(Ingenieur::class, 'ingenieurs_id');
	}

	public function localite()
	{
		return $this->belongsTo(Localite::class, 'localites_id');
	}

	public function module()
	{
		return $this->belongsTo(Module::class, 'modules_id');
	}

	public function niveaux()
	{
		return $this->belongsTo(Niveaux::class, 'niveauxs_id');
	}

	public function operateur()
	{
		return $this->belongsTo(Operateur::class, 'operateurs_id');
	}

	public function programme()
	{
		return $this->belongsTo(Programme::class, 'programmes_id');
	}

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'projets_id');
	}

	public function region()
	{
		return $this->belongsTo(Region::class, 'regions_id');
	}

	public function specialite()
	{
		return $this->belongsTo(Specialite::class, 'specialites_id');
	}

	public function statut()
	{
		return $this->belongsTo(Statut::class, 'statuts_id');
	}

	public function traitement()
	{
		return $this->belongsTo(Traitement::class, 'traitements_id');
	}

	public function types_formation()
	{
		return $this->belongsTo(TypesFormation::class, 'types_formations_id');
	}

	public function zone()
	{
		return $this->belongsTo(Zone::class, 'zones_id');
	}

	public function collectives()
	{
		return $this->hasMany(Collective::class, 'formations_id');
	}

	public function coments()
	{
		return $this->hasMany(Coment::class, 'formations_id');
	}

	public function demandeurs()
	{
		return $this->belongsToMany(Demandeur::class, 'demandeursformations', 'formations_id', 'demandeurs_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function details()
	{
		return $this->hasMany(Detail::class, 'formations_id');
	}

	public function employees()
	{
		return $this->belongsToMany(Employee::class, 'employeesformations', 'formations_id', 'employees_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function evaluations()
	{
		return $this->hasMany(Evaluation::class, 'formations_id');
	}

	public function factures()
	{
		return $this->hasMany(Facture::class, 'formations_id');
	}

	public function fcollectives()
	{
		return $this->hasMany(Fcollective::class, 'formations_id');
	}

	public function findividuelles()
	{
		return $this->hasMany(Findividuelle::class, 'formations_id');
	}

	public function individuelles()
	{
		return $this->hasMany(Individuelle::class, 'formations_id');
	}
}
