<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $commande_id
 * @property int $produit_id
 * @property int $quantite_demandee
 * @property int $quantite_preparee
 * @property numeric $prix_unitaire_ht
 * @property string $statut_ligne
 * @property string|null $note
 * @property-read \App\Models\Commande|null $commande
 * @property-read \App\Models\Produit|null $produit
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneCommande newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneCommande newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneCommande query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneCommande whereCommandeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneCommande whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneCommande whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneCommande wherePrixUnitaireHt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneCommande whereProduitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneCommande whereQuantiteDemandee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneCommande whereQuantitePreparee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LigneCommande whereStatutLigne($value)
 *
 * @mixin \Eloquent
 */
class LigneCommande extends Model
{
    protected $table = 'lignes_commandes';

    public $timestamps = false; // Pas de created_at/updated_at sur cette table pivot enrichie

    protected $fillable = [
        'commande_id',
        'produit_id',
        'quantite_demandee',
        'quantite_preparee',
        'prix_unitaire_ht',
        'statut_ligne',
        'note',
    ];

    protected $casts = [
        'prix_unitaire_ht' => 'decimal:2',
    ];

    /**
     * @return BelongsTo<Commande, $this>
     */
    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }

    /**
     * @return BelongsTo<Produit, $this>
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }
}
