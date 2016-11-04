PrintFlow
======================

## IMPORTANT!!
### This is project is not maintained anymore! For up-2-date code, visit the refreshed printflow project at http://github.com/dotdeas/printflow/

A PHP system for collecting and managing alerts and supplyrequests from MPS systems

## Supported MPS systems
* 3Manager
* @Remote

## Requirements
* Web server with PHP support (such as Apache, IIS)
* MySQL 5.0 or newer
* PHP 5.5 or newer, with session support
* PHP CLI module
* A web browser with cookies and javascript enabled

## Download
You can download the newest release at http://github.com/dotdeas/printflow_old/releases/

## Installation
1. Upload all the files to your web server
2. Import printflow.sql in the sql dir to your MySQL server
3. Make reportslog and log dir writeable
4. Open and edit config.php
5. Open and login to your PrintFlow sytsme, default password is 'password'

Sample config.php
```
<?php
// database
$dbhost="localhost";
$dbuser="pf-user";
$dbpass="pf-pass";
$dbname="printflow";

// imap
$imap_string="{mail.dotdeas.se:995/pop3/ssl/novalidate-cert}";
$imap_user="reports@printflow.dotdeas.se";
$imap_pass="EmailPassword";

// smtp
$smtp_host"smtp.dotdeas.se";
$smtp_port="587";
$smtp_encryption="tls";
$smtp_auth=true;
$smtp_username="app@printflow.dotdeas.se";
$smtp_password="TrustNo1";
$smtp_fromaddr="app@printflow.dotdeas.se";

// timezone
date_default_timezone_set("Europe/Stockholm");

// password
$password="ff574334c2814795b84a2112dfad89acdff14c7b8b250c9ef19df7d8667ba7a579f1dede842bcf1b523c94bfee4524cd3e57609d4677d2b2a59a55d28c1552bd";
```

## FAQ - Frequently Asked Questions
**Using IMAP or POP3?**
```
Here are some imap string examples:
POP3 on port 995 with SSL = {mail.dotdeas.se:995/pop3/ssl/novalidate-cert}
POP3 on port 110 without SSL = {mail.dotdeas.se:110/pop3}
IMAP on port 993 with SSL = {mail.dotdeas.se:993/imap/ssl/novalidate-cert}
IMAP on port 143 without SSL = {mail.dotdeas.se:143/imap}

Check http://php.net/manual/en/function.imap-open.php for more information about imap connection string
```

**Using SMTP without authentication?**
```
$smtp_host"smtp.dotdeas.se";
$smtp_port="25";
$smtp_encryption="none";
$smtp_auth=false;
$smtp_username="";
$smtp_password="";
$smtp_fromaddr="app@printflow.dotdeas.se";
```

**Change password?**
```
1. Create a php-file with the included code and open/run it
   <?php
   echo hash("sha512",md5(md5("password")));
2. Copy the output to your config.php file
3. Remove the file from the server when you are done
```

## Contact me
If you found a bug, got a great idea or just want to say hello. Send me a email on andreas@dotdeas.se

## License
Released under the [MIT license](http://makesites.org/licenses/MIT)

PrintFlow includes several third party libraries which come under their respective licenses.
