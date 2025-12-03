<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $reference
 * @property string $libelle
 * @property string|null $description
 * @property string|null $image
 * @property string|null $categorie
 * @property numeric $prix_ht
 * @property numeric $tva
 * @property int $stock
 * @property bool $actif
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read float $prix_ttc
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LigneTicket> $lignes
 * @property-read int|null $lignes_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereCategorie($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereLibelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit wherePrixHt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereTva($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Produit extends Model
{
    protected $table = 'produits';

    protected $fillable = [
        'reference',
        'libelle',
        'description',
        'prix_ht',
        'tva',
        'stock',
        'actif',
        'image',
        'categorie',
    ];

    protected $casts = [
        'prix_ht' => 'decimal:2',
        'tva' => 'decimal:2',
        'stock' => 'integer',
        'actif' => 'boolean',
    ];

    /**
     * @return HasMany<LigneTicket, $this>
     */
    public function lignes(): HasMany
    {
        return $this->hasMany(LigneTicket::class, 'produit_id');
    }

    public function getPrixTtcAttribute(): float
    {
        return (float) $this->prix_ht * (1 + ((float) $this->tva / 100));
    }

    public function isEnStock(): bool
    {
        return $this->stock > 0;
    }
}
