<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/*
|--------------------------------------------------------------------------
| Use for seatbooking app
|--------------------------------------------------------------------------
|
|
*/
defined('PAYMENT_STATUS_CONFIRMED') OR define('PAYMENT_STATUS_CONFIRMED', 'Confirmed');

defined('USER_TRANS_TYPE_BILL_TO') OR define('USER_TRANS_TYPE_BILL_TO', 'Bill To');
defined('USER_TRANS_TYPE_BILL_FROM') OR define('USER_TRANS_TYPE_BILL_FROM', 'Bill From');
defined('USER_TRANS_TYPE_PAYMENT_TO') OR define('USER_TRANS_TYPE_PAYMENT_TO', 'Payment To');
defined('USER_TRANS_TYPE_PAYMENT_FROM') OR define('USER_TRANS_TYPE_PAYMENT_FROM', 'Payment From');
defined('USER_TRANS_TYPE_TRANSFER_TO') OR define('USER_TRANS_TYPE_TRANSFER_TO', 'Transfer To');
defined('USER_TRANS_TYPE_TRANSFER_FROM') OR define('USER_TRANS_TYPE_TRANSFER_FROM', 'Transfer From');
defined('USER_TRANS_TYPE_REFUND_TO') OR define('USER_TRANS_TYPE_REFUND_TO', 'Refund To');
defined('USER_TRANS_TYPE_REFUND_FROM') OR define('USER_TRANS_TYPE_REFUND_FROM', 'Refund From');
defined('USER_TRANS_TYPE_DEPOSIT_TO') OR define('USER_TRANS_TYPE_DEPOSIT_TO', 'Deposit To');
defined('USER_TRANS_TYPE_WITHDRAWAL_FROM') OR define('USER_TRANS_TYPE_WITHDRAWAL_FROM', 'Withdrawal From');

defined('PAYMENT_MEDHOD_DIRECT') OR define('PAYMENT_MEDHOD_DIRECT', 'Direct');


defined('ROLE_SUBSCRIBER') OR define('ROLE_SUBSCRIBER', 'subscriber');
defined('ROLE_AGENT') OR define('ROLE_AGENT', 'agent');
defined('ROLE_SUPERVISOR') OR define('ROLE_SUPERVISOR', 'supervisor');
defined('ROLE_COMPANY_ACCOUNTANT') OR define('ROLE_COMPANY_ACCOUNTANT', 'company_accountant');
defined('ROLE_COMPANY_MANAGER') OR define('ROLE_COMPANY_MANAGER', 'company_manager');
defined('ROLE_COMPANY_OWNER') OR define('ROLE_COMPANY_OWNER', 'company_owner');
defined('ROLE_APP_SUPPORT') OR define('ROLE_APP_SUPPORT', 'app_support');
defined('ROLE_APP_ACCOUNTANT') OR define('ROLE_APP_ACCOUNTANT', 'app_accountant');
defined('ROLE_ADMINISTRATOR') OR define('ROLE_ADMINISTRATOR', 'administrator');

//Allow time in seconds for booking confirmation. expired pending booking will be removed
defined('ALLOW_PENDING_CABIN_TIME') OR define('ALLOW_PENDING_CABIN_TIME', '1200');





/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
