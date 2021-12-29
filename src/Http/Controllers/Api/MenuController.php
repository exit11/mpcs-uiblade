<?php

namespace Exit11\UiBlade\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Mpcs\Core\Facades\Core;
use Mpcs\Core\Traits\ControllerTrait;

use Exit11\UiBlade\Http\Requests\MenuRequest as Request;
use Exit11\UiBlade\Http\Resources\Menu as Resource;
use Exit11\UiBlade\Http\Resources\MenuCollection as ResourceCollection;
use Exit11\UiBlade\Models\Menu as Model;
use Exit11\UiBlade\Services\MenuService as Service;

class MenuController extends Controller
{
    use ControllerTrait;
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
        $this->controllerTraitInit();
    }

    /**
     * index
     * @param  mixed $request
     * @return view
     */
    public function index(Request $request)
    {
        return new ResourceCollection($this->service->index());
    }

    /**
     * edit
     *
     * @param  mixed $menu
     * @return void
     */
    public function edit(Model $menu)
    {
        return new Resource($this->service->edit($menu));
    }

    /**
     * show
     *
     * @param  mixed $menu
     * @return void
     */
    public function show(Model $menu)
    {
        return new Resource($this->service->show($menu));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new Resource($this->service->store());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Model $menu)
    {
        return new Resource($this->service->update($menu));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $menu)
    {
        return Core::responseJson($this->service->destroy($menu));
    }

    /**
     * saveOrder
     *
     * @param  mixed $request
     * @return void
     */
    public function saveOrder(Request $request)
    {
        return Core::responseJson($this->service->saveOrder());
    }
}
