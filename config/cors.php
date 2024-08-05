<?php

return [

'paths' => ['api/*'],

'allowed_methods' => ['*'],

'allowed_origins' => ['*'], // En production, restreindre cela aux domaines spécifiques

'allowed_origins_patterns' => [],

'allowed_headers' => ['*'],

'exposed_headers' => [],

'max_age' => 0,

'supports_credentials' => false,

];
