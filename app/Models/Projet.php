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
 * Class Projet
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $name
 * @property string|null $sigle
 * @property string|null $description
 * @property Carbon|null $debut
 * @property Carbon|null $fin
 * @property float|null $budjet
 * @property string|null $budjet_lettre
 * @property Carbon|null $date_signature
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Collective[] $collectives
 * @property Collection|Courrier[] $courriers
 * @property Collection|Depense[] $depenses
 * @property Collection|Fcollective[] $fcollectives
 * @property Collection|Findividuelle[] $findividuelles
 * @property Collection|Formation[] $formations
 * @property Collection|Individuelle[] $individuelles
 * @property Collection|Ingenieur[] $ingenieurs
 * @property Collection|Localite[] $localites
 * @property Collection|Module[] $modules
 * @property Collection|Zone[] $zones
 *
 * @package App\Models
 */
class Projet extends Model
{
	
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'projets';

	protected $casts = [
		'budjet' => 'float'
	];

	protected $dates = [
		'debut',
		'fin',
		'date_signature'
	];

	protected $fillable = [
		'uuid',
		'name',
		'sigle',
		'description',
		'debut',
		'fin',
		'budjet',
		'budjet_lettre',
		'date_signature'
	];

	public function collectives()
	{
		return $this->belongsToMany(Collective::class, 'collectivesprojets', 'projets_id', 'collectives_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function courriers()
	{
		return $this->hasMany(Courrier::class, 'projets_id');
	}

	public function depenses()
	{
		return $this->hasMany(Depense::class, 'projets_id');
	}

	public function fcollectives()
	{
		return $this->hasMany(Fcollective::class, 'projets_id');
	}

	public function findividuelles()
	{
		return $this->hasMany(Findividuelle::class, 'projets_id');
	}

	public function formations()
	{
		return $this->hasMany(Formation::class, 'projets_id');
	}

	public function individuelles()
	{
		return $this->hasMany(Individuelle::class, 'projets_id');
	}

	public function ingenieurs()
	{
		return $this->belongsToMany(Ingenieur::class, 'projetsingenieurs', 'projets_id', 'ingenieurs_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function localites()
	{
		return $this->belongsToMany(Localite::class, 'projetslocalites', 'projets_id', 'localites_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function modules()
	{
		return $this->belongsToMany(Module::class, 'projetsmodules', 'projets_id', 'modules_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function zones()
	{
		return $this->belongsToMany(Zone::class, 'projetszones', 'projets_id', 'zones_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
