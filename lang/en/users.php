<?php

return [
    'titles' => [
        'index' => 'Users',
        'create' => 'Add New User'
    ],

    'buttons' => [
        'create' => 'Add New User',
        'reset-password' => 'Reset Password'
    ],

    'success' => [
        'created' => 'New user record created successfully.',
        'updated' => 'User information updated successfully.',
        'deleted' => 'User deleted successfully.',
        'reset-password' => 'Password reset email sent to the user.'
    ],

    'errors' => [
        'reset-password' => 'Failed to send password reset email, please try again later.'
    ],

    'inputs' => [
        'name' => 'Full Name',
        'email' => 'Email Address',
        'phone' => 'Phone',
        'avatar' => 'Profile Picture',
        'roles' => [
            'label' => 'Role',
            'placeholder' => 'Select a role',
            'options' => [
                \App\Models\User::ROLE_SUPER_ADMIN => 'Super Admin',
                \App\Models\User::ROLE_ADMIN => 'Admin',
                \App\Models\User::ROLE_AGENCY => 'Agency',
                \App\Models\User::ROLE_STUDENT => 'Student'
            ]
        ]
    ],

    'texts' => [
        'no-agencies' => 'You must first register an agency!'
    ],

    'tables' => [
        'id' => '#',
        'name' => 'Full Name',
        'actions' => 'Actions',
    ]
];
