<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int|null $client_id
 * @property string $numero_commande
 * @property string $statut
 * @property \Illuminate\Support\Carbon $creneau_retrait
 * @property numeric $total_ht
 * @property numeric $total_ttc
 * @property string|null $note_interne
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client|null $client
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LigneCommande> $lignes
 * @property-read int|null $lignes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Preparation> $preparations
 * @property-read int|null $preparations_count
 * @property-read \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereCreneauRetrait($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereNoteInterne($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereNumeroCommande($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereTotalHt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereTotalTtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Commande extends Model
{
    protected $table = 'commandes';

    protected $fillable = [
        'client_id',
        'numero_commande',
        'statut',
        'creneau_retrait',
        'total_ht',
        'total_ttc',
        'note_interne',
    ];

    protected $casts = [
        'creneau_retrait' => 'datetime',
        'total_ht' => 'decimal:2',
        'total_ttc' => 'decimal:2',
    ];

    /**
     * @return BelongsTo<Client, $this>
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class); // Ou User::class selon votre logique client
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        // Si le client est un User de l'app Laravel
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * @return HasMany<LigneCommande, $this>
     */
    public function lignes(): HasMany
    {
        return $this->hasMany(LigneCommande::class);
    }

    /**
     * @return HasMany<Preparation, $this>
     */
    public function preparations(): HasMany
    {
        return $this->hasMany(Preparation::class);
    }
}
