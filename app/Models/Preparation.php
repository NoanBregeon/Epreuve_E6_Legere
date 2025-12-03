<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $commande_id
 * @property int $employe_id
 * @property string $statut
 * @property \Illuminate\Support\Carbon $date_debut
 * @property \Illuminate\Support\Carbon|null $date_fin
 * @property-read \App\Models\Commande|null $commande
 * @property-read \App\Models\User|null $employe
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preparation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preparation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preparation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preparation whereCommandeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preparation whereDateDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preparation whereDateFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preparation whereEmployeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preparation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preparation whereStatut($value)
 *
 * @mixin \Eloquent
 */
class Preparation extends Model
{
    protected $table = 'preparations';

    public $timestamps = false;

    protected $fillable = [
        'commande_id',
        'employe_id',
        'statut',
        'date_debut',
        'date_fin',
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
    ];

    /**
     * @return BelongsTo<Commande, $this>
     */
    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function employe(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employe_id');
    }
}
