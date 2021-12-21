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
        return config('mpcsui.global_menu') ?? [];
    }
}
