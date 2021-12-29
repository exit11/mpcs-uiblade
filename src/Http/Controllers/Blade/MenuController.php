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

        // $menus = Core::dataSelect('menus', ['_vendor' => 'Exit11\UiBlade', '_withs' => ['allChildren'], '_scopes' => ['nullParent']]);
        // $select_menu = $this->buildNestedSelectOptions($menus);
        $this->addOption('_is_paging', false);
        $this->addOption('_withs', ['allParent', 'allChildren']);
        $menus = $this->service->index();

        $menus = $menus->pluck('nested_str', 'id')->prepend('선택', '')->toArray();

        return view(UiBlade::admin_view('menus.index'), compact('menus'))->withInput($request->flash());
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


    /**
     * buildNestedSelectOptions
     *
     * @param  mixed $nodes
     * @param  mixed $prefix
     * @return void
     */
    protected function buildNestedSelectOptions($nodes, $prefix = "", $setNameColumn = "name", $seKeyColumn = "id")
    {
        $options = [];
        foreach ($nodes as $node) {
            $prefixName = $prefix . $node[$setNameColumn];
            $options[$node[$seKeyColumn]] = $prefixName;
            if ($node->allChildren->count() > 0) {
                $options += $this->buildNestedSelectOptions($node->allChildren, $prefixName . "&nbsp;&gt;&nbsp;", $setNameColumn, $seKeyColumn);
            }
            $options += $options;
        }
        return $options;
    }
}
