<?php

$lang = array(

	'login'					=> "Login",
	'healthcheck'			=> "System Check",
	'unfinished_upgrade'	=> "Unfinished Upgrade",
	'upgrading'				=> "Starting upgrade...",
	'done'					=> "Upgrade Complete!",
	'start'					=> "Start",
	'redirecting'			=> "Redirecting...",
	'redirecting_wait'		=> "Please wait while we transfer you...",
	'upgrade_step_1'		=> "Upgrading database...",
	'upgrade_step_2'		=> "Checking database...",
	'upgrade_step_3'		=> "Upgrading applications...",
	'upgrade_step_4'		=> "Upgrading settings, tasks, widgets and search keywords...",
	'upgrade_step_5'		=> "Upgrading languages...",
	'upgrade_step_6'		=> "Upgrading email templates...",
	'upgrade_step_7'		=> "Upgrading theme settings...",
	'upgrade_step_8'		=> "Removing old theme templates, css and images...",
	'upgrade_step_9'		=> "Upgrading theme templates, css and images...",
	'upgrade_step_10'		=> "Upgrading javascript...",
	'upgrade_complete'		=> "The upgrade process is now complete and your Invision Community is now ready!",
	'upgrade_unfinished'	=> "Unfinished Upgrade",
	'upgrade_applications'	=> "Upgrading Applications",
	'upgrade_status'		=> "Upgrade Status",
	'generic_error'			=> "An unknown error occurred",
	'license_key'			=> "License Key",
	'apps'					=> "Applications to upgrade",
	'confirmpage'			=> "Confirm Upgrade",
	'confirm'				=> "Confirm",
	'install_ready'			=> "Ready to begin installation",
	'install_start'			=> "Start Installation",
	'upgrade_error'			=> "Upgrade Error",
	'no_conf_global'		=> "Could not locate your conf_global.php file.",
	'bad_conf_global'		=> "Your conf_global.php file is invalid",
	'create_conf_global'	=> "Please create a %s directory and make it writeable. If you are not sure how to do this, contact your hosting provider.",
	'session_no_good'		=> "We were unable to start a PHP session. You will need to contact your host to adjust your PHP configuration before you can continue. The error reported was: %s",
	'upgrade_group_not_exist'	=> "You do not have permission to run the upgrader because your group does not exist.",
	'help'					=> "Help",
	
	/* !Step Titles */
	'upgrade_step_2_app'	=> "Checking database (%s)...",
	'upgrade_step_3_app'	=> "Upgrading applications (%s)...",
	'upgrade_step_4_app'	=> "Upgrading settings, tasks, widgets, and search keywords (%s)...",
	'upgrade_step_5_app'	=> "Upgrading languages (%s - done so far %s)...",
	'upgrade_step_6_app'	=> "Upgrading email templates (%s)...",
	'upgrade_step_7_app'	=> "Upgrading theme settings (%s)...",
	'upgrade_step_8_app'	=> "Removing old theme templates, CSS, and images (%s)...",
	'upgrade_step_9_app'	=> "Upgrading theme templates, CSS and images (%s - done so far %s)...",
	'upgrade_step_10_app'	=> "Upgrading JavaScript (%s - done so far %s)...",
	
	'sign_in_short'			=> "Sign In",
	'auth'					=> "Display Name or Email Address",
	'password'				=> "Password",
	'error_title'			=> "Error",
	'guest'					=> "Guest",
	'username'						=> "Display Name",
	'email_address'					=> "Email Address",
	'username_or_email'				=> "Username or Email Address",
	'login_err_no_account'			=> "The email address you entered does not belong to any account. Make sure that it is typed correctly.",
	'login_err_bad_password'		=> "The password you entered is incorrect. Please try again (make sure your caps lock is off).",
	'login_err_locked_unlock'		=> "Your account has been locked. Try again in {# [1:minute][?:minutes]}.",
	'login_err_locked_nounlock'		=> "Your account has been locked. Try again later.",
	'login_err_no_cookies'			=> "Your browser does not accept cookies which are required in order to log in.",
	'sign_in_with_these'			=> "Or sign in with one of these services",
	'login_err_remote_validate'		=> "You must validate your account at another site before you can log in successfully. Please <a href='%s' target='_blank' rel='noopener'>click here</a> to validate your account.",
	'login_connect_generic_error'	=> "There was an error processing your login request at one of the sites in our network.",
	'login_upgrader_no_permission'	=> "You do not have permission to run the upgrader.",
	'invalid_login_as_user_key'		=> "Secure login key mismatch",
	'err_password_length'			=> "Passwords must be at least 3 characters",
	'sign_in_faster'				=> "Sign In Faster",
	'sign_in_connect'				=> "Sign in via one of these sites.",
	'login_facebook'					=> "Sign in with Facebook",
	'login_twitter'						=> "Sign in with Twitter",
	'login_google'						=> "Sign in with Google",
	'login_linkedin'					=> "Sign in with LinkedIn",
	'login_live'						=> "Sign in with Microsoft",
	
	'requirements_php_version_success'	=> "PHP version %s.",
	'requirements_php_version_fail'		=> "You are running PHP version %s. You need PHP %s or above (%s or above recommended). You should contact your hosting provider or system administrator to ask for an upgrade.",
	'requirements_php_version_fail_no_recommended'	=> "You are running PHP version %s. You need PHP %s or above. You should contact your hosting provider or system administrator to ask for an upgrade.",
	'requirements_php_version_advice'	=> "You are running PHP version %s. While this version is compatible, we recommend version %s or above.",
	'requirements_curl_success'			=> "cURL extension loaded.",
	'requirements_curl_fopen'			=> "fsockopen function available",
	'requirements_curl_advice'			=> "You do not have the cURL PHP extension loaded or it is running a version less than 7.36. While this is not required, it is recommended.",
	'requirements_curl_fail'			=> "You do not have the cURL PHP extension loaded (or it is running a version less than 7.36) and the fsockopen function is disabled. You should contact your hosting provider or system administrator to ask either for cURL version 7.36 or greater to be installed, or the fsockopen function to be enabled. cURL is recommended.",
	'requirements_mb_success'			=> "Multibyte String extension loaded",
	'requirements_mb_regex'				=> "The Multibyte String extension has been configured with the --disable-mbregex option. You should contact your hosting provider or system administrator to ask for it to be reconfigured without that option.",
	'requirements_mb_overload'			=> "The PHP configuration has mbstring.func_overload set with a value higher than 0. You should contact your hosting provider or system administrator to disable Multibyte function overloading.",
	'requirements_mb_fail'				=> "You do not have the Multibyte String PHP extension loaded which is required. You should contact your hosting provider or system administrator to ask for it to be enabled. It must be configured <em>without</em> the --disable-mbregex option.",
	'requirements_extension_success'	=> "%s extension loaded",
	'requirements_extension_fail'		=> "You do not have the %s PHP extension loaded which is required. You should contact your hosting provider or system administrator to ask for it to be enabled.",
	'requirements_extension_advice'		=> "You do not have the %s PHP extension loaded. While this is not required, it is recommended.",
	'hook_file_not_writable' => "You must make the file %s writeable (usually by setting the CHMOD for the file or the plugins folder to 0777) before you can continue.",
	'requirements_extension_dom'		=> "DOM",
	'requirements_extension_gd'			=> "GD",
	'requirements_extension_exif'		=> "Exif",
	'requirements_extension_mysqli'		=> "MySQLi",
	'requirements_extension_openssl'	=> "OpenSSL",
	'requirements_extension_session'	=> "Session",
	'requirements_extension_simplexml'	=> "SimpleXML",
	'requirements_extension_xml'		=> "XML",
	'requirements_extension_xmlreader'	=> "XMLReader",
	'requirements_extension_xmlwriter'	=> "XMLWriter",
	'requirements_extension_zip'		=> "Zip",
	'requirements_extension_phar'		=> "Phar",
	'requirements_missing_imagettfbbox'	=> "GD was not compiled with freetype support. You should contact your hosting provider or system administrator to request that PHP be recompiled with freetype support with the --with-freetype-dir=DIR option.",
	'requirements_memory_limit_success'	=> "%s memory limit.",
	'requirements_memory_limit_fail'	=> "Your PHP memory limit is set to %s but should be set to 128M or more. You should contact your hosting provider or system administrator to ask for this to be changed.",
	'requirements_suhosin_limit'		=> "PHP setting %s is set to %s. This can cause problems in some areas. We recommended a value of %s or above.",
	'requirements_suhosin_cookie_encrypt' => "PHP setting suhosin.cookie.encrypt is set to 1. This can cause problems in some areas such as the editor's auto save functionality. We recommended a value of 0 to disable it.",
	'requirements_mysql_version_success'=> "MySQL version %s.",
	'requirements_mysql_version_fail'	=> "You are running MySQL version %s. You need MySQL %s or above (%s or above recommended). You should contact your hosting provider or system administrator to ask for an upgrade.",
	'requirements_mysql_version_advice'	=> "You are running MySQL version %s. While this version is compatible, we recommend version %s or above.",
	'requirements_mysql_utf8_success'	=> "All database tables UTF8.",
	'requirements_mysql_utf8_fail'		=> "Some or all of the tables or columns in your database are not using a UTF-8 collation (%s). You must <a href='../convertutf8'>convert your database to UTF-8</a> in order to continue.",
	'requirements_mysql_utf8_info'		=> "%s is %s",	
	'requirements_file_system'			=> "File System",
	'requirements_file_writable'		=> "%s is writable",
	'requirements_mysql_timeout'		=> "Your MySQL %s system variable is currently set to an extremely low value (%s). The default MySQL value is 28800. It is recommended to increase this MySQL system variable to at least 20 in order to prevent potential problems with queries timing out.",
	'dir_not_provided'                  => "No directory provided. Please check file storage configurations.",
    'dir_does_not_exist'				=> "%s does not exist.",
	'dir_is_not_writable'				=> "%s cannot be written to. Please adjust the permissions on it or contact your hosting provider for assistance.",
	'file_storage_test_error_amazon'	=> "There appears to be a problem with your Amazon (%s) file storage settings which can cause problems with uploads.<br> After attempting to upload a file to the directory, the URL to the file is returning a HTTP %s error. Update your settings and then check and see if the problem has been resolved",
	'ftp_err_no_ext'					=> "Your server does not support using FTP storage. Please contact your hosting provider to ask for PHP FTP extension to be enabled.",
	'ftp_err_no_ssl'					=> "Your server does not support using SSL-FTP storage. Please contact your hosting provider to ask for PHP OpenSSL extension to be enabled or use a different protocol.",
	'ftp_err_no_sftp'					=> "Your server does not support using SFTP storage. Please contact your hosting provider to ask for PHP SSH2 extension to be enabled or use a different protocol.",
	'ftp_err-COULD_NOT_CONNECT'			=> "A connection to the host could not be established. Check the host and port provided are correct.",
	'ftp_err-COULD_NOT_LOGIN'			=> "Authentication failed. Check the username and password provided are correct.",
	'ftp_err-COULD_NOT_CHDIR'			=> "Could not move into the directory specified. Check the directory is correct and the user provided has permission to access it.",
	'ftp_err-COULD_NOT_UPLOAD'			=> "Could not upload to the FTP server. Check the user has permission to write files.",
	'ftp_err-COULD_NOT_DELETE'			=> "Could not delete from the FTP server. Check the user has permission to delete files.",
	'file_storage_test_error_ftp'		=> "There appears to be a problem with your FTP (%s) storage settings which can cause problems with uploads.<br> After attempting to upload a file to the directory, the URL to the file is returning a HTTP %s error. Update your settings and then check and see if the problem has been resolved",
	'file_storage_test_ftp_unexpected_response' => "There appears to be a problem with your FTP (%s) storage settings. Please contact technical support.",

	'session_check_fail'				=> "The upgrader uses PHP sessions to store data, however PHP sessions are currently not working correctly on your server. This is an issue you will need to contact your host about.",


	'ipb_reg_number'		=> "License Key",
	'license_key_not_found'	=> "The license key could not be found",
	'license_generic_error'	=> "There was an error communicating with the IPS License Server. Please try again later or contact IPS technical support for assistance.",
	'license_server_error'	=> "There was an error communicating with the IPS License Server: %s. Please try again later or contact IPS technical support for assistance.",
	'license_key_legacy'	=> "The license key supplied is not compatible with this version of Invision Community. Please contact IPS technical support for assistance.",
	'license_key_active'	=> "An installation has already been activated for this license key. Your license key entitles you to one installation only. If you need to change the URL associated with your license, contact IPS technical support.",
	'license_key_test_active' => "A test installation has already been activated for this license key. Your license key entitles you to one test installation only.",


	'upgrade_confirm'			=> "Your community will now be upgraded to the latest version. There is no way to go back to the old version and it is recommended that you backup your community before continuing. Your hosting provider or system administrator will be able to take a backup if you are not sure how to do so.",
	'upgrade_confirm_cic'		=> "Your community will now be upgraded to the latest version.",
	'location'					=> "Location",
	'current_version' 			=> "Current Version",
	'available_version'			=> "Available Version",


	'forums'				=> "Forums",
	'core'					=> "System",
	'blog'					=> "Blog",
	'nexus'					=> "Nexus",
	'gallery'				=> "Gallery",
	'downloads'				=> "Downloads",
	'calendar'				=> "Calendar",
	
	'apps_will_be_disabled'	=> "Some applications are not compatible with the core. You need to upgrade all applications in the suite, otherwise the following applications will be disabled:",
	'continue_anyway'		=> "Continue Anyway",
	'go_back'				=> "Go Back",

	'installer'				=> "Invision Community Installer - %s",

	'error'					=> "Error",
	'page_doesnt_exist'		=> "That page doesn't exist.",
	'upgrade_session_error'	=> "The security token used to validate your session is missing or invalid. This can happen if you have been inactive for a long time or followed an incorrect link to the upgrader. Please restart the upgrader to resolve this issue.",

	'err_conf_noexist'		=> "In order to install Invision Community, rename the <em>conf_global.php.dist</em> file to <em>conf_global.php</em>. If you are not sure how to do this, contact your hosting provider.",
	'err_conf_nowrite'		=> "In order to install Invision Community, you must make the <em>conf_global.php</em> writeable. If you are not sure how to do this, contact your hosting provider.",
	'err_tmp_dir_create'	=> "Your server does not allow temporary files to be created in the configured temporary directory. To work around this issue please create a file named constants.php at %s with the following code in it:<br><br><span>&lt;?php<br><br>define( 'TEMP_DIRECTORY', dirname( __FILE__ ) . '/uploads' );</span>",
	'err_tmp_dir_adjust'	=> "Your server does not allow temporary files to be created in the configured temporary directory. To work around this issue please edit the file named constants.php at %s and add following code to it:<br><br><span>define( 'TEMP_DIRECTORY', dirname( __FILE__ ) . '/uploads' );</span>",
	'err_missing_app_data'	=> "An application's data file is missing: %s",

	'form_required'			=> "This field is required.",

	'step'					=> "Step %d",
	'continue'				=> "Continue",
	'install_guide'			=> "Need help? Consult the Installation Guide &rarr;",
	
	'license'				=> "License",
	'license_inactive'		=> 'Your license is currently inactive. You will need to <a href="{external.renew_my_license}" target="_blank" rel="noopener">renew</a> before you can upgrade.',
	'lkey'					=> "License Key",
	'lkey_help'				=> "Help",
	'lkey_err'				=> "The license key could not be activated. Please contact technical support for further assistance.",
	'lkey_not_providen'	=> "Your license has not been provided. Please supply your license key in order to continue.",
	'eula'					=> "License Agreement",
	'eula_suffix'			=> "I have read and agree to the license agreement",
	'eula_err'				=> "You must agree to the license agreement.",
	
	'applications'			=> "Applications",
	'application'			=> "Application",
	
	'err_min_php'			=> "Your server needs to be running PHP %s or higher to install this application (your server is running %s). Contact your hosting provider to have your server upgraded.",
	'err_min_php_setting'	=> "Your server needs to have the PHP <em>%s</em> setting set to %s or higher to install this application (your server is set to %s). Contact your hosting provider to have this changed.",
	'err_php_extension'		=> "Your server needs to have the PHP <em>%s</em> extension enabled to install this application. Contact your hosting provider to have this enabled.",
	'err_not_writable'		=> "The directory %s needs to be writable. Please change the directory's CHMOD to 0777",

	'conf_global_error'		 => "",
	
	'install'				=> "Install",
	'upgrade'				=> "Upgrade",
	'database_collation'	=> "Last table checked %s, checking for more",
	'database_collation_start' => "Checking database collations",
	'cannot_continue_upgrade' => "Cannot continue with this upgrade as the saved data is incomplete",
	
	'manual_query_header'	=> "Manual Action Required",
	'manual_query_auto'		=> "Try to run automatically",
	'manual_query_manual'	=> "I have run the queries manually and confirm they were run successfully",
	'manual_query_instructions'	=> "Some changes need to be made to your database. Because this affects a very large table, doing this automatically may time out. Therefore, it is recommended that you make these changes by manually running the queries listed below through the command line on your MySQL server.",

	/* filesizes */
	'filesize_Y'						=> '%s YB',
	'filesize_Z'						=> '%s ZB',
	'filesize_E'						=> '%s EB',
	'filesize_P'						=> '%s PB',
	'filesize_T'						=> '%s TB',
	'filesize_G'						=> '%s GB',
	'filesize_M'						=> '%s MB',
	'filesize_k'						=> '%s kB',
	'filesize_b'						=> '%s B',
	'unlimited'							=> "Unlimited",
	
	/* !Countries */
	'country-AF' => "Afghanistan",
	'country-AX' => "Åland Islands",
	'country-AL' => "Albania",
	'country-DZ' => "Algeria",
	'country-AS' => "American Samoa",
	'country-AD' => "Andorra",
	'country-AO' => "Angola",
	'country-AI' => "Anguilla",
	'country-AQ' => "Antarctica",
	'country-AG' => "Antigua and Barbuda",
	'country-AR' => "Argentina",
	'country-AM' => "Armenia",
	'country-AW' => "Aruba",
	'country-AU' => "Australia",
	'country-AT' => "Austria",
	'country-AZ' => "Azerbaijan",
	'country-BS' => "Bahamas",
	'country-BH' => "Bahrain",
	'country-BD' => "Bangladesh",
	'country-BB' => "Barbados",
	'country-BY' => "Belarus",
	'country-BE' => "Belgium",
	'country-BZ' => "Belize",
	'country-BJ' => "Benin",
	'country-BM' => "Bermuda",
	'country-BT' => "Bhutan",
	'country-BO' => "Bolivia, Plurinational State Of",
	'country-BA' => "Bosnia and Herzegovina",
	'country-BW' => "Botswana",
	'country-BV' => "Bouvet Island",
	'country-BR' => "Brazil",
	'country-IO' => "British Indian Ocean Territory",
	'country-BN' => "Brunei Darussalam",
	'country-BG' => "Bulgaria",
	'country-BF' => "Burkina Faso",
	'country-BI' => "Burundi",
	'country-KH' => "Cambodia",
	'country-CM' => "Cameroon",
	'country-CA' => "Canada",
	'country-CV' => "Cape Verde",
	'country-BQ' => "Caribbean Netherlands",
	'country-KY' => "Cayman Islands",
	'country-CF' => "Central African Republic",
	'country-TD' => "Chad",
	'country-CL' => "Chile",
	'country-CN' => "China",
	'country-CX' => "Christmas Island",
	'country-CC' => "Cocos (Keeling) Islands",
	'country-CO' => "Colombia",
	'country-KM' => "Comoros",
	'country-CG' => "Congo",
	'country-CD' => "Congo, The Democratic Republic Of The",
	'country-CK' => "Cook Islands",
	'country-CR' => "Costa Rica",
	'country-CI' => "Côte d’Ivoire",
	'country-HR' => "Croatia",
	'country-CU' => "Cuba",
	'country-CW' => "Curaçao",
	'country-CY' => "Cyprus",
	'country-CZ' => "Czech Republic",
	'country-DK' => "Denmark",
	'country-DJ' => "Djibouti",
	'country-DM' => "Dominica",
	'country-DO' => "Dominican Republic",
	'country-EC' => "Ecuador",
	'country-EG' => "Egypt",
	'country-SV' => "El Salvador",
	'country-GQ' => "Equatorial Guinea",
	'country-ER' => "Eritrea",
	'country-EE' => "Estonia",
	'country-ET' => "Ethiopia",
	'country-FK' => "Falkland Islands (Malvinas)",
	'country-FO' => "Faroe Islands",
	'country-FJ' => "Fiji",
	'country-FI' => "Finland",
	'country-FR' => "France",
	'country-GF' => "French Guiana",
	'country-PF' => "French Polynesia",
	'country-TF' => "French Southern Territories",
	'country-GA' => "Gabon",
	'country-GM' => "Gambia",
	'country-GE' => "Georgia",
	'country-DE' => "Germany",
	'country-GH' => "Ghana",
	'country-GI' => "Gibraltar",
	'country-GR' => "Greece",
	'country-GL' => "Greenland",
	'country-GD' => "Grenada",
	'country-GP' => "Guadeloupe",
	'country-GU' => "Guam",
	'country-GT' => "Guatemala",
	'country-GG' => "Guernsey",
	'country-GN' => "Guinea",
	'country-GW' => "Guinea-Bissau",
	'country-GY' => "Guyana",
	'country-HT' => "Haiti",
	'country-HM' => "Heard Island and Mcdonald Islands",
	'country-VA' => "Holy See (Vatican City State)",
	'country-HN' => "Honduras",
	'country-HK' => "Hong Kong",
	'country-HU' => "Hungary",
	'country-IS' => "Iceland",
	'country-IN' => "India",
	'country-ID' => "Indonesia",
	'country-IR' => "Iran, Islamic Republic Of",
	'country-IQ' => "Iraq",
	'country-IE' => "Ireland",
	'country-IM' => "Isle Of Man",
	'country-IL' => "Israel",
	'country-IT' => "Italy",
	'country-JM' => "Jamaica",
	'country-JP' => "Japan",
	'country-JE' => "Jersey",
	'country-JO' => "Jordan",
	'country-KZ' => "Kazakhstan",
	'country-KE' => "Kenya",
	'country-KI' => "Kiribati",
	'country-KP' => "Korea, Democratic People's Republic Of",
	'country-KR' => "Korea, Republic Of",
	'country-KW' => "Kuwait",
	'country-KG' => "Kyrgyzstan",
	'country-LA' => "Lao People's Democratic Republic",
	'country-LV' => "Latvia",
	'country-LB' => "Lebanon",
	'country-LS' => "Lesotho",
	'country-LR' => "Liberia",
	'country-LY' => "Libya",
	'country-LI' => "Liechtenstein",
	'country-LT' => "Lithuania",
	'country-LU' => "Luxembourg",
	'country-MO' => "Macao",
	'country-MK' => "Macedonia, The Former Yugoslav Republic Of",
	'country-MG' => "Madagascar",
	'country-MW' => "Malawi",
	'country-MY' => "Malaysia",
	'country-MV' => "Maldives",
	'country-ML' => "Mali",
	'country-MT' => "Malta",
	'country-MH' => "Marshall Islands",
	'country-MQ' => "Martinique",
	'country-MR' => "Mauritania",
	'country-MU' => "Mauritius",
	'country-YT' => "Mayotte",
	'country-MX' => "Mexico",
	'country-FM' => "Micronesia, Federated States Of",
	'country-MD' => "Moldova, Republic Of",
	'country-MC' => "Monaco",
	'country-MN' => "Mongolia",
	'country-ME' => "Montenegro",
	'country-MS' => "Montserrat",
	'country-MA' => "Morocco",
	'country-MZ' => "Mozambique",
	'country-MM' => "Myanmar",
	'country-NA' => "Namibia",
	'country-NR' => "Nauru",
	'country-NP' => "Nepal",
	'country-NL' => "Netherlands",
	'country-NC' => "New Caledonia",
	'country-NZ' => "New Zealand",
	'country-NI' => "Nicaragua",
	'country-NE' => "Niger",
	'country-NG' => "Nigeria",
	'country-NU' => "Niue",
	'country-NF' => "Norfolk Island",
	'country-MP' => "Northern Mariana Islands",
	'country-NO' => "Norway",
	'country-OM' => "Oman",
	'country-PK' => "Pakistan",
	'country-PW' => "Palau",
	'country-PS' => "Palestine, State of",
	'country-PA' => "Panama",
	'country-PG' => "Papua New Guinea",
	'country-PY' => "Paraguay",
	'country-PE' => "Peru",
	'country-PH' => "Philippines",
	'country-PN' => "Pitcairn",
	'country-PL' => "Poland",
	'country-PT' => "Portugal",
	'country-PR' => "Puerto Rico",
	'country-QA' => "Qatar",
	'country-RE' => "Réunion",
	'country-RO' => "Romania",
	'country-RU' => "Russian Federation",
	'country-RW' => "Rwanda",
	'country-BL' => "Saint Barthélemy",
	'country-SH' => "Saint Helena, Ascension and Tristan Da Cunha",
	'country-KN' => "Saint Kitts and Nevis",
	'country-LC' => "Saint Lucia",
	'country-MF' => "Saint Martin",
	'country-PM' => "Saint Pierre and Miquelon",
	'country-VC' => "Saint Vincent and The Grenadines",
	'country-WS' => "Samoa",
	'country-SM' => "San Marino",
	'country-ST' => "Sao Tome and Principe",
	'country-SA' => "Saudi Arabia",
	'country-SN' => "Senegal",
	'country-RS' => "Serbia",
	'country-SC' => "Seychelles",
	'country-SL' => "Sierra Leone",
	'country-SG' => "Singapore",
	'country-SX' => "Sint Maarten",
	'country-SK' => "Slovakia",
	'country-SI' => "Slovenia",
	'country-SB' => "Solomon Islands",
	'country-SO' => "Somalia",
	'country-ZA' => "South Africa",
	'country-GS' => "South Georgia and The South Sandwich Islands",
	'country-SS' => "South Sudan",
	'country-ES' => "Spain",
	'country-LK' => "Sri Lanka",
	'country-SD' => "Sudan",
	'country-SR' => "Suriname",
	'country-SJ' => "Svalbard and Jan Mayen",
	'country-SZ' => "Swaziland",
	'country-SE' => "Sweden",
	'country-CH' => "Switzerland",
	'country-SY' => "Syrian Arab Republic",
	'country-TW' => "Taiwan, Province Of China",
	'country-TJ' => "Tajikistan",
	'country-TZ' => "Tanzania, United Republic Of",
	'country-TH' => "Thailand",
	'country-TL' => "Timor-Leste",
	'country-TG' => "Togo",
	'country-TK' => "Tokelau",
	'country-TO' => "Tonga",
	'country-TT' => "Trinidad and Tobago",
	'country-TN' => "Tunisia",
	'country-TR' => "Turkey",
	'country-TM' => "Turkmenistan",
	'country-TC' => "Turks and Caicos Islands",
	'country-TV' => "Tuvalu",
	'country-UG' => "Uganda",
	'country-UA' => "Ukraine",
	'country-AE' => "United Arab Emirates",
	'country-GB' => "United Kingdom",
	'country-US' => "United States",
	'country-UM' => "United States Minor Outlying Islands",
	'country-UY' => "Uruguay",
	'country-UZ' => "Uzbekistan",
	'country-VU' => "Vanuatu",
	'country-VE' => "Venezuela, Bolivarian Republic Of",
	'country-VN' => "Vietnam",
	'country-VG' => "Virgin Islands, British",
	'country-VI' => "Virgin Islands, U.S.",
	'country-WF' => "Wallis and Futuna",
	'country-EH' => "Western Sahara",
	'country-YE' => "Yemen",
	'country-ZM' => "Zambia",
	'country-ZW' => "Zimbabwe",


	/* ! 32000 Upgrade options */
	'32000_avatar_or_photo'		=> "Profile Photo",
	'32000_avatar_or_photo_desc'	=> "While earlier versions of IP.Board allowed users to specify both a profile photo and an account avatar, users are only able to specify one account image in the latest releases of IP.Board.  If users have both an avatar and a profile photo, select which one should be retained during the upgrade.",
	'avph_avatar'			=> "Avatar",
	'avph_photo'			=> "Photo",

	/* ! 40000 Nexus Upgrade Options */
	'40000_nexus_staff'					=> "Support Staff",
	'40000_nexus_staff_desc'			=> "Support staff cannot be converted during the upgrade. Please log in and set up support staff as administrators in the admin control panel after the upgrade and then review support department staff settings.",
	'40000_nexus_modules'				=> "Custom Modules",
	'40000_nexus_modules_desc'			=> "Custom code to run when packages are purchased, etc. cannot be converted during the upgrade. <a href='{external.devdocs-commerce-actions}' target='_blank' rel='noopener'>More information</a>",

	/* ! 40000 Forum Upgrade options */
	'40000_qa_forum'					=> "Question and Answer Forums",
	'40000_qa_forum_desc'				=> "In previous versions, you could enable a 'Mark Solved' feature on a per-forum basis. IPS 4 enhances this so you can enable a Question and Answer mode which allows members to ask questions, answer other's and rate answers.",
	'40000_qa_forum_0'					=> "Don't convert to Question and Answer mode",
	'40000_qa_forum_1'					=> "Convert 'Mark Solved' forums to Question and Answer mode",
	
	
	/* ! 40000 Core Upgrade options */
	'40000_username_or_displayname'      => "User's Display Name",
	'40000_username_or_displayname_desc' => "Earlier versions of IP.Board allowed users to specify a username that can be used to log in and a separate display name to be shown on posts. The latest version only allows one or the other. In the latest versions, you can log in with an email address so we recommend keeping the display name which is what most are used to seeing.",
	'40000_name'						 => "Username",
	'40000_display_name'				 => "Display Name",
	'40000_acp_restrictions'			=> "ACP Restrictions",

	/* ! 42000 Gallery Upgrade options */
	'42000_members_album'				=> "Select the Member's Album category",
	'42000_new_members_album'			=> "Or create a new Member's Album category",

	/* ! 40000 CMS options */
	'cms_database_title'				=> "Select page for database %s",
	'cms_database_desc'					=> "A database may only be embedded into one page in 4.0. Select which page the database should remain embedded on. It will be removed from all other pages.",

    /* ! 100003 Convert Friend Options */
    '100003_follow_options'             => "Convert friends to followers?",
    '100003_no_convert'                 => "Don't convert",
    '100003_convert'                    => "Convert",
    '100003_convert_desc'               => "In this version of Invision Community, members can no longer add other members as friends. However members can follow other members and receive notifications when the members they are following post. You can convert friends to followers, so any members who are friends with another member will now be following them, however this will mean they will start receiving notifications which may be undesired. It is recommended you do not convert.",

	/* ! 101000 revert globalTemplate */
	'101000_globalTemplate_revert'      => "Revert custom themes which contain out of date globalTemplate templates?",
	'101000_globalTemplate_revert_desc' => "In Invision Community 4.1, the template 'utilitiesMenu' has been removed. This is used within the globalTemplate. After upgrading, you may see a message about the theme being out of date if you do not revert.<br><strong>Reverting templates will lose any customizations</strong>",
	'101000_yes'						=> "Yes, revert losing customizations",
	'101000_no'							=> "No, I will manually adjust the templates after upgrading",
	
	/* ! CMS 101000 Options */
	'40000_cms_htmlconversion'			=> "Pages HTML",
	'40000_cms_htmlconversion_desc'		=> "HTML in pages, blocks and templates in Pages cannot be converted during the upgrade. While those pages and blocks will continue to work, you may wish to adjust the HTML following the upgrade to integrate the styling used by the Community Suite 4.0.",

	'third_party_stuff_disabled'		=> "You have some third party applications or plugins installed which can potentially cause problems during or after upgrading and have been disabled.",
	'third_party_stuff_disabled_apps'	=> "The following third party applications were disabled:",
	'third_party_stuff_disabled_plugins'=> "The following third party plugins were disabled:",
	'third_party_stuff_disabled_end'	=> "After upgrading you can visit the AdminCP to individually enable the applications and plugins one at a time and verify they work correctly.",
	'101000_disable_3rdparty'			=> "Disabled Applications & Plugins",

	/* ! Core 101079 Diagnostic reporting option */
	'101079_diagnostics_reporting'			=> "Send diagnostics data to IPS?",
	'101079_diagnostics_reporting_desc'		=> "This function is currently disabled. | Help Invision Community improve by automatically sending diagnostic information. The data sent does not contain any private information about your users or your community.",

	'104000_es_version'						=> "Elasticsearch version in use is no longer supported",
	'104000_paypal_warning'					=> "PayPal Functionality",

	/* ! Core 102000 Letter photo option */
	'options_letter_photos'					=> "Enable letter photos?",
	'options_letter_photos_desc'			=> "Do you wish to start using automatic letter photos instead of the default theme profile photo for users who have not uploaded a profile photo?",
	
	/* ! IPS Connect discontinued warning */
	'ipsconnect'				=> "IPS Connect",

	'no_apps_upgrade'			=> 'There are no applications available to upgrade',
	'exit_upgrader'				=> "Exit upgrader",
	'retry'						=> "Retry?",
	'convert_charset'			=> "Convert character set",
	'convert_charset_info'		=> "Your community suite data or database configuration is saved in an encoding other than UTF-8. Before your site can be upgraded, we must convert the encoding to UTF-8.",
	'start_upgrade'				=> "Start Upgrade",
	'continue_upgrade'			=> "Continue Upgrade",
	'continue_not_set'			=> "Not set",
	'unfinished_upgrade_info'	=> "You have an unfinished upgrade from %s",
	'hc_designers_mode'			=> "Designers' Mode On",
	'hc_designers_enabled'		=> "Designers' Mode is currently enabled.",
	'hc_disable_designers'		=> "Disable Designers' Mode now",
	'hc_designers_dis_info'		=> "Disabling Designers' Mode now will <strong>not</strong> synchronize your templates.<br>If you need to save your edited files, please synchronize them via the ACP &gt; Customization &gt; Themes before disabling Designer's Mode.",
	'hc_requirements'			=> "%s Requirements",
	'hc_recommendations'		=> "Recommendations",
	'hc_recommendations_info'	=> "None of these items are required in order to continue with the upgrade right now. However, they will be required in a future version of Invision Community. You should make a note of them and contact your hosting provider or system administrator after the upgrade to address them. You can re-run these checks later from the <em>Support</em> section of the Administrator Control Panel.",
	'hc_no_continue'			=> "You must correct any issues listed above before you can proceed",
	'upgrader_banner'			=> "Upgrade Invision Community 4",
	'upgradeoptions'			=> 'Upgrade Options',
	'done_banner'				=> "Your Invision Community 4 is ready",
	'go_to_suite'				=> "Go to the suite",
	'go_to_acp'					=> "Go to the AdminCP",
	'suite_docs'				=> "Suite Documentation",
	'start_banner'				=> "Welcome to Invision Community 4",
	'start_info'				=> "This process will install your software for you. Be sure you have your license key and MySQL database details to hand.",
	'install_docs'				=> "Install Guide",
	'js_confirm_mrerror'		=> 'The server encountered multiple instances where it has stopped responding.\nPress \'OK\' to reload this page and re-run this installation step.',
	'hc_files'					=> "File Check",
	'hc_files_ok'				=> "Source files are correct for the current version",
	'hc_files_fail'				=> "Some source files are not correct for the current version. If you uploaded the files to your server manually, the process may have failed or not completed yet. Download the latest version from your client area and upload the files again in order to continue.",
	'hc_files_fail2'			=> "Go To Client Area",
	'hc_files_fail3'			=> "If you are sure the files have been uploaded correctly, make sure the permissions are set correctly on them.",

	/* ! Core - 4.3 - Removing HTTPS settings */
	'https_settings_changes'	=> "HTTPS Settings Changes",
	'103000_usage_reporting'			=> "Send usage data to IPS?",
	'103000_usage_reporting_desc'		=> "Help Invision Community improve by automatically sending usage information including a list of features in use and basic statistics. The data sent does not contain any private information about your users or your community.",
	'admincp_hide_deprecate'	=> "Hide AdminCP link",
	'recaptcha_v1_removed'		=> "CAPTCHA Settings",
	'103000_ipsconnect_url'		=> "IPS Connect Master Site URL",
	'103000_ipsconnect_client_id' => "IPS Connect Client Identifier",
	'103000_ipsconnect_client_secret' => "IPS Connect Client Secret",

	/* ! LinkedIn v2 API */
	'104020_linkedin'			=> "LinkedIn Login Method API Update",

	
'files-1'	=> "File could not be opened: %s",
'files-2'	=> "File does not exist: %s",
'files-4'	=> "File could not be copied: %s",
'files-5'	=> "File could not be moved: %s",
'files-3'	=> "File could not be saved: %s",
'files-6'	=> "Folder could not be created: %s",
'files-7'	=> "Response returned a 400 response code but no Amazon region was returned: %s",

);