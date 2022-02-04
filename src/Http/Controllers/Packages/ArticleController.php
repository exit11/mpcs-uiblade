<?php

namespace Exit11\UiBlade\Http\Controllers\Packages;

use App\Http\Controllers\Controller;
use Exit11\UiBlade\UiBlade;

class ArticleController extends Controller
{
    /**
     * index
     * @param  mixed $request
     * @return view
     */
    public function index()
    {
        return view(UiBlade::theme('articles.index'));
    }
}
