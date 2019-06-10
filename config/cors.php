<?php

return [
<<<<<<< HEAD
=======

>>>>>>> long
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
<<<<<<< HEAD
   'supportsCredentials' => false,
   'allowedOrigins' => ['*'],
   'allowedHeaders' => ['Content-Type', 'X-Requested-With','Access-Control-Allow-Origin', 'X-Auth-Token', 'X-Requested-With'],
   'allowedMethods' => ['*'], // ex: ['GET', 'POST', 'PUT',  'DELETE']
   'exposedHeaders' => [],
   'maxAge' => 0,
];
=======

    'supportsCredentials' => false,
    'allowedOrigins' => ['http://localhost:3000'],
    'allowedHeaders' => ['Content-Type', 'X-Requested-With', 'Accept'],
    'allowedMethods' => ['GET', 'POST', 'PUT',  'DELETE'],
    'exposedHeaders' => [],
    'maxAge' => 0,

];
>>>>>>> long
