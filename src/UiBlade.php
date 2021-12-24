<?php

namespace Exit11\UiBlade;

class UiBlade
{

    /**
     * menuTitle
     *
     * @param  mixed $title
     * @return void
     */
    public static function menuTitle($default, $title = null)
    {
        return $title ? trans($title) : trans($default);
    }


    /**
     * admin_view
     * 
     * @param  mixed $view
     * @return void
     */
    public static function admin_view($view)
    {
        return 'mpcs-uiblade::admin.' . $view;
    }

    /**
     * VIEW THEME 설정
     * @return string {default: 'default'}
     */
    public static function theme($view)
    {
        $viewTemplate = config('mpcsuiblade.ui_theme') ?? 'default';
        return 'mpcs-uiblade::themes.' . $viewTemplate . '.' . $view;
    }

    /**
     * 사이트메뉴 데이터
     * @return array [[Description]]
     */
    public static function getMenuData()
    {

        // 상단 글로벌 네비게이션 테스트
        $global_menu = [
            [
                'name'  => 'articles',
                'title' => '상단 글로벌 네비게이션 테스트',
                'link'  => 'articles.index',
                'children'  => [
                    'name'  => 'articles',
                    'title' => '상단 글로벌 네비게이션 테스트',
                    'link'  => 'articles.index',
                ],
                [
                    'name'  => 'articles',
                    'title' => '상단 글로벌 네비게이션 테스트',
                    'link'  => 'articles.index',
                ],
            ],
            [
                'name'  => 'popups',
                'title' => 'mpcs-article::menu.popups',
                'link'  => 'popups.index',
            ],
            [
                'name'  => 'visitors',
                'title' => 'mpcs-sociallogin::menu.visitors',
                'link'  => 'visitors.index',
            ],
        ];

        //$global_menu = collect(json_decode(json_encode($global_menu)), true);
        //dd($global_menu);
        return $global_menu;
    }
}
