<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $titre
 * @property string|null $description
 * @property string $image_path
 * @property string|null $badge_text
 * @property string $badge_color
 * @property string|null $prix_affichage
 * @property string $texte_bouton
 * @property string $lien_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $produit_id
 * @property string $type_promo
 * @property string|null $valeur_promo
 * @property int $min_quantite
 * @property-read \App\Models\Produit|null $produit
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereBadgeColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereBadgeText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereLienUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereMinQuantite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion wherePrixAffichage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereProduitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereTexteBouton($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereTitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereTypePromo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promotion whereValeurPromo($value)
 *
 * @mixin \Eloquent
 */
class Promotion extends Model
{
    protected $guarded = [];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
