<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\VideoProviderHelper;

class TestVideoProviders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'providers:test {movie_id? : ID de la película para probar}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prueba los proveedores de video disponibles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $movieId = $this->argument('movie_id') ?? '550'; // Fight Club por defecto
        
        $this->info("Probando proveedores para la película ID: {$movieId}");
        $this->newLine();
        
        $providers = VideoProviderHelper::getProviders($movieId);
        
        $this->table(
            ['Proveedor', 'URL', 'Español', 'Descripción'],
            collect($providers)->map(function ($provider, $key) {
                return [
                    $provider['name'],
                    $provider['url'],
                    $provider['supports_language'] ? '✅ Sí' : '❌ No',
                    $provider['description']
                ];
            })->toArray()
        );
        
        $this->newLine();
        $this->info('Proveedores en español disponibles:');
        $spanishProviders = VideoProviderHelper::getSpanishProviders($movieId);
        foreach ($spanishProviders as $key => $provider) {
            $this->line("• {$provider['name']}: {$provider['url']}");
        }
        
        $this->newLine();
        $this->info('Para probar un proveedor específico, visita la URL en tu navegador.');
        $this->info('Ejemplo: ' . $providers['vidsrc_es']['url']);
    }
} 