<footer class="bg-cyan-900 text-white mt-auto">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-1">
                <h3 class="text-lg font-bold mb-4 text-cyan-200">DRIVE<span class="text-red-500">.E6</span></h3>
                <p class="text-cyan-100 text-sm">
                    Votre drive local, simple et rapide. Commandez en ligne et récupérez vos courses en 5 minutes.
                </p>
                <div class="mt-4 flex space-x-4">
                    <!-- Social Icons (Placeholders) -->
                    <a href="#" class="text-cyan-300 hover:text-white">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#" class="text-cyan-300 hover:text-white">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.48 2h.08zm-1.8 10a1.8 1.8 0 113.6 0 1.8 1.8 0 01-3.6 0zm-2.6-3.4a1.4 1.4 0 112.8 0 1.4 1.4 0 01-2.8 0z" clip-rule="evenodd" /></svg>
                    </a>
                </div>
            </div>

            <div class="col-span-1">
                <h3 class="text-sm font-bold uppercase tracking-wider text-cyan-200 mb-4">Nos Rayons</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('produits.index', ['categorie' => 'Fruits & Légumes']) }}" class="text-cyan-100 hover:text-white text-sm">Fruits & Légumes</a></li>
                    <li><a href="{{ route('produits.index', ['categorie' => 'Boucherie']) }}" class="text-cyan-100 hover:text-white text-sm">Boucherie</a></li>
                    <li><a href="{{ route('produits.index', ['categorie' => 'Frais']) }}" class="text-cyan-100 hover:text-white text-sm">Produits Frais</a></li>
                    <li><a href="{{ route('produits.index', ['categorie' => 'Epicerie']) }}" class="text-cyan-100 hover:text-white text-sm">Épicerie</a></li>
                    <li><a href="{{ route('produits.index', ['categorie' => 'Boissons']) }}" class="text-cyan-100 hover:text-white text-sm">Boissons</a></li>
                </ul>
            </div>

            <div class="col-span-1">
                <h3 class="text-sm font-bold uppercase tracking-wider text-cyan-200 mb-4">Aide & Services</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-cyan-100 hover:text-white text-sm">Comment ça marche ?</a></li>
                    <li><a href="#" class="text-cyan-100 hover:text-white text-sm">Foire aux questions</a></li>
                    <li><a href="#" class="text-cyan-100 hover:text-white text-sm">Contactez-nous</a></li>
                    <li><a href="#" class="text-cyan-100 hover:text-white text-sm">Mentions légales</a></li>
                    <li><a href="#" class="text-cyan-100 hover:text-white text-sm">CGV</a></li>
                </ul>
            </div>

            <div class="col-span-1">
                <h3 class="text-sm font-bold uppercase tracking-wider text-cyan-200 mb-4">Newsletter</h3>
                <p class="text-cyan-100 text-sm mb-4">Recevez nos meilleures offres par email.</p>
                <form class="flex flex-col space-y-2">
                    <input type="email" placeholder="Votre email" class="px-4 py-2 rounded bg-cyan-800 border border-cyan-700 text-white placeholder-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded font-bold hover:bg-red-700 transition-colors">S'inscrire</button>
                </form>
            </div>
        </div>
        <div class="mt-12 border-t border-cyan-800 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-cyan-400 text-sm">&copy; {{ date('Y') }} Drive E6. Tous droits réservés.</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2560px-Visa_Inc._logo.svg.png" alt="Visa" class="h-6 bg-white rounded px-1">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" alt="Mastercard" class="h-6 bg-white rounded px-1">
            </div>
        </div>
    </div>
</footer>

<style>
.site-footer {
    background: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(10px);
    color: white;
    padding: 3rem 0 1rem;
    margin-top: auto;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.footer-section h3 {
    font-size: 1.2rem;
    margin-bottom: 1rem;
    color: var(--primary-color);
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 0.5rem;
}

.footer-section a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: color 0.3s;
}

.footer-section a:hover {
    color: white;
}

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.6);
}
</style>
