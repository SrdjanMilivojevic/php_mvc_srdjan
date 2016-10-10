<?php

return [

    /*
    |--------------------------------------------------------------
    | Pagination url prefix:
    |--------------------------------------------------------------
    |
    | You can set the url prefix for pagination here.
    | Example:
    | If we use default "pg_", generated url will be
    | for instance "pg_1".
    | Application will not map this as a parameter.
    |
     */
    'urlPrefix' => 'pg_',

    /*
    |--------------------------------------------------------------
    | Routes:
    |--------------------------------------------------------------
    |
    | Define the default Controller and the default action.
    |
     */
    'routes' => [

        'HomeController' => 'index',

    ],
];
