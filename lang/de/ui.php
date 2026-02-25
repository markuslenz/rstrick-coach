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
        'page_title' => 'Willkommen',
        'title' => 'Was ist <b>RS Trick Coach</b>?',
        'description' => '
            <b>RS Trick Coach</b> ist eine App, die Dich dabei unterstützen soll, die Tricks im Rope Skipping zu lernen. Die Idee ist, durch viel Wiederholung die Tricks so gut zu kennen, dass man als Kampfrichter die Tricks schneller bewerten kann.
            <br/>
            Die Idee zu diesem Projekt kam mir, als ich eine Ausbildung zum Rope Skipping-Kampfrichter absolvierte. Als nicht aktiver Springer fiel es mir schwer, die Sprünge schnell zu erkennen und zu bewerten. Da kam mir die Idee, eine Website/App zu erstellen, auf der man Seilspringsprünge auf Video ansehen und den entsprechenden Schwierigkeitsgrad und die Art des Kampfrichters eingeben kann.
            <br/>
            Die Ausbildung basiert auf dem Bewertungssystems des Deutschen Turner-Bundes (DTB), das auf den Regeln 4.0.0 der IJRU basiert.
            <br/>
            Diese Website/App ist kein Ersatz für eine Kampfrichteruasbildung oder eine offizielle IJRU-Ausbildung, sondern eine Ergänzung, um das Erlernen der Tricks zu erleichtern.',
    ],
    'login' => [
        'forgot_pwd' => 'Passwort vergessen?',
        'remember' => 'Angemeldet bleiben',
        'register_txt' => 'Du hast noch kein Konto?',
        'sign_up' => 'Jetzt registrieren',
        'title' => 'Melde Dich bei Deinem Konto an',
        'description' => 'Gib unten Deine E-Mail-Adresse und Dein Passwort ein, um Dich anzumelden.',
        'page_title' => 'Anmeldung',
    ],
    'register' => [
        'page_title' => 'Registrierung',
        'title' => 'Erstelle Dir ein Konto',
        'description' => 'Gib unten Deine Daten ein, um Dein Konto zu erstellen',
        'already_registered' => 'Du hast schon ein Konto?',
    ],
    'alertError' => [
        'title' => 'Es ist etwas schief gelaufen.',
    ],
    'alert' => [
        'title' => 'Benachrichtigung!',
    ],
    'appearance_tabs' => [
        'light' => 'Hell',
        'dark' => 'Dunkel',
        'system' => 'System',
    ],
    'app_header' => [
        'nav_menu' => 'Navigationsmenü',
    ],
    'tricks' => [
        'title' => 'Tricks',
    ],
    'judges' => [
        'title' => 'Kampfrichter',
    ],
    'dashboard' => [
        'title' => 'Dashboard',
    ],
    'trainings' => [
        'title' => 'Training',
    ],
    'alerts' => [
        'warning' => 'Warnung',
    ],
    'delete_user' => [
        'title' => 'Konto löschen',
        'description' => 'Lösche Dein Konto und alle darin enthaltenen Ressourcen.',
        'warning_msg' => 'Bitte sei vorsichtig, dieser Vorgang kann nicht rückgängig gemacht werden.',
        'dialog_header' => 'Bist Du sicher, dass Du Dein Konto löschen möchtest?',
        'dialog_descr' => 'Sobald Dein Konto gelöscht ist, werden auch alle darin enthaltenen Ressourcen und Daten dauerhaft gelöscht. Bitte gib Dein Passwort ein, um zu bestätigen, dass Du Dein Konto dauerhaft löschen möchtest.',
    ],
    'nav_footer' => 'Admin-Menü',
    'nav_main' => 'Benutzer-Menü',
    'two_factor_recovery' => [
        'card_title' => '2FA Wiederherstellungscodes',
        'card_descr' => 'Mit Wiederherstellungscodes kannst Du wieder Zugriff erhalten, wenn Du Dein 2FA-Gerät verlierst. Speichere diese in einem sicheren Passwort-Manager',
        'hint' => 'Jeder Wiederherstellungscode kann einmalig für den Zugriff auf Dein Konto verwendet werden und wird nach der Verwendung gelöscht. Wenn Du weitere Codes benötigst, klicke oben auf <span class="font-bold">Codes neu generieren</span>.'
    ],
    'two_factor_setup' => [
        'enabled' => [
            'title' => 'Zwei-Faktor-Authentifizierung aktiviert',
            'description' => 'Die Zwei-Faktor-Authentifizierung ist jetzt aktiviert. Scanne den QR-Code oder gib den Einrichtungsschlüssel in Deine Authentifizierungs-App ein.',
        ],
        'show' => [
            'title' => 'Authentifizierungscode überprüfen',
            'description' => 'Gib den 6-stelligen Code aus Deiner Authentifizierungs-App ein.',
        ],
        'default' => [
            'title' => 'Zwei-Faktor-Authentifizierung aktivieren',
            'description' => 'Um die Zwei-Faktor-Authentifizierung zu aktivieren, scanne den QR-Code oder gib den Einrichtungsschlüssel in Deine Authentifizierungs-App ein.',
        ],
        'text' => 'oder gib den Code manuell ein',
    ],
    'user_menu_content' => [
        'settings' => 'Einstellungen',
    ],
    'confirm_password' => [
        'title' => 'Bestätige Dein Passwort',
        'description' => 'Dies ist ein sicherer Bereich der Anwendung. Bitte bestätige Dein Passwort, bevor Du fortfährst.',
        'page_title' => 'Passwortbestätigung',
    ],
    'forgot_password' => [
        'title' => 'Passwort vergessen',
        'description' => 'Gib Deine E-Mail-Adresse ein, um einen Link zum Zurücksetzen Deines Passworts zu erhalten.',
        'page_title' => 'Passwort vergessen',
        'text' => 'Oder gehe zurück zu ',
    ],
    'reset_password' => [
        'title' => 'Passwort zurücksetzen',
        'description' => 'Bitte gib unten Dein neues Passwort ein.',
        'page_title' => 'Passwort zurücksetzen',
    ],
    'appearance' => [
        'title' => 'Darstellungseinstellungen',
        'description' => 'Aktualisiere die Darstellungseinstellungen Deines Kontos.',
        'page_title' => 'Darstellungseinstellungen',
    ],
    'two_factor_challenge' => [
        'show' => [
            'title' => 'Wiederherstellungscode',
            'description' => 'Bitte bestätige den Zugriff auf Dein Konto, indem Du einen Deiner Notfall-Wiederherstellungscodes eingeben.',
            'toggle' => 'Anmeldung mit einem Authentifizierungscode',
        ],
        'default' => [
            'title' => 'Authentifizierungscode',
            'description' => 'Gib den Authentifizierungscode ein, den Du von DEiner Authentifizierungsanwendung erhalten haben.',
            'toggle' => 'Anmeldung mit einem Wiederherstellungscode',
        ],
        'page_title' => 'Zwei-Faktor-Authentifizierung',
        'or_you_can' => 'oder Du kannst ',
    ],
    'verify_email' => [
        'title' => 'E-Mail bestätigen',
        'description' => 'Bitte bestätige Deine E-Mail-Adresse, indem Du auf den Link klickst, den wir Dir gerade per E-Mail zugesandt haben.',
        'page_title' => 'E-Mail-Bestätigung',
        'hint' => 'Ein neuer Bestätigungslink wurde an die E-Mail-Adresse gesendet, die Du bei der Registrierung angegeben hast.',
    ],
    'password' => [
        'page_title' => 'Passworteinstellungen',
        'title' => 'Passwort ändern',
        'description' => 'Stelle sicher, dass Dein Konto ein langes, zufälliges Passwort verwendet, um sicher zu bleiben.',
        'saved' => 'Gespeichert.',
    ],
    'profile' => [
        'page_title' => 'Profileinstellungen',
        'title' => 'Profilinformationen',
        'description' => 'Aktualisiere Deinen Namen und Deine E-Mail-Adresse.',
        'unverified' => 'Deine E-Mail-Adresse ist nicht verifiziert.',
        'resend' => 'Klicke hier, um die Bestätigungs-E-Mail erneut zu senden.',
        'verification' => 'Ein neuer Bestätigungslink wurde an Deine E-Mail-Adresse gesendet.'
    ],
    'two_factor' => [
        'page_title' => 'Zwei-Faktor-Authentifizierung',
        'title' => 'Zwei-Faktor-Authentifizierung',
        'description' => 'Verwalte Deine Einstellungen für die Zwei-Faktor-Authentifizierung',
        'disabled' => 'Deaktiviert',
        'disabled_hint' => 'Wenn Du die Zwei-Faktor-Authentifizierung aktivierst, wirst Du bei der Anmeldung zur Eingabe einer Sicherheits-PIN aufgefordert. Diese PIN kann über eine TOTP-unterstützte Anwendung auf Deinem Smartphone abgerufen werden.',
        'enabled' => 'Aktiviert',
        'enabled_hint' => 'Wenn die Zwei-Faktor-Authentifizierung aktiviert ist, wirst Du bei der Anmeldung zur Eingabe einer sicheren, zufällig generierten PIN aufgefordert, die Du über die TOTP-unterstützte Anwendung auf Deinem Smartphone abrufen kannst.',
    ],
    'settings' => [
        'page_title' => 'Einstellungen',
        'title' => 'Einstellungen',
        'description' => 'Verwalte Dein Profil und Deine Kontoeinstellung',
        'nav' => [
            'profile' => 'Profil',
            'password' => 'Passwort',
            '2fa' => '2FA-Authentifizierung',
            'appearance' => 'Darstellung',
        ],
    ],
    'users' => [
        'title' => 'Benutzerverwaltung',
        'dialog' => [
            'title' => 'Benutzer löschen',
            'description' => 'Bist Du Dir sicher, dass Du den folgenden Benutzer löschen willst: ',
        ],
        'edit_user' => 'Benutzer bearbeiten',
    ],
];