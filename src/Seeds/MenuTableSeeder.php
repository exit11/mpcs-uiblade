<?php

namespace Exit11\UiBlade\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Exit11\UiBlade\Models\Menu as Model;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Model::truncate();

        $order = 1;
        factory(Model::class, 10)->create()->each(function ($model) {
            $count = rand(0, 5);
            factory(Model::class, $count)->create([
                'parent_id' => $model->id,
                'depth' => $model->depth + 1,
            ])->each(function ($model) {
                $count = rand(0, 5);
                factory(Model::class, $count)->create([
                    'parent_id' => $model->id,
                    'depth' => $model->depth + 1,
                ]);
            });
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
