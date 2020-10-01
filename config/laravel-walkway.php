<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Database Columns
    |--------------------------------------------------------------------------
    |
    | Enter the names of the columns used for storing the users Truckspace ID
    | and tokens. If the tokens field is encrypted, then you will need to set
    | encrypt to 'true'.
    |
    */

    'columns' => [

        // The name of the column used to store the users Truckspace ID
        'id' => 'truckspace_id',

        // The name of the column used to store the users tokens
        'tokens' => 'truckspace_tokens',

        // Determines if the contents of the tokens field is encrypted
        'encrypt' => true,

    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    |
    | The values below are used for storing the user response in the cache.
    | It's important to cache the information to prevent running into rate
    | limits.
    |
    */

    'cache' => [

        // The name of the cache store (this will use the default cache out of the box)
        'store' => null,

        // The prefix for the cache key followed by the users ID
        'prefix' => 'truckspace-user:',

        // The ttl (in seconds) of how long the data should be cached
        'ttl' => 1800,

    ],

];
