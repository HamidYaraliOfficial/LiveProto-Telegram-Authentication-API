<?php

// LiveProto Telegram Authentication API
// Developed by Hamid Yarali
// GitHub: https://github.com/HamidYaraliOfficial
// Instagram: https://www.instagram.com/hamidyaraliofficial?igsh=MWpxZjhhMHZuNnlpYQ==
// Telegram: @Hamid_Yarali

define('json',fn(bool $ok,mixed $result) : string => json_encode(['ok'=>$ok,'result'=>$result],JSON_THROW_ON_ERROR | JSON_INVALID_UTF8_IGNORE | JSON_PRETTY_PRINT));

function getVar(string $index) : string {
	return strval($_POST[$index] ?? $_GET[$index] ?? die((json) (false,'Parameter '.$index.' is empty / 参数 '.$index.' 为空 / Параметр '.$index.' пуст')));
}

// Check if liveproto.phar exists, otherwise download from official source
if(file_exists('liveproto.phar')){
	require_once 'liveproto.phar';
} else {
	copy('https://installer.liveproto.dev/liveproto.php','liveproto.php');
	require_once 'liveproto.php';
}

use Tak\Liveproto\Network\Client;
use Tak\Liveproto\Utils\Settings;
use Tak\Liveproto\Enums\Authentication;

$settings = new Settings();

// Configure API credentials and device settings
$settings->setApiId(21724);
$settings->setApiHash('3e0cb5efcd52300aec5994fdfc5bdc16');
$settings->setDeviceModel('Redmi Redmi Note 8 pro / Redmi Redmi Note 8 pro / 红米Redmi Note 8 pro / Redmi Redmi Note 8 pro');
$settings->setSystemVersion('11 (30)');
$settings->setAppVersion('0.27.10.1752-arm64-v8a');
$settings->setSystemLangCode('en-CA');
$settings->setLangPack('android');
$settings->setLangCode('en');
$settings->setHideLog(true);

// Get phone number from request parameters
$phone = intval(getVar('phone'));

// Initialize client with phone number and SQLite storage
$client = new Client('phone_'.strval($phone),'sqlite',$settings);

// Set timezone parameters for authentication
$params = $client->jsonObject(
	value : array(
		$client->jsonObjectValue(
			key : 'tz_offset',
			value : $client->jsonNumber(
				value : (float) (new \DateTime('now',new \DateTimeZone('America/Toronto')))->getOffset()
			)
		)
	)
);

$settings->setParams($params);

// Connect to Telegram servers
$client->connect();

// Handle different authentication steps
try {
	if($client->getStep() === Authentication::NEED_AUTHENTICATION){
		// Send verification code to phone number
		$sentCode = $client->send_code(phone_number : chr(43).strval($phone),allow_firebase : true,allow_missed_call : true,unknown_number : true);
		echo (json) (true,[
			'en' => 'Verification code sent successfully',
			'fa' => 'کد تأیید با موفقیت ارسال شد',
			'zh' => '验证码发送成功',
			'ru' => 'Код подтверждения отправлен успешно'
		] + $sentCode);
	}
	elseif($client->getStep() === Authentication::NEED_EMAIL){
		// Send email verification code
		$sentEmailCode = $client->send_email_code(email : getVar('email'));
		echo (json) (true,[
			'en' => 'Email verification code sent',
			'fa' => 'کد تأیید ایمیل ارسال شد',
			'zh' => '电子邮件验证码已发送',
			'ru' => 'Код подтверждения электронной почты отправлен'
		] + $sentEmailCode);
	}
	elseif($client->getStep() === Authentication::NEED_EMAIL_VERIFY){
		// Verify email code
		$emailVerified = $client->verify_email(code : getVar('code'));
		echo (json) (true,[
			'en' => 'Email verified successfully',
			'fa' => 'ایمیل با موفقیت تأیید شد',
			'zh' => '电子邮件验证成功',
			'ru' => 'Электронная почта успешно подтверждена'
		] + $emailVerified);
	}
	elseif($client->getStep() === Authentication::NEED_CODE){
		// Sign in with verification code
		$authorization = $client->sign_in(code : getVar('code'));
		echo (json) (true,[
			'en' => 'Successfully signed in with verification code',
			'fa' => 'با موفقیت با کد تأیید وارد شدید',
			'zh' => '使用验证码成功登录',
			'ru' => 'Успешный вход с кодом подтверждения'
		] + $authorization);
	}
	elseif($client->getStep() === Authentication::NEED_PASSWORD){
		// Sign in with password
		$authorization = $client->sign_in(password : getVar('password'));
		echo (json) (true,[
			'en' => 'Successfully signed in with password',
			'fa' => 'با موفقیت با رمز عبور وارد شدید',
			'zh' => '使用密码成功登录',
			'ru' => 'Успешный вход с паролем'
		] + $authorization);
	}
	elseif($client->getStep() === Authentication::LOGIN){
		// Login already complete
		echo (json) (true,[
			'en' => 'Login was complete / Login completed successfully',
			'fa' => 'ورود کامل شد / ورود با موفقیت کامل شد',
			'zh' => '登录已完成 / 登录成功完成',
			'ru' => 'Вход был завершен / Вход успешно завершен'
		]);
	}
	
	// Handle signup if needed
	if($client->getStep() === Authentication::NEED_SIGNUP){
		$client->sign_up(first_name : 'Tak',last_name : 'None');
		if(isset($authorization) and isset($authorization->terms_of_service->id)){
			$client->help->acceptTermsOfService(id : $authorization->terms_of_service->id);
		}
		echo (json) (true,[
			'en' => 'Account created and terms accepted',
			'fa' => 'حساب ایجاد شد و شرایط پذیرفته شد',
			'zh' => '账户已创建并接受条款',
			'ru' => 'Аккаунт создан и условия приняты'
		]);
	}
	
} catch(Throwable $error){
	// Handle any errors during authentication process
	$error_message = [
		'en' => $error->getMessage(),
		'fa' => 'خطا: ' . $error->getMessage(),
		'zh' => '错误：' . $error->getMessage(),
		'ru' => 'Ошибка: ' . $error->getMessage()
	];
	echo (json) (false,$error_message);
}

// Disconnect from Telegram servers
$client->disconnect();

// Footer: Developer information
echo "\n/*\n";
echo " * Developed by Hamid Yarali\n";
echo " * GitHub: https://github.com/HamidYaraliOfficial\n";
echo " * Instagram: https://www.instagram.com/hamidyaraliofficial?igsh=MWpxZjhhMHZuNnlpYQ==\n";
echo " * Telegram: @Hamid_Yarali\n";
echo " * Multi-language support: English, Persian, Chinese, Russian\n";
echo " */\n";

?>