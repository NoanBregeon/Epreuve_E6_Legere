<?php

namespace App\Http\Controllers;

use App\Mail\CommandeConfirmee;
use App\Models\LigneTicket;
use App\Models\Ticket;
use App\Services\PanierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CommandeController extends Controller
{
    protected PanierService $panierService;

    public function __construct(PanierService $panierService)
    {
        $this->panierService = $panierService;
    }

    /**
     * Afficher les commandes de l'utilisateur
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $clientId = null;
        if ($user) {
            $client = \App\Models\Client::where('email', $user->email)->first();
            if ($client) {
                $clientId = $client->id;
            }
        }

        // On récupère les commandes "Drive" (table commandes)
        $commandes = \App\Models\Commande::where('client_id', $clientId)
            ->orderBy('created_at', 'desc')
            ->with('lignes.produit')
            ->paginate(10);

        return view('commande.index', compact('commandes'));
    }

    /**
     * Afficher le formulaire de finalisation de commande (choix créneau)
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        if ($this->panierService->estVide()) {
            return redirect()->route('panier.index');
        }

        $panier = $this->panierService->getContenu();
        $totalTTC = $this->panierService->getTotalTTC();
        $remises = $this->panierService->calculerRemises();

        // Génération des créneaux (exemple simple : 3 prochains jours, 9h-19h)
        $creneaux = [];
        $start = now()->addHour()->startOfHour(); // Prochain créneau dans 1h min
        if ($start->hour < 9) {
            $start->setHour(9);
        }
        if ($start->hour > 19) {
            $start->addDay()->setHour(9);
        }

        for ($i = 0; $i < 15; $i++) { // 15 prochains créneaux
            if ($start->hour >= 9 && $start->hour <= 19) {
                $creneaux[] = [
                    'value' => $start->format('Y-m-d H:i:s'),
                    'label' => $start->translatedFormat('l d F à H:i'),
                ];
            }
            $start->addHour();
            if ($start->hour > 19) {
                $start->addDay()->setHour(9);
            }
        }

        return view('commande.create', compact('panier', 'totalTTC', 'creneaux', 'remises'));
    }

    /**
     * Créer une commande depuis le panier
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->panierService->estVide()) {
            return redirect()->route('panier.index')
                ->with('error', 'Votre panier est vide.');
        }

        $request->validate([
            'creneau_retrait' => 'required|date|after:now',
            'note_interne' => 'nullable|string|max:1000',
            'moyen_paiement' => 'required|in:SUR_PLACE,CB',
        ]);

        // Simulation de paiement en ligne
        if ($request->moyen_paiement === 'CB') {
            // Ici on appellerait l'API Stripe/PayPal
            // Pour l'exercice, on simule juste un succès
            sleep(1); // Simulation latence réseau
        }

        DB::beginTransaction();

        try {
            $user = Auth::user();
            $clientId = null;
            if ($user) {
                $client = \App\Models\Client::where('email', $user->email)->first();
                if ($client) {
                    $clientId = $client->id;
                }
            }

            $totalHT = $this->panierService->getTotalHT();
            $totalTVA = $this->panierService->getTotalTVA();
            $totalTTC = $this->panierService->getTotalTTC();
            $remises = $this->panierService->calculerRemises();

            // 1. Créer la Commande (Table Drive)
            $commande = \App\Models\Commande::create([
                'client_id' => $clientId, // ID du client trouvé via l'email
                'numero_commande' => 'CMD-'.strtoupper(uniqid()),
                'statut' => 'A_PREPARER',
                'creneau_retrait' => $request->creneau_retrait,
                'total_ht' => $totalHT,
                'total_ttc' => $totalTTC,
                'note_interne' => $request->note_interne,
            ]);

            // 2. Créer le Ticket (Table Comptabilité/Legacy)
            // On garde le ticket pour la compatibilité avec l'existant
            $ticket = Ticket::create([
                'user_id' => $user ? $user->id : null,
                'client_id' => $clientId,
                'total_ht' => $totalHT,
                'total_tva' => $totalTVA,
                'total_ttc' => $totalTTC,
                'moyen_paiement' => $request->moyen_paiement, // Utilisation du moyen de paiement choisi
                'statut' => 'VALIDE',
            ]);

            // 3. Créer les lignes
            foreach ($this->panierService->getContenu() as $produitId => $item) {

                $remiseLigne = 0;
                if (isset($remises['details'][$produitId])) {
                    $remiseLigne = $remises['details'][$produitId]['remise'];
                }

                // Ligne Commande (Drive)
                \App\Models\LigneCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $produitId,
                    'quantite_demandee' => $item['quantite'],
                    'quantite_preparee' => 0,
                    'prix_unitaire_ht' => $item['prix_ht'],
                    'statut_ligne' => 'A_VALIDER',
                ]);

                // Calcul des totaux pour la ligne ticket
                $ligneTotalHT = $item['prix_ht'] * $item['quantite'];
                $ligneTotalTTC = ($ligneTotalHT * (1 + ($item['tva'] / 100))) - $remiseLigne;

                // Ligne Ticket (Compta)
                LigneTicket::create([
                    'ticket_id' => $ticket->id,
                    'produit_id' => $produitId,
                    'qte' => $item['quantite'],
                    'prix_unitaire_ht' => $item['prix_ht'],
                    'tva' => $item['tva'],
                    'total_ht' => $ligneTotalHT,
                    'total_ttc' => $ligneTotalTTC,
                ]);

                // Décrémenter le stock
                /** @var \App\Models\Produit|null $produit */
                $produit = \App\Models\Produit::find($produitId);
                if ($produit) {
                    $produit->decrement('stock', $item['quantite']);
                }
            }

            DB::commit();

            // Vider le panier
            $this->panierService->vider();

            // Envoyer l'email de confirmation (dans un try/catch pour ne pas bloquer la commande si l'envoi échoue)
            try {
                if ($user && $user->email) {
                    Mail::to($user->email)->send(new CommandeConfirmee($commande));
                }
            } catch (\Exception $e) {
                // On log l'erreur mais on ne bloque pas la commande
                \Illuminate\Support\Facades\Log::error('Erreur envoi email commande : '.$e->getMessage());
            }

            $message = 'Commande validée avec succès ! Votre numéro de commande est '.$commande->numero_commande;
            if ($request->moyen_paiement === 'CB') {
                $message .= ' Le paiement en ligne a été accepté.';
            } else {
                $message .= ' Vous pourrez régler votre commande au moment du retrait.';
            }

            return redirect()->route('commande.show', $commande->id)
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('panier.index')
                ->with('error', 'Une erreur est survenue lors de la validation de votre commande : '.$e->getMessage());
        }
    }

    /**
     * Afficher le détail d'une commande
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        /** @var \App\Models\Commande $commande */
        $commande = \App\Models\Commande::with('lignes.produit')->findOrFail($id);

        // Vérifier que l'utilisateur peut voir cette commande
        // Si connecté : doit être le propriétaire
        // Si invité : on autorise si la commande n'a pas de client_id (commande invité)
        if (Auth::check()) {
            if ($commande->client_id && $commande->client_id !== Auth::id()) {
                abort(403, 'Accès interdit');
            }
        } else {
            // Invité : ne peut voir que les commandes sans client_id
            if ($commande->client_id !== null) {
                abort(403, 'Veuillez vous connecter pour voir cette commande');
            }
        }

        return view('commande.show', compact('commande'));
    }

    /**
     * Afficher la confirmation de commande (Legacy Ticket)
     *
     * @return \Illuminate\View\View
     */
    public function confirmation(int $id)
    {
        /** @var Ticket $commande */
        $commande = Ticket::with('lignes.produit')->findOrFail($id);

        // Vérifier que l'utilisateur peut voir cette commande
        if (Auth::check()) {
            if ($commande->user_id && $commande->user_id !== Auth::id()) {
                abort(403, 'Accès interdit');
            }
        } else {
            // Invité : ne peut voir que les tickets sans user_id
            if ($commande->user_id !== null) {
                abort(403, 'Veuillez vous connecter pour voir cette commande');
            }
        }

        return view('commande.confirmation', compact('commande'));
    }
}
