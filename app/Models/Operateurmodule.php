<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operateurmodule extends Model
{
    use HasFactory;
    use SoftDeletes;
    use \App\Helpers\UuidForKey;
    protected $table = 'operateurmodules';

    protected $casts = [
        'operateurs_id' => 'int',
        'modules_id' => 'int',
    ];
    protected $fillable = [
        'uuid',
        'module',
        'domaine',
        'niveau_qualification',
        'statut',
        'details',
        'modules_id',
        'validated_id',
        'operateurs_id'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'modules_id');
    }

    public function operateur()
    {
        return $this->belongsTo(Operateur::class, 'operateurs_id')->latest();
    }

    
	public function moduleoperateurstatuts()
	{
		return $this->hasMany(Moduleoperateurstatut::class, 'operateurmodules_id');
	}
}
