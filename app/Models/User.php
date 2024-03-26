<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use SoftDeletes;
    use \App\Helpers\UuidForKey;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'date_naissance',
        'email_verified_at'
    ];

    protected $fillable = [
        'firstname',
        'name',
        'email',
        'telephone',
        'adresse',
        'image',
        'password',
        'created_by',
        'updated_by',

        'twitter',
        'facebook',
        'instagram',
        'linkedin',

        'uuid',
        'civilite',
        'username',
        'fixe',
        'sexe',
        'date_naissance',
        'lieu_naissance',
        'bp',
        'fax',
        'email_verified_at',
        'deleted_by',
        'professionnelles_id',
        'familiales_id',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'professionnelles_id' => 'int',
        'familiales_id' => 'int'
    ];

    public function getImage()
    {
        $imagePath = $this->image ?? 'avatars/default.png';
        return "/storage/" . $imagePath;
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function ($user) {
            $user->profile()->create([
                'titre'    =>    '',
                'description'    =>    '',
                'url'    =>    ''
            ]);
        });
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function familiale()
    {
        return $this->belongsTo(Familiale::class, 'familiales_id');
    }

    public function professionnelle()
    {
        return $this->belongsTo(Professionnelle::class, 'professionnelles_id');
    }

    public function administrateur()
    {
        return $this->hasOne(Administrateur::class, 'users_id');
    }

    public function agent()
    {
        return $this->hasOne(Agent::class, 'users_id');
    }

    public function beneficiaire()
    {
        return $this->hasOne(Beneficiaire::class, 'users_id');
    }

    public function coment()
    {
        return $this->hasOne(Coment::class, 'users_id');
    }

    public function commentaire()
    {
        return $this->hasOne(Commentaire::class, 'users_id');
    }

    public function commentere()
    {
        return $this->hasOne(Commentere::class, 'users_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

    public function comptable()
    {
        return $this->hasOne(Comptable::class, 'users_id');
    }

    public function courriers()
    {
        return $this->hasMany(Courrier::class, 'users_id')->latest();
    }

    public function demandeur()
    {
        return $this->hasOne(Demandeur::class, 'users_id')->latest();
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'users_id')->latest()->latest();
    }

    public function etablissement()
    {
        return $this->hasOne(Etablissement::class, 'users_id');
    }

    public function gestionnaire()
    {
        return $this->hasOne(Gestionnaire::class, 'users_id');
    }

    public function operateur()
    {
        return $this->hasOne(Operateur::class, 'users_id')->latest();
    }

    public function postes()
    {
        return $this->hasMany(Poste::class, 'users_id')->latest();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'users_id');
    }

    public function imputations()
    {
        return $this->belongsToMany(Imputation::class, 'usersimputations', 'users_id', 'imputations_id')
            ->withPivot('id', 'deleted_at')
            ->withTimestamps();
    }
}
