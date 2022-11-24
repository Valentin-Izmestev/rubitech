<?
use Bitrix\Main\Loader;

global $DBType;

$arClasses=array(
	'BFCookies' => 'lib/BFCookies.php',
);
CModule::AddAutoloadClasses("brainforce.cookies",$arClasses);
