<?php

namespace App\Helpers;

class VideoProviderHelper
{
    public static function getProviders($movieId)
    {
        return [
            'vidsrc' => [
                'name' => 'VidSrc',
                'url' => "https://vidsrc.to/embed/movie/{$movieId}",
                'supports_language' => false,
                'description' => 'Reproductor principal'
            ],
            'vidsrc_es' => [
                'name' => 'VidSrc (Español)',
                'url' => "https://vidsrc.to/embed/movie/{$movieId}?lang=es",
                'supports_language' => true,
                'description' => 'Intenta cargar en español'
            ],
            'vidsrc_latino' => [
                'name' => 'VidSrc (Latino)',
                'url' => "https://vidsrc.to/embed/movie/{$movieId}?audio=es",
                'supports_language' => true,
                'description' => 'Audio latino'
            ],
            'vidsrc_sub' => [
                'name' => 'VidSrc (Subtítulos)',
                'url' => "https://vidsrc.to/embed/movie/{$movieId}?sub=es",
                'supports_language' => true,
                'description' => 'Con subtítulos en español'
            ],
            'streamtape' => [
                'name' => 'StreamTape',
                'url' => "https://streamtape.com/e/{$movieId}",
                'supports_language' => false,
                'description' => 'Proveedor alternativo'
            ],
            'dood' => [
                'name' => 'Dood',
                'url' => "https://dood.wf/e/{$movieId}",
                'supports_language' => false,
                'description' => 'Proveedor alternativo'
            ],
            'mixdrop' => [
                'name' => 'MixDrop',
                'url' => "https://mixdrop.co/e/{$movieId}",
                'supports_language' => false,
                'description' => 'Proveedor alternativo'
            ],
            'uqload' => [
                'name' => 'Uqload',
                'url' => "https://uqload.com/e/{$movieId}",
                'supports_language' => false,
                'description' => 'Proveedor alternativo'
            ]
        ];
    }

    public static function getSpanishProviders($movieId)
    {
        $allProviders = self::getProviders($movieId);
        return array_filter($allProviders, function($provider) {
            return $provider['supports_language'];
        });
    }

    public static function getDefaultProvider($movieId)
    {
        return self::getProviders($movieId)['vidsrc_es'] ?? self::getProviders($movieId)['vidsrc'];
    }
} 