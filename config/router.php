<?php
    return [
        'user' => [
            'name' => 'User management',
            'groups' => [
                'view' => [
                        'name' => 'View list',
                        'route_name' => ['user.index']
                    ],
                'create' => [
                        'name' => 'Create',
                        'route_name' => 'user.create'
                    ],
                'update' => [
                        'name' => 'Update',
                        'route_name' => 'user.update'
                    ],
                'delete' => [
                        'name' => 'Delete',
                        'route_name' => 'user.destroy'
                    ]
            ]
        ],
        'category' => [
            'name' => 'Category management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'route_name' => 'category.index'
                ],
                'create' => [
                    'name' => 'Create',
                    'route_name' => 'category.create'
                ],
                'update' => [
                    'name' => 'Update',
                    'route_name' => 'category.update'
                ],
                'delete' => [
                    'name' => 'Delete',
                    'route_name' => 'category.destroy'
                ]
            ]
        ],
        'blog' => [
            'name' => 'Blog management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'route_name' => 'blog.index'
                ],
                'create' => [
                    'name' => 'Create',
                    'route_name' => 'blog.create'
                ],
                'update' => [
                    'name' => 'Update',
                    'route_name' => 'blog.update'
                ],
                'delete' => [
                    'name' => 'Delete',
                    'route_name' => 'blog.destroy'
                ]
            ]
        ],
        'tag' => [
            'name' => 'Tag management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'route_name' => 'tag.index'
                ],
                'create' => [
                    'name' => 'Create',
                    'route_name' => 'tag.create'
                ],
                'update' => [
                    'name' => 'Update',
                    'route_name' => 'tag.update'
                ],
                'delete' => [
                    'name' => 'Delete',
                    'route_name' => 'tag.destroy'
                ]
            ]
        ],
        'manager' => [
            'name' => 'Permission management',
            'groups' => [
                'view' => [
                    'name' => 'View list',
                    'route_name' => 'manager.index'
                ],
                'create' => [
                    'name' => 'Create',
                    'route_name' => 'manager.create'
                ],
                'update' => [
                    'name' => 'Update',
                    'route_name' => 'manager.update'
                ],
                'delete' => [
                    'name' => 'Delete',
                    'route_name' => 'manager.destroy'
                ]
            ]
        ]
    ];
?>
