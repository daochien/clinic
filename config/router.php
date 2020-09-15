<?php
    return [
        'role' => [
            'name' => '管理者役割管理',
            'groups' => [
                'view' => [
                        'name' => 'View list',
                        'routes' => ['role.index', 'permission.routes', 'role.list']
                    ],
                'create' => [
                        'name' => 'Create',
                        'routes' => ['role.store']
                    ],
                'update' => [
                        'name' => 'Update',
                        'routes' => ['role.update', 'role.show']
                    ],
                'delete' => [
                        'name' => 'Delete',
                        'routes' => ['role.destroy']
                    ]
            ]
        ],
        'manager' => [
            'name' => '管理者アカウント管理',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['manager.index']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['manager.store'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['manager.update', 'manager.show']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['manager.destroy']
                ]
            ]
        ],
        'clinic' => [
            'name' => 'クリニック管理',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['clinic.index', 'clinic.get.users']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['clinic.store', 'clinic.add.users'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['clinic.update', 'clinic.show']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['clinic.destroy']
                ]
            ]
        ],
        'staff' => [
            'name' => 'スタッフ管理',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['user.index', 'api.user.search']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['user.store'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['user.show', 'user.update']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['user.destroy']
                ]
            ]
        ],
        'group' => [
            'name' => 'グループ管理',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['group.index']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['group.store'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['group.update', 'group.show']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['group.destroy']
                ]
            ]
        ],
        'notification' => [
            'name' => 'お知らせ管理',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['notification.index', 'notification.members', 'notification.show', 'notification.search', 'notification.search.detail']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['notification.store'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['notification.update', 'notification.store']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['notification.destroy']
                ],
            ]
        ],
        'request_template' => [
            'name' => '申請テンプレート管理',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['template.index', 'api.template.show']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['template.store'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['template.update', 'template.show']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['api.template.destroy']
                ]
            ]
        ],
        'setting' => [
            'name' => 'Setting management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['api.setting.type', 'api.setting.level', 'api.setting.user.role', 's3.store', 'api.group.all', 'api.clinic.all', 'category.list.by.type', 'category.store']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['category.store'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => []
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => []
                ]
            ]
        ],

        'request' => [
            'name' => 'リクエスト管理',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['api.request.category.list', 'api.request.show', 'api.request.attachment.download']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['api.request.store'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['api.request.comment', 'api.request.change_status']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => []
                ]
            ]
        ],
        'inquiry' => [
            'name' => '問合せ管理',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['api.inquiry.category.list', 'api.inquiry.show', 'api.inquiry.attachment.download']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['api.inquiry.store'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['api.inquiry.comment', 'api.inquiry.change_status']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => []
                ]
            ]
        ],
        'page' => [
            'name' => 'ページ管理',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['page.index', 'page.blogs', 'page.blogLatest', 'page.manualLatest', 'page.faqLatest']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['page.store'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['page.show', 'page.update']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['page.destroy']
                ]
            ]
        ]
    ];
?>
