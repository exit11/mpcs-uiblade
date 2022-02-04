<?php

namespace Exit11\UiBlade\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mpcs\Core\Traits\ResourceTrait;
use Illuminate\Support\Carbon;

class Menu extends JsonResource
{
    use ResourceTrait;

    public $params;

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource, $params = null)
    {
        parent::__construct($resource);
        $this->params = $params;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request, $params = null)
    {

        if (!$params || !is_array($params)) {
            $params = $this->params;
        }

        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'order' => $this->order,
            'name' => $this->name,
            'description' => $this->description,
            'icon' => $this->icon,
            'url' => $this->url,
            'target' => $this->target,
            'background_image' => $this->background_image,
            'is_visible' => $this->is_visible,
            'status_is_visible' => $this->status_is_visible,
            'period_from' => Carbon::parse($this->period_from)->format('Y-m-d H:i:s'),
            'period_to' => $this->period_to ? Carbon::parse($this->period_to)->format('Y-m-d H:i:s') : null,
            'depth' => $this->depth,
            'all_children' => $this->whenLoaded('allChildren', function () use ($params) {
                return new MenuCollection($this->allChildren, $params);
            }),
            'children' => $this->whenLoaded('children', function () use ($params) {
                return new MenuCollection($this->children, $params);
            }),
            'nested_str' => $this->nested_str,
            $this->mergeWhen($this->relationLoaded('allParent'), function () {
                return [
                    'nested_parent_str' => $this->nested_parent_str
                ];
            }),
        ];
    }
}
