<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Module
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $civilite
 * @property string|null $cin
 * @property string|null $prenom
 * @property string|null $nom
 * @property string|null $date_naissance
 * @property string|null $lieu_naissance
 * @property string|null $niveau_etude
 * @property string|null $telephone
 * @property string|null $experience
 * @property string|null $autre_sexperience
 * @property string|null $details
 * @property string|null $statut
 * @property int|null $collectives_id
 * @property int|null $collectivemodules_id
 * @property int|null $modules_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Domaine|null $domaine
 * @property Specialite|null $specialite
 * @property Statut|null $statut
 * @property Collection|Collective[] $collectives
 *
 * @package App\Models
 */

class Listecollective extends Model
{
    use HasFactory;
    use SoftDeletes;
    use \App\Helpers\UuidForKey;
    protected $table = 'listecollectives';


    protected $casts = [
        'collectives_id' => 'int',
        'collectivemodules_id' => 'int',
		'date_naissance' => 'datetime',
        'modules_id' => 'int'
    ];

    protected $fillable = [
        'uuid',
        'civilite',
        'cin',
        'prenom',
        'nom',
        'date_naissance',
        'lieu_naissance',
        'niveau_etude',
        'telephone',
        'experience',
        'autre_experience',
        'details',
        'statut',
        'collectives_id',
        'collectivemodules_id',
        'modules_id'
    ];

    public function collective()
    {
        return $this->belongsTo(Collective::class, 'collectives_id');
    }
    public function module()
    {
        return $this->belongsTo(Module::class, 'modules_id');
    }
    public function collectivemodule()
    {
        return $this->belongsTo(Collectivemodule::class, 'collectivemodules_id');
    }
}
