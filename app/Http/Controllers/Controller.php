<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // ✅ Add this line

abstract class Controller
{
    use AuthorizesRequests;
}
