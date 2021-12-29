<?php

namespace Exit11\UiBlade\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mpcs\Core\Facades\Core;
use Mpcs\Core\Traits\ResourceTrait;

class Menu extends JsonResource
{
    use ResourceTrait;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
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
            'depth' => $this->depth,
            'all_children' => $this->whenLoaded('allChildren', function () {
                return new MenuCollection($this->allChildren);
            }),
            'children' => $this->whenLoaded('children', function () {
                return new MenuCollection($this->children);
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
