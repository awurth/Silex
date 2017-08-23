<?php

$app['security.role_hierarchy'] = [
    'ROLE_ADMIN' => [
        'ROLE_USER',
        'ROLE_ALLOWED_TO_SWITCH'
    ]
];

$app['security.firewalls'] = [
    'main' => [
        'pattern' => '^/',
        'form' => [
            'login_path' => '/login',
            'check_path' => '/login_check',
            'with_csrf' => true
        ],
        'logout' => [
            'logout_path' => '/logout',
            'invalidate_session' => true
        ],
        'anonymous' => true,
        'users' => $app['silex_user.user_provider.username_email']
    ]
];
