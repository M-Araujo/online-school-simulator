<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller {
    protected $authenticatedUser;

    public function __construct() {
        $this->authenticatedUser = Auth::user();
        view()->share('authenticatedUser', $this->authenticatedUser);
    }
}
