<?php
    return [
        'role' => [
            'name' => 'Role management',
            'groups' => [
                'view' => [
                        'name' => 'View list',
                        'routes' => ['role.index']
                    ],
                'create' => [
                        'name' => 'Create',
                        'routes' => ['role.create']
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
            'name' => 'Admin management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['manager.index', 'role.list']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['manager.create', 'role.list'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['manager.update', 'manager.show', 'role.list']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['manager.destroy']
                ]
            ]
        ],
        'clinic' => [
            'name' => 'Clinic management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['clinic.index', 'api.clinic.all']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['clinic.create', 'clinic.get.users', 'clinic.add.users'],
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
            'name' => 'Staff management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['user.index', 'api.user.search', 'api.group.all', 'api.setting.level', 'api.setting.type', 'api.clinic.all']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['user.create', 'api.group.all', 'api.setting.level', 'api.setting.type', 'api.clinic.all'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['user.show', 'user.update', 'api.group.all', 'api.setting.level', 'api.setting.type', 'api.clinic.all']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['user.destroy']
                ]
            ]
        ],
        'group' => [
            'name' => 'Group management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['group.index']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['group.create'],
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
            'name' => 'Notification management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['notification.index', 'api.group.all']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['notification.create', 'api.group.all'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['notification.update', 'notification.show', 'api.group.all']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['notification.destroy']
                ]
            ]
        ],
        'request_template' => [
            'name' => 'Request template management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['template.index']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['template.create'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['template.update', 'template.show']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['template.destroy']
                ]
            ]
        ],
        // 'request' => [
        //     'name' => 'Request management',
        //     'groups' => [
        //         'view' => [
        //             'name' => 'View list',
        //             'routes' => []
        //         ],
        //         'create' => [
        //             'name' => 'Create',
        //             'routes' => [],
        //         ],
        //         'update' => [
        //             'name' => 'Update',
        //             'routes' => []
        //         ],
        //         'delete' => [
        //             'name' => 'Delete',
        //             'routes' => []
        //         ]
        //     ]
        // ],
        // 'inquiry' => [
        //     'name' => 'Inquiry management',
        //     'groups' => [
        //         'view' => [
        //             'name' => 'View list',
        //             'routes' => []
        //         ],
        //         'create' => [
        //             'name' => 'Create',
        //             'routes' => [],
        //         ],
        //         'update' => [
        //             'name' => 'Update',
        //             'routes' => []
        //         ],
        //         'delete' => [
        //             'name' => 'Delete',
        //             'routes' => []
        //         ]
        //     ]
        // ],
        // 'page' => [
        //     'name' => 'Page management',
        //     'groups' => [
        //         'view' => [
        //             'name' => 'View list',
        //             'routes' => []
        //         ],
        //         'create' => [
        //             'name' => 'Create',
        //             'routes' => [],
        //         ],
        //         'update' => [
        //             'name' => 'Update',
        //             'routes' => []
        //         ],
        //         'delete' => [
        //             'name' => 'Delete',
        //             'routes' => []
        //         ]
        //     ]
        // ]
    ];
?>
