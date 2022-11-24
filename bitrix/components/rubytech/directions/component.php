<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!((strtok($_SERVER["REQUEST_URI"], '?') == '/directions/') ||
	 (strtok($_SERVER["REQUEST_URI"], '?') == '/directions/index.php'))) {
	$this->AbortResultCache();
    @define('ERROR_404', 'Y');
    return;
}

CModule::IncludeModule("iblock");
// инфо из инфоблока страницы
$arFilter = Array("IBLOCK_ID" => 29, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "DETAIL_PICTURE", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arProps  = $ob->GetProperties();
}
$arFile = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
if ($arFile["SRC"]) {
	$arResult["BANNER"]["SRC"] 	 = $arFile["SRC"];
	$arResult["BANNER"]["STYLE"] = 'style="padding-top:calc('.$arFile["HEIGHT"].' / '.$arFile["WIDTH"].' * 100%)"';
} else {
	$arResult["BANNER"]["SRC"] 	 = SITE_TEMPLATE_PATH.'/img/banner-expertise.jpg';
	$arResult["BANNER"]["STYLE"] = ' style="padding-top:calc(340 / 1700 * 100%)"';
}
$arResult['H1COLOR']             = $arProps["h1color"]['VALUE_XML_ID'];
$arResult['HEADER1']    		 = $arProps['header1']['~VALUE'];
$arResult['SHOWFORM']   		 = $arProps['feedback_show']['VALUE_XML_ID'];

// тайтл и дескрипшн
$arResult["TEXT_TITLE"]	= $arProps['title_ru']["~VALUE"];
$arResult["TEXT_DESCR"]	= $arProps['descr_ru']["~VALUE"];

// Решения
$arFilter = Array("IBLOCK_ID" => 30, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "CODE", "PROPERTY_*");
$result = CIBlockElement::GetList(array('SORT' => 'asc'), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arProps  = $ob->GetProperties();
	$arEl['NAME']			 = $arFields['NAME'];
	$arEl['CODE']			 = $arFields['CODE'];
	$arEl['TEXT']  			 = $arProps["anons_ru"]["~VALUE"]["TEXT"];
	$arFile  = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
	$arEl['IMG']['SRC'] 	 = $arFile["SRC"];
	$arEl['IMG']['STYLE'] 	 = 'style="padding-top:'.$arFile['HEIGHT'].'px"';
	$arResult['SOLUTIONS'][] = $arEl;
}
// if ($_SERVER['REMOTE_ADDR'] == '95.220.39.12') {
	// print_r($arResult);
// }
$this->IncludeComponentTemplate();