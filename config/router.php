<?php
    return [
        'user' => [
            'name' => 'User management',
            'groups' => [
                'view' => [
                        'name' => 'View list',
                        'routes' => [
                            'user.index',
                            'user.list'
                        ]
                    ],
                'create' => [
                        'name' => 'Create',
                        'routes' => ['user.create']
                    ],
                'update' => [
                        'name' => 'Update',
                        'routes' => ['user.update']
                    ],
                'delete' => [
                        'name' => 'Delete',
                        'routes' => ['user.destroy']
                    ]
            ]
        ],
        'category' => [
            'name' => 'Category management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['category.index']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['category.create']
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['category.update']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['category.destroy']
                ]
            ]
        ],
        'blog' => [
            'name' => 'Blog management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['blog.index']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['blog.create']
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['blog.update']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['blog.destroy']
                ]
            ]
        ],
        'tag' => [
            'name' => 'Tag management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['tag.index']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['tag.create']
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['tag.update']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['tag.destroy']
                ]
            ]
        ],
        'manager' => [
            'name' => 'Admin management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'routes' => ['manager.index']
                ],
                'create' => [
                    'name' => 'Create',
                    'routes' => ['manager.create']
                ],
                'update' => [
                    'name' => 'Update',
                    'routes' => ['manager.update']
                ],
                'delete' => [
                    'name' => 'Delete',
                    'routes' => ['manager.destroy']
                ]
            ]
        ]
    ];
?>
