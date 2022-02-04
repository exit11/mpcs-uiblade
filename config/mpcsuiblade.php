<?php

return [

    // route prefix
    'ui_url_prefix' => 'official',

    // theme
    'ui_theme' => 'default',

    // seo 설정
    'seo' => [
        'title' => 'EXIT11',
        'description' => 'EXIT11 설명글',
        'keywords' => '키워드1, 키워드2, 키워드3',
        'image' => '/assets/images/seo_image.jpg',
        'phone' => null,
        'email' => null,
        'adress' => null,
    ],

    // 다국어 적용 여부
    'enabled_multilingual' => true,

    // 다국어 적용 여부
    'enabled_multilingual' => true,

    // 로고 이미지
    'favicon' => '',
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
];
