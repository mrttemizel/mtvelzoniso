<?php

return [
    'titles' => [
        'index' => 'Kullanıcılar',
        'create' => 'Yeni Kullanıcı Ekle'
    ],

    'buttons' => [
        'create' => 'Yeni Kullanıcı Ekle',
        'reset-password' => 'Şifre Sıfırla'
    ],

    'success' => [
        'created' => 'Yeni kullanıcı kaydı başarıyla oluşturuldu.',
        'updated' => 'Kullanıcı bilgileri başarıyla güncellendi.',
        'deleted' => 'Kullanıcı başarıyla silindi.',
        'reset-password' => 'Kullanıcıya şifre sıfırlama maili gönderildi.'
    ],

    'errors' => [
        'reset-password' => 'Şifre sıfırlama maili gönderilemedi, lütfen daha sonra tekrar deneyin.'
    ],

    'inputs' => [
        'name' => 'Tam Adınız',
        'email' => 'E-Posta Adresi',
        'phone' => 'Telefon',
        'avatar' => 'Profil Resmi',
        'roles' => [
            'label' => 'Rol',
            'placeholder' => 'Bir rol seçiniz',
            'options' => [
                \App\Models\User::ROLE_SUPER_ADMIN => 'Super Admin',
                \App\Models\User::ROLE_ADMIN => 'Admin',
                \App\Models\User::ROLE_AGENCY => 'Acente',
                \App\Models\User::ROLE_STUDENT => 'Öğrenci'
            ]
        ]
    ],

    'texts' => [
        'no-agencies' => 'İlk önce acente kayıt etmelisiniz!'
    ],

    'tables' => [
        'id' => '#',
        'name' => 'Tam Adı',
        'actions' => 'İşlemler',
    ]
];
