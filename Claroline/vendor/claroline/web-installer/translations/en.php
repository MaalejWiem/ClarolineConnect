<?php

use Claroline\CoreBundle\Library\Installation\Settings\AbstractValidator;
use Claroline\CoreBundle\Library\Installation\Settings\DatabaseChecker;
use Claroline\CoreBundle\Library\Installation\Settings\MailingChecker;

return array(
    'welcome' => 'Welcome',
    'welcome_message' => 'This assistant will guide you through the platform installation.',
    'install_language' => 'Installation language',
    'requirements_check' => 'Configuration checking',
    'failed_requirement_msg' => 'The application will not run correctly on your current configuration. Please fix the items highlighted in red and refresh this page.',
    'additional_failed_recommendation_msg'
        => 'It is also recommended to fix any item highlighted in orange, as it indicates settings that may impact negatively the application behaviour or performance.',
    'failed_recommendation_msg'
        => 'Your configuration meet the minimal requirements to run the application, but some settings may impact negatively its behaviour or performance. To solve this problem, fix the items highlighted in orange and refresh this page.',
    'correct_configuration_msg' => 'Your configuration meets all the requirements and recommendations to run the application correctly.',
    'correct_config' => 'Your configuration is correct.',
    'PHP version' => 'PHP version',
    'PHP version must be at least %version% (installed version is %installed_version%)'
        => 'PHP version must be at least %version% (installed version is %installed_version%)',
    'PHP version 5.3.16 has known bugs which will prevent the application from working properly'
        => 'PHP version 5.3.16 has known bugs which will prevent the application from working properly.',
    'PHP versions prior to 5.3.8 have known bugs which may prevent the application from working properly'
        => 'PHP versions prior to 5.3.8 have known bugs which may prevent the application from working properly.',
    'PHP version 5.4.0 has known bugs which may prevent the application from working properly'
        => 'PHP version 5.4.0 has known bugs which may prevent the application from working properly.',
    'PHP configuration' => 'PHP configuration',
    'Parameter date.timezone must be set in your php.ini' => 'Parameter <em>date.timezone</em> must be set in your <em>php.ini</em>.',
    'Your default timezone (%timezone%) is not supported' => 'Your default timezone (<em>%timezone%</em>) is not supported.',
    'Parameter %parameter% must be set to %value% in your php.ini' => 'Parameter <em>%parameter%</em> must be set to <em>%value%</em> in your php.ini.',
    'Parameter %parameter% should be set to %value% in your php.ini' => 'Parameter <em>%parameter%</em> should be set to <em>%value%</em> in your php.ini.',
    'PHP extensions' => 'PHP extensions',
    'Extension %extension% must be installed and enabled' => 'Extension <em>%extension%</em> must be installed and enabled.',
    'Extension %extension% should be installed and enabled' => 'Extension <em>%extension%</em> should be installed and enabled.',
    'PDO must have some drivers installed (i.e. for MySQL, PostgreSQL, etc.)'
        => 'PDO must have some drivers installed (i.e. for MySQL, PostgreSQL, etc.).',
    'A PHP accelerator (like APC or XCache) should be installed and enabled (highly recommended)'
        => 'A PHP accelerator (like APC or XCache) should be installed and enabled (highly recommended).',
    'APC version must be at least %version%' => 'APC version must be at least %version%.',
    'Extension %extension% should not be enabled' => 'Extension <em>%extension%</em> should not be enabled.',
    'Parameter %parameter% should be above 100 in php.ini' => 'Parameter <em>%parameter%</em> should be above 100 in your php.ini.',
    'File permissions' => 'File permissions',
    'The directory %directory% must be writable' => 'The directory <em>%directory%</em> must be writable.',
    'The file %file% must be writable' => 'The file <em>%file%</em> must be writable.',
    'database_parameters' => 'Database parameters',
    'database_msg' => 'Enter here the parameters of the database that will be used by the application. If the database doesn\'t exist, it will be created. Otherwise, it must be empty.',
    'driver' => 'Driver',
    'host' => 'Host',
    'database' => 'Database',
    'user' => 'User',
    'password' => 'Password',
    'port' => 'Port',
    AbstractValidator::NOT_BLANK_EXPECTED => 'This value should not be blank',
    AbstractValidator::NUMBER_EXPECTED => 'This value should be a positive number',
    AbstractValidator::INVALID_DRIVER => 'This driver is not valid',
    AbstractValidator::INVALID_EMAIL => 'This email address is not valid',
    AbstractValidator::INVALID_URL => 'This url is not valid',
    AbstractValidator::OVER_MAX_LENGTH => 'This value is too long',
    AbstractValidator::UNDER_MIN_LENGTH => 'This value is too short',
    AbstractValidator::INVALID_TRANSPORT => 'Invalid transport',
    AbstractValidator::INVALID_AUTH_MODE => 'Invalid authentication mode',
    AbstractValidator::INVALID_ENCRYPTION => 'Invalid encryption',
    DatabaseChecker::DATABASE_NOT_EMPTY
        => 'The database you have selected is not empty. Please choose another one or let this installer create it for you.',
    DatabaseChecker::CANNOT_CONNECT_TO_SERVER
        => 'The connection with the database server cannot be established. Please check the parameters you provided are correct.',
    DatabaseChecker::CANNOT_CONNECT_OR_CREATE
        => 'The connection with the database cannot be established and the database cannot be created. Please check that the database user you have selected has sufficient permissions.',
    'platform_parameters' => 'Platform parameters',
    'platform_msg' => 'Enter here general information about your platform. These parameters will be editable in the administration section of the platform once the application is installed.',
    'language' => 'Language',
    'name' => 'Name',
    'support_email' => 'Support email',
    'organization' => 'Organization',
    'organization_url' => 'Website',
    'admin_user' => 'Administrator',
    'admin_msg' => 'Enter here the account details of the first administrator of the platform (i.e. probably <em>you</em>).',
    'first_name' => 'First name',
    'last_name' => 'Last name',
    'username' => 'Username',
    'email' => 'Email',
    'transport' => 'Transport',
    'mail_server' => 'Mail server',
    'mailing_msg' => 'You can enter here the parameters required for sending emails from the platform. This step is optional: you will be able to specifiy these parameters from the administration section of the platform once the application is installed.',
    MailingChecker::UNABLE_TO_START_TRANSPORT => 'The mailing transport cannot be started. Please check that the parameters you provided are correct.',
    MailingChecker::UNABLE_TO_START_SENDMAIL => 'Sendmail or Postfix cannot be started. Please check that one of them is installed and correctly configured.',
    MailingChecker::UNABLE_TO_START_GMAIL => 'The connection with Gmail SMTP service cannot be established. Please check that the credentials you provided are correct.',
    MailingChecker::UNABLE_TO_START_SMTP => 'The connection with the SMTP server cannot be established. Please check that the parameters you provided are correct.',
    'encryption' => 'Encryption',
    'auth_mode' => 'Authentication',
    'installation' => 'Installation',
    'pre_install_msg' => 'The application is ready to be installed. You can go back to previous steps to check the parameters you provided are correct or launch the installation immediately.',
    'do_install' => 'Launch installation now',
    'previous_step' => 'Previous',
    'skip_step' => 'Skip',
    'next_step' => 'Next',
    'test_again' => 'Test again',
    'please_wait' => 'Please wait'
);
