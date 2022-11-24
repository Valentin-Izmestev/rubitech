<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!((strtok($_SERVER["REQUEST_URI"], '?') == '/company/') ||
	 (strtok($_SERVER["REQUEST_URI"], '?') == '/company/index.php'))) {
	$this->AbortResultCache();
    @define('ERROR_404', 'Y');
    return;
}

CModule::IncludeModule("iblock");

// инфо из инфоблока страницы
$arFilter = Array("IBLOCK_ID" => 19, "ACTIVE"=>"Y");
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
	$arResult["BANNER"]["SRC"] 	 = SITE_TEMPLATE_PATH.'/img/banner-about.jpg';
	$arResult["BANNER"]["STYLE"] = ' style="padding-top:calc(500 / 1700 * 100%)"';
}
$arResult['BIGTEXT']        = $arProps['bigtext']['~VALUE']['TEXT'];
$arResult['TEXT']           = $arProps['text']['~VALUE']['TEXT'];

$arFile = CFile::GetFileArray($arProps["about_products_img"]['~VALUE']);
$arResult["IMG_PROD"]       = $arFile["SRC"];
$arResult['TEXT_PROD']      = $arProps['about_products']['~VALUE']['TEXT'];
$arFile = CFile::GetFileArray($arProps["about_expertise_img"]['~VALUE']);
$arResult["IMG_EXPERT"]     = $arFile["SRC"];
$arResult['TEXT_EXPERT']    = $arProps['about_expertise']['~VALUE']['TEXT'];

$arResult['TEXT_CLIENTS']   = $arProps['about_clients']['~VALUE'];

$arResult['TEAM_BIGTEXT']   = $arProps['team_bigtext']['~VALUE'];
$arResult['TEAM_TEXT']      = $arProps['team_text']['~VALUE']['TEXT'];
$arFile = CFile::GetFileArray($arProps["team_img"]['~VALUE']);
$arResult["TEAM_IMG"]       = $arFile["SRC"];
$arResult["TEAM_IMG_DESC"]  = $arFile["DESCRIPTION"];
$arResult['TEAM_QUOTE']     = $arProps['team_blockquote']['~VALUE']['TEXT'];

// тайтл и дескрипшн
$arResult["TEXT_TITLE"]	    = $arProps['title_ru']["~VALUE"];
$arResult["TEXT_DESCR"]	    = $arProps['descr_ru']["~VALUE"];

// кейсы
$arCases = $arProps['cases']['~VALUE'];
foreach ($arCases as $key => $case) {
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PICTURE", "PROPERTY_*");
    $arFilter = Array("ID" => $case, "IBLOCK_ID" => 20, "ACTIVE" => "Y");
    $result = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
    while($ob = $result->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps  = $ob->GetProperties();
        $arFile = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
        $arEl["IMG"]         = $arFile["SRC"];
        $arEl['NAME']        = $arFields['NAME'];
        $arEl['COMPANY']     = $arProps['case_company']['~VALUE'];
        $arEl['LINK']        = $arProps['linkref']['~VALUE'];
        $arResult['CASES'][] = $arEl;
    }
}

if ($_SERVER['REMOTE_ADDR'] == '95.220.44.210') {
    //print_r($arResult);
    // print_r($arProps);
}
$this->IncludeComponentTemplate();