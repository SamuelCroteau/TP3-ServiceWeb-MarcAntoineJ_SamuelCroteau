<?php

namespace App\Http\Controllers;

define('OK', 200);
define('CREATED', 201);
define('NO_CONTENT', 204);
define('NOT_FOUND', 404);
define('INVALID_DATA', 422);
define('SERVER_ERROR', 500);

//Pagination
define('SEARCH_PAGINATION', 20);

//Roles
define('USER', 1);
define('ADMIN', 2);
abstract class Controller
{
    //
}
