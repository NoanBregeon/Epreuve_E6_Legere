<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de commande</title>
    <style>
        body { font-family: sans-serif; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #0891b2; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; border: 1px solid #e5e7eb; }
        .footer { text-align: center; margin-top: 20px; font-size: 0.8em; color: #6b7280; }
        .qr-code { text-align: center; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Merci pour votre commande !</h1>
        </div>
        <div class="content">
            <p>Bonjour,</p>
            <p>Nous avons bien reçu votre commande <strong>{{ $commande->numero_commande }}</strong>.</p>
            <p>Vous pouvez venir la retirer le : <strong>{{ \Carbon\Carbon::parse($commande->creneau_retrait)->translatedFormat('l d F à H:i') }}</strong>.</p>

            <p>Voici votre QR Code unique à présenter lors du retrait :</p>

            <div class="qr-code">
                <!-- Utilisation d'une API externe pour générer le QR Code (évite l'erreur Imagick et s'affiche mieux dans les mails) -->
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($commande->numero_commande) }}" alt="QR Code Commande" width="200" height="200">
            </div>

            <p>Montant total : <strong>{{ number_format($commande->total_ttc, 2) }} €</strong></p>
        </div>
        <div class="footer">
            <p>Drive E6 - À bientôt !</p>
        </div>
    </div>
</body>
</html>
