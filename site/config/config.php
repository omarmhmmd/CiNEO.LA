<?php

return [
    'debug' => true,
    'api' => [
        'basicAuth' => true
    ],
    'panel' =>[
      'install' => true
    ],
    'routes' => [
      [
        'pattern' => '(:any)',
        'action'  => function($uid) {

        $page = page($uid);

        if(!$page) $page = page('films/' . $uid);
        if(!$page) $page = site()->errorPage();

        return site()->visit($page);
      }
      ],
      [
        'pattern' => 'films/(:any)',
        'action'  => function($uid) {
          go($uid);
        }
      ]
    ],
    'pedroborges.meta-tags.default' => function ($page, $site) {
        return [
            'og' => [
                'title' => $page->isHomePage()
                    ? $site->title()
                    : $page->title(),
                'site_name' => $site->title(),
                'description' => $page->metadescription(),
                'namespace:image' => function ($page) {
                  $image = $page->metaimage()->toFile();
                  return [
                      'image' => $image->url(),
                      'alt' => $image->alt()
                  ];
                },
                'url' => $page->url()
            ],
            'twitter' => [
              'card' => 'summary',
              'site' => $site->title(),
              'title' => $page->title(),
              'description' => $page->metadescription(),
              'namespace:image' => function ($page) {
                $image = $page->metaimage()->toFile();
                return [
                    'image' => $image->url(),
                    'alt' => $image->alt()
                ];
              },
              'url' => $page->url()
            ]
        ];
    }
];
