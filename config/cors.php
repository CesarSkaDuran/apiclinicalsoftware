<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'supportsCredentials' => false,
    'allowedOrigins' => [
        'http://localhost:4200', 'http://localhost',
        'https://hc.clinicalsoftware.org', 'http://hc.clinicalsoftware.org',
        'https://drparra.clinicalsoftware.org', 'http://drparra.clinicalsoftware.org',
        'https://drdanielabarrera.clinicalsoftware.org', 'http://drdanielabarrera.clinicalsoftware.org',
        'https://odontologia.clinicalsoftware.org', 'http://odontologia.clinicalsoftware.org',
        'https://pacientes.clinicalsoftware.org', 'http://pacientes.clinicalsoftware.org',
        'https://cliente.sodeva.com.co', 'http://cliente.sodeva.com.co', 'http://multiservicioshyf.com.co', 'http://admin.multiservicioshyf.com.co',
        'http://drvivianacharris.clinicalsoftware.org', 'https://drfernandez.clinicalsoftware.org',
        'https://drvivianacharris.clinicalsoftware.org', 'http://drvivianacharris.clinicalsoftware.org',
        'https://dryorman.clinicalsoftware.org', 'http://dryorman.clinicalsoftware.org',
    ],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['*'],
    'allowedMethods' => ['*'],
    'exposedHeaders' => [],
    'maxAge' => 0,
];
