<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $ticket_id
 * @property int $produit_id
 * @property int $qte
 * @property numeric $prix_unitaire_ht
 * @property numeric $tva
 * @property numeric $total_ht
 * @property numeric $total_ttc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Produit|null $produit
 * @property-read \App\Models\Ticket|null $ticket
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneTicket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneTicket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneTicket query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneTicket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneTicket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneTicket wherePrixUnitaireHt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneTicket whereProduitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneTicket whereQte($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneTicket whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneTicket whereTotalHt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneTicket whereTotalTtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneTicket whereTva($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneTicket whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class LigneTicket extends Model
{
    protected $table = 'lignes_tickets';

    protected $fillable = [
        'ticket_id',
        'produit_id',
        'qte',
        'prix_unitaire_ht',
        'tva',
        'total_ht',
        'total_ttc',
    ];

    protected $casts = [
        'qte' => 'integer',
        'prix_unitaire_ht' => 'decimal:2',
        'tva' => 'decimal:2',
        'total_ht' => 'decimal:2',
        'total_ttc' => 'decimal:2',
    ];

    /**
     * @return BelongsTo<Ticket, $this>
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * @return BelongsTo<Produit, $this>
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }
}
