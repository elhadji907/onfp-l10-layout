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
 * Class Convention
 * 
 * @property int $id
 * @property string $uuid
 * @property string $numero
 * @property string|null $name
 * @property string|null $sigle
 * @property Carbon|null $date
 * @property string|null $items1
 * @property string|null $items2
 * @property string|null $description
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Collective[] $collectives
 * @property Collection|Formation[] $formations
 * @property Collection|Individuelle[] $individuelles
 *
 * @package App\Models
 */
class Convention extends Model
{
	
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'conventions';

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'uuid',
		'numero',
		'name',
		'sigle',
		'date',
		'items1',
		'items2',
		'description'
	];

	public function collectives()
	{
		return $this->hasMany(Collective::class, 'conventions_id');
	}

	public function formations()
	{
		return $this->hasMany(Formation::class, 'conventions_id');
	}

	public function individuelles()
	{
		return $this->hasMany(Individuelle::class, 'conventions_id');
	}
}
