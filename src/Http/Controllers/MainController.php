<?php

namespace Exit11\UiBlade\Http\Controllers;

use App\Http\Controllers\Controller;
use Exit11\UiBlade\UiBlade;

class MainController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view(UiBlade::theme('app'));
    }
}
