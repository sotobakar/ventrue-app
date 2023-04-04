<?php
return [
  'MENU' => [
    'ORGANIZATION' => [
      'HOME' => [
        'name' => 'Dashboard',
        'route' => 'organization.dashboard',
        'path' => 'ormawa',
        'icon' => 'fa-home'
      ],
      'EVENT' => [
        'name' => 'Acara',
        'route' => 'organization.events',
        'path' => 'ormawa/acara*',
        'icon' => 'fa-calendar'
      ],
      'APPROVAL' => [
        'name' => 'Persetujuan',
        'route' => 'organization.approvals',
        'path' => 'ormawa/persetujuan*',
        'icon' => 'fa-check'
      ],
      'PROFILE' => [
        'name' => 'Profil',
        'route' => 'organization.profile',
        'path' => 'ormawa/profil*',
        'icon' => 'fa-user'
      ],
      'LOGOUT' => [
        'name' => 'Logout',
        'route' => 'organization.logout',
        'path' => 'ormawa/logout',
        'icon' => 'fa-sign-out'
      ],
    ],
    'ADMIN' => [
      'HOME' => [
        'name' => 'Dashboard',
        'route' => 'admin.dashboard',
        'path' => 'admin',
        'icon' => 'fa-home'
      ],
      'STUDENT' => [
        'name' => 'Mahasiswa',
        'route' => 'admin.students',
        'path' => 'admin/mahasiswa*',
        'icon' => 'fa-users-class'
      ],
      'ORGANIZATION' => [
        'name' => 'Ormawa',
        'route' => 'admin.organizations',
        'path' => 'admin/ormawa*',
        'icon' => 'fa-sitemap'
      ],
      'EVENT' => [
        'name' => 'Acara',
        'route' => 'admin.events',
        'path' => 'admin/acara*',
        'icon' => 'fa-calendar'
      ],
      'CONTENT' => [
        'name' => 'Konten',
        'route' => 'admin.content',
        'path' => 'admin/konten*',
        'icon' => 'fa-ad'
      ],
      'APPROVER' => [
        'name' => 'Penyetuju',
        'route' => 'admin.approvers',
        'path' => 'admin/penyetuju*',
        'icon' => 'fa-check'
      ],
      'LOGOUT' => [
        'name' => 'Logout',
        'route' => 'admin.logout',
        'path' => 'admin/logout',
        'icon' => 'fa-sign-out'
      ],
    ],
    'STUDENT' => [],
  ],
  'STUDENT' => [
    'PROFILE' => [
      'IMAGE' => [
        'WIDTH' => 400,
        'HEIGHT' => 600,
      ],
    ],
  ],
  'EVENT' => [
    'TYPES' => [
      0 => 'online',
      1 => 'offline',
      2 => 'hybrid'
    ],
    'STATUS' => [
      0 => 'Belum Dimulai',
      1 => 'Sedang Berlangsung',
      2 => 'Selesai'
    ],
    'BANNER' => [
      'WIDTH' => 600,
      'HEIGHT' => 337.5
    ],
    'APPROVAL' => [
      'STORAGE' => [
        'path' => 'events/approvals'
      ],
      'STATUS' => [
        0 => 'Belum Disetujui',
        1 => 'Disetujui'
      ]
    ]
  ],
  'ORGANIZATION' => [
    'LEVEL' => [
      0 => 'Fakultas',
      1 => 'Universitas'
    ],
  ]
];
