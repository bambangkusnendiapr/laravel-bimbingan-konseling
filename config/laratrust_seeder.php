<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadmin' => [
            'guru' => 'c,r,u,d',
            'siswa' => 'c,r,u,d',
            'bimbingan' => 'c,r,u,d',
            'pelanggaran' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'guru' => [
            'guru' => 'c,r,u,d',
            'siswa' => 'c,r,u,d',
            'bimbingan' => 'c,r,u,d',
            'pelanggaran' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'siswa' => [
            'profile' => 'r,u',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
