<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Programmation de l'export Fnac Darty simulé toutes les nuits à 2h00
Schedule::command('fnacdarty:export')->dailyAt('02:00');
