<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Produit;
use App\Services\FnacDartyService;

class ExportFnacDartyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fnacdarty:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exporte automatiquement les produits non périssables vers Fnac Darty';

    /**
     * Execute the console command.
     */
    public function handle(FnacDartyService $exportService)
    {
        $this->info("Début de l'export automatique Fnac Darty...");

        // On cherche tous les produits qui doivent être exportés et qui sont éligibles
        $produitsToExport = Produit::where('is_non_perissable', true)
            ->where('export_fnacdarty', true)
            // Optionnel : ne pas ré-exporter ce qui est déjà en succès. On peut commenter ça si on veut forcer.
            ->where(function($q) {
                $q->where('export_status', '!=', 'success')->orWhereNull('export_status');
            })
            ->get();

        if ($produitsToExport->isEmpty()) {
            $this->info("Aucun produit à exporter.");
            return;
        }

        $this->info($produitsToExport->count() . " produit(s) trouvé(s) pour l'export.");

        foreach ($produitsToExport as $produit) {
            $this->line("Export du produit ID {$produit->id} : {$produit->libelle}");
            
            $result = $exportService->export($produit);

            if ($result['success']) {
                $produit->update(['export_status' => 'success']);
                $this->info("  -> Succès");
            } else {
                $produit->update(['export_status' => 'error']);
                $this->error("  -> Erreur : {$result['message']}");
            }
        }

        $this->info("Export Fnac Darty terminé.");
    }
}
