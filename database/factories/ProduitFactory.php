<?php

namespace Database\Factories;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitFactory extends Factory
{
    protected $model = Produit::class;

    public function definition(): array
    {
        $categories = ['Fruits & Légumes', 'Boulangerie', 'Crémerie', 'Épicerie', 'Boissons', 'Viandes & Poissons', 'Surgelés'];

        return [
            'reference' => $this->faker->unique()->bothify('REF-####'),
            'libelle' => ucfirst($this->faker->words(3, true)),
            'description' => $this->faker->paragraph(),
            'image' => null,
            'categorie' => $this->faker->randomElement($categories),
            'prix_ht' => $this->faker->randomFloat(2, 0.5, 50),
            'tva' => 5.5,
            'stock' => $this->faker->numberBetween(0, 200),
            'actif' => true,
        ];
    }
}
