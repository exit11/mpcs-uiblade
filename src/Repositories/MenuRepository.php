<?php

namespace Exit11\UiBlade\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use MpcsUi\Bootstrap5\Facades\Bootstrap5;
use Mpcs\Core\Traits\RepositoryTrait;

use Exit11\UiBlade\Models\Menu as Model;

class MenuRepository implements MenuRepositoryInterface
{
    use RepositoryTrait;

    public function __construct(Model $model)
    {
        $this->repositoryInit($model);
    }

    // Get all instances of model
    public function select($enableRequestParam = false, $isApiSelect = false)
    {
        $apiSelectParams = [
            // id, name [,'is_visible']
            'item_list' => ['id', 'name'],
            'attribute_name' => trans('backend.attributes.menu')
        ];
        $model = $this->model::search($enableRequestParam);

        return $this->getSelectFormatter($model, $isApiSelect, $apiSelectParams);
    }

    // Get all instances of model
    public function all()
    {
        $model = $this->model::search()->sortable($this->model->defaultSortable);
        return $model->with($this->model::getDefaultLoadRelations())->paging();
    }

    // create a new record in the database
    public function create()
    {
        DB::beginTransaction();
        try {
            /* DB 트랜젝션 통과 */

            // 기본 정보 저장
            $parentId = $this->request['parent_id'] ?? null;
            $order = $this->model::where('parent_id', $parentId)->max('order') + 1;

            if ($parentId) {
                $depth = $this->model::where('id', $parentId)->value('depth');
                $depth = (int)$depth + 1;
            } else {
                $depth = 1;
            }

            // max depth 체크
            if ($this->model::$maxDepth < $depth) {
                abort(422, trans('validation.max.numeric', ['attribute' => 'depth', 'max' => $this->model::$maxDepth]));
            }

            $this->model->name = $this->request['name'];
            $this->model->description = $this->request['description'] ?? null;
            $this->model->parent_id = $parentId;
            $this->model->url = $this->request['url'] ?? null;
            $this->model->icon = $this->request['icon'] ?? null;
            $this->model->target = $this->request['target'];
            $this->model->is_visible = $this->request['is_visible'] ?? false;
            $this->model->period_from = $this->request['period_from'];
            $this->model->period_to = $this->request['period_to'] ?? null;
            $this->model->order = $order;
            $this->model->depth = $depth;

            /* 이미지 Base64 방식 저장 */
            $requestImage = $this->request['background_image'] ?? null;
            if ($requestImage) {
                if (!empty($requestImage)) {
                    if (substr($requestImage, 0, 10) === "data:image") {
                        $base64ToFile = Bootstrap5::base64ToFile($requestImage, $this->model->upload_disk, $this->model->image_root_dir);
                        if ($base64ToFile) {
                            $this->model->background_image = $base64ToFile;
                        }
                    } else {
                        $this->model->background_image = $requestImage;
                    }
                    Bootstrap5::generateThumb($this->model->image_root_dir, $this->model->background_image);
                }
            }

            $this->model->save();

            DB::commit();
        } catch (Exception $e) {
            /* DB 트랜젝션 롤 */
            DB::rollback();
            throw $e;
        }

        return $this->model->loadRelations();
    }

    // update record in the database
    public function update($model)
    {
        DB::beginTransaction();
        try {
            /* DB 트랜젝션 통과 */

            // 기본 정보 저장
            $parentId = $this->request['parent_id'] ?? null;

            if ($parentId) {
                $depth = $this->model::where('id', $parentId)->value('depth');
                $depth = (int)$depth + 1;
            } else {
                $depth = 1;
            }

            // max depth 체크
            if ($this->model::$maxDepth < $depth) {
                abort(422, trans('validation.max.numeric', ['attribute' => 'depth', 'max' => $this->model::$maxDepth]));
            }

            $model->name = $this->request['name'];
            $model->description = $this->request['description'] ?? null;
            $model->parent_id = $parentId;
            $model->url = $this->request['url'] ?? null;
            $model->icon = $this->request['icon'] ?? null;
            $model->target = $this->request['target'];
            $model->is_visible = $this->request['is_visible'] ?? false;
            $model->period_from = $this->request['period_from'];
            $model->period_to = $this->request['period_to'] ?? null;
            $model->depth = $depth;

            /* 이미지 Base64 방식 저장 */
            $requestImage = $this->request['background_image'] ?? $model->background_image;
            if ($requestImage) {
                if (substr($requestImage, 0, 10) === "data:image") {
                    $base64ToFile = Bootstrap5::base64ToFile($requestImage, $model->upload_disk, $model->image_root_dir);
                    if ($base64ToFile) {
                        $model->background_image = $base64ToFile;
                    }
                } else {
                    $model->background_image = $requestImage;
                }
                Bootstrap5::generateThumb($model->image_root_dir, $model->background_image);
            }

            $model->save();

            DB::commit();
        } catch (Exception $e) {
            /* DB 트랜젝션 롤 */
            DB::rollback();
            throw $e;
        }

        return $model->loadRelations();
    }

    // show the record with the given id
    public function get($model)
    {
        return $model->loadRelations();
    }

    // remove record from the database
    public function delete($model)
    {
        return $model->delete();
    }

    public function saveOrder()
    {
        /* DB 트랜젝션 시작 */
        DB::beginTransaction();
        try {
            /* DB 트랜젝션 통과 */
            $this->model::saveOrder($this->request);
            DB::commit();
        } catch (Exception $e) {
            /* DB 트랜젝션 롤 */
            DB::rollback();
            throw $e;
        }
        return true;
    }
}
