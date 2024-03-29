<?php

use Claroline\CoreBundle\Library\Installation\Settings\AbstractValidator;
use Claroline\CoreBundle\Library\Installation\Settings\DatabaseChecker;
use Claroline\CoreBundle\Library\Installation\Settings\MailingChecker;

return array(
    'welcome' => 'Bienvenue',
    'welcome_message' => 'Cet assistant vous guidera à travers l\'installation de la plateforme.',
    'install_language' => 'Langue de l\'installation',
    'requirements_check' => 'Vérification de la configuration',
    'failed_requirement_msg' => 'L\'application ne fonctionnera pas correctement sur votre configuration actuelle. Veuillez résoudre les problèmes signalés en rouge et rafraîchir cette page.',
    'additional_failed_recommendation_msg'
        => 'Il est également recommandé de résoudre les problèmes signalés en orange, qui indiquent un défaut de configuration pouvant affecter négativement le comportement de l\'application ou ses performances.',
    'failed_recommendation_msg'
        => 'Votre configuration rencontre les exigences minimales pour faire tourner l\'application correctement, mais certains réglages peuvent affecter négativement son comportement ou ses performances. Pour résoudre ce problème, modifier les éléments indiqués en orange et rafraîchissez cette page.',
    'correct_configuration_msg' => 'Votre configuration répond à tous les critères requis et recommandés pour faire tourner l\'application correctement.',
    'correct_config' => 'Votre configuration est correcte.',
    'PHP version' => 'Version de PHP',
    'PHP version must be at least %version% (installed version is %installed_version%)'
        => 'La version de PHP doit être supérieure ou égale à %version% (la version actuellement installée est %installed_version%)',
    'PHP version 5.3.16 has known bugs which will prevent the application from working properly'
        => 'La version 5.3.16 de PHP comporte des bugs connus qui empêcheront l\'application de fonctionner correctement.',
    'PHP versions prior to 5.3.8 have known bugs which may prevent the application from working properly'
        => 'Les versions de PHP en-dessous de 5.3.8 comportent des bugs connus pouvant empêcher l\'application de fonctionner correctement.',
    'PHP version 5.4.0 has known bugs which may prevent the application from working properly'
        => 'La version 5.4.0 comporte des bugs connus pouvant empêcher l\'application de fonctionner correctement.',
    'PHP configuration' => 'Configuration de PHP',
    'Parameter date.timezone must be set in your php.ini' => 'Le paramètre <em>date.timezone</em> doit être présent dans votre <em>php.ini</em>.',
    'Your default timezone (%timezone%) is not supported' => 'Votre timezone par défaut (<em>%timezone%</em>) n\'est pas supportée.',
    'Parameter %parameter% must be set to %value% in your php.ini' => 'Le paramètre <em>%parameter%</em> doit être réglé à <em>%value%</em> dans votre php.ini.',
    'Parameter %parameter% should be set to %value% in your php.ini' => 'Le paramètre <em>%parameter%</em> devrait être réglé à <em>%value%</em> dans votre php.ini.',
    'PHP extensions' => 'Extensions de PHP',
    'Extension %extension% must be installed and enabled' => 'L\'extension <em>%extension%</em> doit être installée et activée.',
    'Extension %extension% should be installed and enabled' => 'L\'extension <em>%extension%</em> devrait être installée et activée.',
    'PDO must have some drivers installed (i.e. for MySQL, PostgreSQL, etc.)'
        => 'PDO doit avoir au moins un driver installé (i.e. pour MySQL, PostgreSQL, etc.).',
    'A PHP accelerator (like APC or XCache) should be installed and enabled (highly recommended)'
        => 'Un accélérateur PHP (comme APC or XCache) devrait être installé et activé (hautement recommandé).',
    'APC version must be at least %version%' => 'La version d\'APC doit être supérieur ou égale à %version%.',
    'Extension %extension% should not be enabled' => 'L\'extension <em>%extension%</em> ne devrait pas être active.',
    'Parameter %parameter% should be above 100 in php.ini' => 'Le paramètre <em>%parameter%</em> doit être réglé à plus de 100 dans votre php.ini.',
    'File permissions' => 'Permissions sur les fichiers',
    'The directory %directory% must be writable' => 'Le répertoire <em>%directory%</em> doit être accessible en écriture.',
    'The file %file% must be writable' => 'Le fichier <em>%file%</em> doit être accessible en écriture.',
    'database_parameters' => 'Paramètres de la base de données',
    'database_msg' => 'Entrez ici les paramètres de la base de données qui sera utilisée par l\'application. Si la base de données n\'existe pas, elle sera créée par cet installateur. Dans le cas contraire, la base doit impérativement être vide.',
    'driver' => 'Driver',
    'host' => 'Hôte',
    'database' => 'Base de données',
    'user' => 'Utilisateur',
    'password' => 'Mot de passe',
    'port' => 'Port',
    AbstractValidator::NOT_BLANK_EXPECTED => 'Cette valeur ne peut pas être vide',
    AbstractValidator::NUMBER_EXPECTED => 'Cette valeur doit être un nombre positif',
    AbstractValidator::INVALID_DRIVER => 'Ce driver n\'est pas valide',
    AbstractValidator::INVALID_EMAIL => 'Cette adresse email n\'est pas valide',
    AbstractValidator::INVALID_URL => 'Cette url n\'est pas valide',
    AbstractValidator::OVER_MAX_LENGTH => 'Cette valeur est trop longue',
    AbstractValidator::UNDER_MIN_LENGTH => 'Cette valeur est trop courte',
    AbstractValidator::INVALID_TRANSPORT => 'Transport non valide',
    AbstractValidator::INVALID_AUTH_MODE => 'Mode d\'authentification non valide',
    AbstractValidator::INVALID_ENCRYPTION => 'Cryptage non valide',
    DatabaseChecker::DATABASE_NOT_EMPTY
        => 'La base de données que vous avez sélectionnée n\'est pas vide. Veuillez en choisir une autre ou laisser cet installateur la créer pour vous.',
    DatabaseChecker::CANNOT_CONNECT_TO_SERVER
        => 'La connexion avec le serveur de bases de données ne peut pas être établie. Veuillez vérifier que les paramètres que vous avez fournis sont corrects.',
    DatabaseChecker::CANNOT_CONNECT_OR_CREATE
        => 'La connexion avec la base de données ne peut pas être établie et la base ne peut pas être créée. Vérifiez que l\'utilisateur que vous avez renseigné dispose des permissions nécessaires.',
    'platform_parameters' => 'Paramètres de la plateforme',
    'platform_msg' => 'Entrez ici quelques informations générales au sujet de votre plateforme. Vous pourrez modifier ces paramètres dans la section d\'administration de la plateforme une fois l\'application installée.',
    'language' => 'Langue',
    'name' => 'Nom',
    'support_email' => 'Email du support',
    'organization' => 'Organisation',
    'organization_url' => 'Site web',
    'admin_user' => 'Administrateur',
    'admin_msg' => 'Entrez ici les informations du compte du premier administrateur de la plateforme (c\'est-à-dire probablement <em>vous</em>).',
    'first_name' => 'Prénom',
    'last_name' => 'Nom',
    'username' => 'Nom d\'utilisateur',
    'email' => 'Email',
    'mail_server' => 'Serveur de mails',
    'mailing_msg' => 'Vous pouvez renseigner ici les paramètres nécessaires à l\'envoi d\'emails depuis la plateforme. Cette étape est optionnelle : vous pourrez fournir ces paramètres depuis la section d\'administration de la plateforme une fois l\'application installée.',
    MailingChecker::UNABLE_TO_START_TRANSPORT => 'La connexion avec le serveur de mails ne peut pas être établie. Veuillez vérifier que les paramètres que vous avez renseignés sont corrects.',
    MailingChecker::UNABLE_TO_START_SENDMAIL => 'La connexion avec Sendmail ou Postfix ne peut pas être établie. Veuillez vérifier qu\'un de ces logiciels est installé et correctement configuré.',
    MailingChecker::UNABLE_TO_START_GMAIL => 'La connexion avec le service SMTP de Gmail ne peut pas être établie. Veuillez vérifier que le nom d`utilisateur et le mot de passe que vous avez renseignés sont corrects.',
    MailingChecker::UNABLE_TO_START_SMTP => 'La connexion avec le serveur SMTP ne peut pas être établie. Veuillez vérifier que les paramètres que vous avez renseignés sont corrects.',
    'transport' => 'Transport',
    'encryption' => 'Cryptage',
    'auth_mode' => 'Authentification',
    'installation' => 'Installation',
    'pre_install_msg' => 'L\'application est prête à être installée. Vous pouvez revenir aux étapes précédentes pour vérifier que les paramètres que vous avez renseignés sont corrects ou procéder à l\'installation maintenant.',
    'do_install' => 'Démarrer l\'installation',
    'previous_step' => 'Précédent',
    'skip_step' => 'Passer cette étape',
    'next_step' => 'Suivant',
    'test_again' => 'Réessayer',
    'please_wait' => 'Veuillez patienter'
);
