<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!((strtok($_SERVER["REQUEST_URI"], '?') == '/contacts/') ||
	 (strtok($_SERVER["REQUEST_URI"], '?') == '/contacts/index.php'))) {
	$this->AbortResultCache();
    @define('ERROR_404', 'Y');
    return;
}

CModule::IncludeModule("iblock");
// инфо из инфоблока страницы
$arFilter = Array("IBLOCK_ID" => 18, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
    $arFields = $ob->GetFields();
	$arProps  = $ob->GetProperties();
}
$arFile = CFile::GetFileArray($arProps["banner"]['~VALUE']);
if ($arFile["SRC"]) {
	$arResult["BANNER"]["SRC"] 	 = $arFile["SRC"];
	$arResult["BANNER"]["STYLE"] = 'style="padding-top:calc('.$arFile["HEIGHT"].' / '.$arFile["WIDTH"].' * 100%)"';
} else {
	$arResult["BANNER"]["SRC"] 	 = SITE_TEMPLATE_PATH.'/img/banner-contacts.jpg';
	$arResult["BANNER"]["STYLE"] = ' style="padding-top:calc(409 / 1700 * 100%)"';
}
$arResult['H1COLOR']    = $arProps["h1color"]['VALUE_XML_ID'];
$arResult['PHONE']      = $arProps["phone"]["~VALUE"];
$arResult['EMAIL']      = $arProps["email"]["~VALUE"];
$arResult['ADDRESS']    = $arProps["address"]["~VALUE"]["TEXT"];
$arResult['FB']         = $arProps["facebook"]["~VALUE"];
$arResult['HH']         = $arProps["headhunter"]["~VALUE"];
$arResult['YT']         = $arProps["youtube"]["~VALUE"];
$arPers[1]['DEPT']      = $arProps["person1_dept"]["~VALUE"];
$arPers[2]['DEPT']      = $arProps["person2_dept"]["~VALUE"];
$arPers[1]['NAME']      = $arProps["person1_fio"]["~VALUE"];
$arPers[2]['NAME']      = $arProps["person2_fio"]["~VALUE"];
$arPers[1]['JOB']       = $arProps["person1_job"]["~VALUE"];
$arPers[2]['JOB']       = $arProps["person2_job"]["~VALUE"];
$arPers[1]['TEL']       = $arProps["person1_tel"]["~VALUE"];
$arPers[2]['TEL']       = $arProps["person2_tel"]["~VALUE"];
$arPers[1]['MAIL']      = $arProps["person1_mail"]["~VALUE"];
$arPers[2]['MAIL']      = $arProps["person2_mail"]["~VALUE"];
$arResult['PERSON']     = $arPers;
$arFile = CFile::GetFileArray($arProps["mapimg"]['~VALUE']);
$arResult['MAPIMG']     = $arFile["SRC"];
$arResult['MAPLINK']    = $arProps["maplink"]["~VALUE"];
$arResult['YAMAP']      = $arProps["yamap"]["~VALUE"];
$arResult["MAPTEXT"]    = $arProps["maptext"]["~VALUE"]["TEXT"];
// тайтл и дескрипшн
$arResult["TEXT_TITLE"]	= $arProps['title_ru']["~VALUE"];
$arResult["TEXT_DESCR"]	= $arProps['descr_ru']["~VALUE"];

if ($_SERVER['REMOTE_ADDR'] == '95.220.44.210') {
    // print_r($arResult);
    // print_r($arProps);
}

$this->IncludeComponentTemplate();