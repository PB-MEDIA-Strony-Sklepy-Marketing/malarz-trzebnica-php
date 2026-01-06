<?php

declare(strict_types=1);

/**
 * Konfiguracja routingu aplikacji Malarz Trzebnica
 * 
 * Format: ['METHOD', 'path', 'Controller@method']
 * 
 * @package MalarzTrzebnica
 */

return [
    // Strona główna
    ['GET', '/', 'HomeController@index'],
    ['GET', '/index', 'HomeController@index'],
    ['GET', '/home', 'HomeController@index'],

    // Oferta
    ['GET', '/oferta', 'OfferController@index'],
    ['GET', '/uslugi', 'OfferController@index'],

    // Galeria
    ['GET', '/galeria', 'GalleryController@index'],
    ['GET', '/portfolio', 'GalleryController@index'],
    ['GET', '/realizacje', 'GalleryController@index'],

    // Kontakt
    ['GET', '/kontakt', 'ContactController@index'],
    ['POST', '/kontakt/wyslij', 'ContactController@send'],
    ['POST', '/contact/send', 'ContactController@send'],

    // API endpoints (opcjonalnie)
    ['GET', '/api/gallery/images', 'Api\GalleryController@images'],
    
    // 404 fallback
    ['GET', '/404', 'ErrorController@notFound'],
];
