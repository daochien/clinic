<?php
    return [
        'role' => [
            'name' => 'Role management',
            'groups' => [
                'view' => [
                        'name' => 'View list',
                        'routes' => ['role.index','role.list']
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
                    'routes' => ['manager.index', 'role.list', 'role.index']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['manager.create', 'role.list', 'role.index'],
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['manager.update', 'role.list', 'role.index']
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
                    'routes' => []
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => [],
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
        'staff' => [
            'name' => 'Staff management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => []
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => [],
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
        'group' => [
            'name' => 'Group management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => []
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => [],
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
        'notification' => [
            'name' => 'Notification management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => []
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => [],
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
        'request_template' => [
            'name' => 'Request template management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => []
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => [],
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
            'name' => 'Request management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => []
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => [],
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
        'inquiry' => [
            'name' => 'Inquiry management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => []
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => [],
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
        'page' => [
            'name' => 'Page management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => []
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => [],
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
        ]
    ];
?>
