<?php

return [
    /*
    |--------------------------------------------------------------------------
    | UI Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default UI messages Some of 
    | these rules have multiple versions such as the size rules. Feel free to 
    | tweak each of these messages here.
    |
    */
    'welcome' => [
        'page_title' => 'Welcome',
        'title' => 'What is <b>RS Trick Coach</b>?',
        'description' => '
            <b>RS Trick Coach</b> is an app designed to help you learn rope skipping tricks. The idea is that through lots of repetition, you will become so familiar with the tricks that you will be able to judge them more quickly as a referee.
            <br/>
            The idea for the project came to me when I was training to become a rope skipping judge. As a non-active jumper, I found it difficult to quickly identify and evaluate the jumps. I then had the idea of creating a website/app where you can watch rope skipping jumps on video and enter the corresponding level of difficulty and type of judge.
            <br/>
            The training is based on the Deutscher Turner Bund (DTB) evaluation system, which is based on the IJRU\'s 4.0.0 rules.
            <br/>
            This site is not a substitute for a judge training or official IJRU training; rather, it is a supplement to make it easier to learn the tricks.',
    ],
    'login' => [
        'forgot_pwd' => 'Forgot password?',
        'remember' => 'Remember me',
        'register_txt' => 'Don\'t have an account?',
        'sign_up' => 'Sign up',
        'title' => 'Log in to your account',
        'description' => 'Enter your email and password below to log in',
        'page_title' => 'Log In',
    ],
    'register' => [
        'page_title' => 'Register',
        'title' => 'Create an account',
        'description' => 'Enter your details below to create your account',
        'already_registered' => 'Already have an account?',
    ],
    'alert_error' => [
        'title' => 'Something went wrong.',
    ],
    'alert' => [
        'title' => 'Notification!',
    ],
    'appearance_tabs' => [
        'light' => 'Light',
        'dark' => 'Dark',
        'system' => 'System',
    ],
    'app_header' => [
        'nav_menu' => 'Navigation Menu',
    ],
    'tricks' => [
        'title' => 'Tricks',
    ],
    'judges' => [
        'title' => 'Judge Types',
    ],
    'dashboard' => [
        'title' => 'Dashboard',
    ],
    'trainings' => [
        'title' => 'Trainings',
    ],
    'alerts' => [
        'warning' =>  'Warning',
    ],
    'delete_user' => [
        'title' => 'Delete account',
        'description' => 'Delete your account and all of its resources',
        'warning_msg' => 'Please proceed with caution, this cannot be undone.',
        'dialog_header' => 'Are you sure you want to delete your account?',
        'dialog_descr' => 'Once your account is deleted, all of its resources and data will also be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.',
    ],
    'nav_footer' => 'Admin Menu',
    'nav_main' => 'User Menu',
    'two_factor_recovery' => [
        'card_title' => '2FA Recovery Codes',
        'card_descr' => 'Recovery codes let you regain access if you lose your 2FA device. Store them in a secure password manager.',
        'hint' => 'Each recovery code can be used once to access your account and will be removed after use. If you need more, click <span class="font-bold">Regenerate Codes</span> above.'
    ],
    'two_factor_setup' => [
        'enabled' => [
            'title' => 'Two-Factor Authentication Enabled',
            'description' => 'Two-factor authentication is now enabled. Scan the QR code or enter the setup key in your authenticator app.',
        ],
        'show' => [
            'title' => 'Verify Authentication Code',
            'description' => 'Enter the 6-digit code from your authenticator app',
        ],
        'default' => [
            'title' => 'Enable Two-Factor Authentication',
            'description' => 'To finish enabling two-factor authentication, scan the QR code or enter the setup key in your authenticator app',
        ],
        'text' => 'or, enter the code manually',
    ],
    'user_menu_content' => [
        'settings' => 'Settings',
    ],
    'confirm_password' => [
        'title' => 'Confirm your password',
        'description' => 'This is a secure area of the application. Please confirm your password before continuing.',
        'page_title' => 'Confirm password',
    ],
    'forgot_password' => [
        'title' => 'Forgot password',
        'description' => 'Enter your email to receive a password reset link',
        'page_title' => 'Forgot password',
        'text' => 'Or, return to',
    ],
    'reset_password' => [
        'title' => 'Reset password',
        'description' => 'Please enter your new password below',
        'page_title' => 'Reset password',
    ],
    'appearance' => [
        'title' => 'Appearance settings',
        'description' => 'Update your account\'s appearance settings',
        'page_title' => 'Appearance settings',
    ],
    'two_factor_challenge' => [
        'show' => [
            'title' => 'Recovery Code',
            'description' => 'Please confirm access to your account by entering one of your emergency recovery codes.',
            'toggle' => 'login using an authentication code',
        ],
        'default' => [
            'title' => 'Authentication Code',
            'description' => 'Enter the authentication code provided by your authenticator application.',
            'toggle' => 'login using a recovery code',
        ],
        'page_title' => 'Two-Factor Authentication',
        'or_you_can' => 'or you can',
    ],
    'verify_email' => [
        'title' => 'Verify email',
        'description' => 'Please verify your email address by clicking on the link we just emailed to you.',
        'page_title' => 'Email verification',
        'hint' => 'A new verification link has been sent to the email address you provided during registration.',
    ],
    'password' => [
        'page_title' => 'Password Settings',
        'title' => 'Update password',
        'description' => 'Ensure your account is using a long, random password to stay secure',
        'saved' => 'Saved.',
    ],
    'profile' => [
        'page_title' => 'Profile Settings',
        'title' => 'Profile information',
        'description' => 'Update your name and email address',
        'unverified' => 'Your email address is unverified.',
        'resend' => 'Click here to resend the verification email.',
        'verification' => 'A new verification link has been sent to your email address.'
    ],
    'two_factor' => [
        'page_title' => 'Two-Factor Authentication',
        'title' => 'Two-Factor Authentication',
        'description' => 'Manage your two-factor authentication settings',
        'disabled' => 'Disabled',
        'disabled_hint' => 'When you enable two-factor authentication, you will be prompted for a secure pin during login. This pin can be retrieved from a TOTP-supported application on your phone.',
        'enabled' => 'Enabled',
        'enabled_hint' => 'With two-factor authentication enabled, you will be prompted for a secure, random pin during login, which you can retrieve from the TOTP-supported application on your phone.',
    ],
    'settings' => [
        'page_title' => 'Settings',
        'title' => 'Settings',
        'description' => 'Manage your profile and account settings',
        'nav' => [
            'profile' => 'Profile',
            'password' => 'Password',
            '2fa' => 'Two-Factor Auth',
            'appearance' => 'Appearance',
        ],
    ],
    'users' => [
        'title' => 'User Administration',
        'dialog' => [
            'title' => 'Delete User',
            'description' => 'Are you sure you want to delete the User',
        ],
        'edit_user' => 'Edit User',
    ],
    'locales' => [
        'de' => 'German',
        'en' => 'English',
    ],
];