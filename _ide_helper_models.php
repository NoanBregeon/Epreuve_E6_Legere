<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property string|null $telephone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket> $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereUpdatedAt($value)
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
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
 */
	class LigneTicket extends \Eloquent {}
}

namespace App\Models{
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
 */
	class Produit extends \Eloquent {}
}

namespace App\Models{
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
 */
	class Ticket extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property bool $is_admin
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Silber\Bouncer\Database\Ability> $abilities
 * @property-read int|null $abilities_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Silber\Bouncer\Database\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket> $tickets
 * @property-read int|null $tickets_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIs($role)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsAll($role)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsNot($role)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

