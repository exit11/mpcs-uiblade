<?php

namespace Exit11\UiBlade;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class UiBladeServiceProvider extends ServiceProvider
{
    public function boot()
    {

        // 뷰템플릿 로드
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mpcs-uiblade');

        /* 콘솔에서 vendor:publish 가동시 설치 파일 */
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config' => config_path()], 'config');
        }

        /* 라우터, 다국어 */
        $this->app->booted(function () {

            // 다국어 알리어스를 mpcs로 네이밍 규칙을 통일하여 사용하기로 함
            $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'mpcs-uiblade');
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // 
    }
}
