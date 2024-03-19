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
 * Class Moduleoperateurstatut
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $statut
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Modulesoperateur[] $modulesoperateurs
 *
 * @package App\Models
 */
class Moduleoperateurstatut extends Model
{
	
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'moduleoperateurstatut';

	protected $fillable = [
		'uuid',
		'statut'
	];

	public function modulesoperateurs()
	{
		return $this->hasMany(Modulesoperateur::class);
	}
}
