<?php

namespace Exit11\UiBlade\Http\Controllers\Blade;

use Exit11\UiBlade\Facades\UiBlade;
use Mpcs\Core\Facades\Core;
use Exit11\UiBlade\Http\Controllers\Api\MenuController as Controller;
use Exit11\UiBlade\Http\Requests\MenuRequest as Request;

class MenuController extends Controller
{
    /**
     * index
     * @param  mixed $request
     * @return view
     */
    public function index(Request $request)
    {
        return view(UiBlade::admin_view('menus.index'))->withInput($request->flash());
    }

    /**
     * list
     * @param  mixed $request
     * @return view
     */
    public function list(Request $request)
    {
        // 모델 조회시 옵션설정(페이징여부, 검색조건)
        $this->addOption('depth', 1);
        $this->addOption('_is_paging', false);
        $this->addOption('_withs', ['allParent', 'allChildren']);

        $datas = $this->service->index();

        return view(UiBlade::admin_view('menus.partials.list'), compact('datas'))->withInput($request->flash());
    }
}
