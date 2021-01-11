<?php
$app_name = "test abc";
$app_url = "http://abc.lk";

$db_host = "localhost";
$db_name = "";
$db_user = "root";
$db_password = "";
$db_port = "3306";

$google_recaptcha_key = "6Le-d7gUAAAAAHRhFf1XoXvy8Wzow1Tzmzel1aEh";
$google_recaptcha_secret = "6Le-d7gUAAAAABomYFgmG-a33AW1ed8OhA2SP2tn";

$outgoing_email_address="";
$outgoing_email_name="";
$privacy_policy_external_url="";

$admin_name="";
$admin_email="";

if(isset($_POST['submit_all'])){
    print_r($_POST);
    die();
}

$env_data =
"APP_NAME=$app_name
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=$app_url

DB_CONNECTION=mysql
DB_HOST=$db_host
DB_PORT=$db_port
DB_DATABASE=$db_name
DB_USERNAME=$db_user
DB_PASSWORD=$db_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=log
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
AUTO_GENERATED_EMAIL_DOMAIN=perceptions.live
APP_DOMAIN=http://prcptions2.lk

PAYPAL_MODE=sandbox

GOOGLE_RECAPTCHA_KEY=$google_recaptcha_key
GOOGLE_RECAPTCHA_SECRET=$google_recaptcha_secret

ADMIN_NAME=$admin_name
ADMIN_MAIL=$admin_email
MAIL_FROM_ADDRESS=$outgoing_email_address
MAIL_FROM_NAME=$outgoing_email_name

PRIVACY_POLICY=$privacy_policy_external_url";

$envFile = fopen("./installer/env.backup", "w");
fwrite($envFile, $env_data);

//copy inv file
$file = './index.php';
$newFile = '../.inv2';

if (!copy($file, $newFile)) {
    echo "failed to copy";
}