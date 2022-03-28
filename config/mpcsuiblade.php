<?php

return [

    // route prefix
    'ui_url_prefix' => null,

    // theme
    'ui_theme' => 'default',

    // seo 설정
    'seo' => [
        'title' => 'EXIT11',
        'description' => 'EXIT11 설명글',
        'keywords' => '키워드1, 키워드2, 키워드3',
        'image' => '/assets/images/seo_image.jpg',
        'phone' => [
            'enable_page' => false,
            'data' => "010-0000-0000",
        ],
        'email' => [
            'enable_page' => false,
            'data' => "test@www.com",
        ],
        'address' => [
            'enable_page' => false,
            'data' => "부산광역시 사하구 사하동",
        ],
    ],

    // 다국어 적용 여부
    'enabled_multilingual' => true,

    // 파비콘 이미지
    // 파비콘은 너비/높이가 48px의 배수인 정사각형의 PNG 파일이어야 합니다(예: 48 x 48px, 96 x 96px, 144 x 144px 등).
    // apple_touch_icon 180px의 배수인 정사각형의 PNG 파일이어야 합니다.
    'favicon' => [
        'apple_touch_icon' => '/assets/images/favicon/apple-touch-icon.png',
        'icon_144' => '/assets/images/favicon/icon-144.png',
        'icon_96' => '/assets/images/favicon/icon-96.png',
        'icon_48' => '/assets/images/favicon/icon-48.png',
    ],

    // 로고 이미지
    'logo_image' => [
        'header' => '/assets/images/logo_white.png',
        'offcanvas' => '/assets/images/logo_white.png',
    ],

    // 헤더에 표현되는 슬로건 카피라이트: 순서대로 출력됨
    'header_slogun' => [
        [
            'type' => 'text',
            'className' => ['h3', 'wow', 'animate__animated', 'animate__fadeInDown', 'text-white'],
            'content' => '작은 꿈과 소망을 이루어 가는',
        ],
        [
            'type' => 'text',
            'className' => ['h1', 'wow', 'animate__animated', 'animate__zoomIn', 'text-white'],
            'content' => '성프란치스꼬의 집',
        ],
    ],

    // 헤더이미지 폴더가 비어있을 경우, 대체 이미지 설정
    'header_image' => 'https://placeimg.com/1600/900/nature',

    // SNS 설정
    'sns' => [
        'facebook' => [
            'color' => "text-white",
            'url' => 'https://www.facebook.com/EXIT11',
        ],
        'twitter' => [
            'color' => "text-white",
            'url' => 'https://twitter.com/EXIT11',
        ],
        'instagram' => [
            'color' => "text-white",
            'url' => 'https://www.instagram.com/EXIT11',
        ],
        'youtube' => [
            'color' => "text-white",
            'url' => 'https://www.youtube.com/EXIT11',
        ],
    ],
];
