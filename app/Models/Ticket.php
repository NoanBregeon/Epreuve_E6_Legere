<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int|null $client_id
 * @property int|null $user_id
 * @property numeric $total_ht
 * @property numeric $total_tva
 * @property numeric $total_ttc
 * @property string $moyen_paiement
 * @property string $statut
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client|null $client
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LigneTicket> $lignes
 * @property-read int|null $lignes_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereMoyenPaiement($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereTotalHt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereTotalTtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereTotalTva($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'client_id',
        'user_id',
        'total_ht',
        'total_tva',
        'total_ttc',
        'moyen_paiement',
        'statut',
    ];

    protected $casts = [
        'total_ht' => 'decimal:2',
        'total_tva' => 'decimal:2',
        'total_ttc' => 'decimal:2',
    ];

    /**
     * @return BelongsTo<Client, $this>
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return HasMany<LigneTicket, $this>
     */
    public function lignes(): HasMany
    {
        return $this->hasMany(LigneTicket::class);
    }
}
