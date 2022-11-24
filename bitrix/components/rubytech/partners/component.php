<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!((strtok($_SERVER["REQUEST_URI"], '?') == '/partners/') ||
	 (strtok($_SERVER["REQUEST_URI"], '?') == '/partners/index.php'))) {
	$this->AbortResultCache();
    @define('ERROR_404', 'Y');
    return;
}


CModule::IncludeModule("iblock");
// инфо из инфоблока страницы
$arFilter = Array("IBLOCK_ID" => 17, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "DETAIL_PICTURE", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
	$arProps = $ob->GetProperties();
}
$arResult['HEADER1']    = $arProps['header1']['~VALUE'];
$arResult['H1COLOR']    = $arProps["h1color"]['VALUE_XML_ID'];
$arResult['SHOWFORM']   = $arProps['feedback_show']['VALUE_XML_ID'];
$arResult['BIGTEXT']    = $arProps['bigtext']['~VALUE']['TEXT'];
$arResult['TEXT']       = $arProps['text']['~VALUE']['TEXT'];
$arFile = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
if ($arFile["SRC"]) {
	$arResult["BANNER"]["SRC"] 	 = $arFile["SRC"];
	$arResult["BANNER"]["STYLE"] = 'style="padding-top:calc('.$arFile["HEIGHT"].' / '.$arFile["WIDTH"].' * 100%)"';
} else {
	$arResult["BANNER"]["SRC"] 	 = SITE_TEMPLATE_PATH.'/img/banner-partners.jpg';
	$arResult["BANNER"]["STYLE"] = ' style="padding-top:calc(340 / 1700 * 100%)"';
}
// тайтл и дескрипшн
$arResult["TEXT_TITLE"]	= $arProps['title_ru']["~VALUE"];
$arResult["TEXT_DESCR"]	= $arProps['descr_ru']["~VALUE"];



// Партнеры
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PICTURE", "CODE", "PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y",);

$result = CIBlockElement::GetList(array('SORT' => 'asc', 'CODE'=>'asc'), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps  = $ob->GetProperties();
    $arEl = array();

    $arEl['NAME'] = $arFields["NAME"];
    $arEl['CODE'] = $arFields["CODE"];
    $arEl['LINK'] = $arProps["sitelink"]["~VALUE"];
    $arFile = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
    // $arFile = CFile::ResizeImageGet($arFields["DETAIL_PICTURE"], array('width'=> 288, 'height'=> 90), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arEl["LOGO"]   = $arFile["SRC"];
    $arEl['STATUS'] = $arProps["statustext"]["~VALUE"];

    $arPartners[] = $arEl; 
}

$arResult['PARTNERS'] = $arPartners;

// контакты
$arFilter = Array("IBLOCK_ID" => 18, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
	$arProps  = $ob->GetProperties();
}
$arResult['EMAIL']   = $arProps["email"]["~VALUE"];

if ($_SERVER['REMOTE_ADDR'] == '95.220.44.210') {
    // var_dump($arResult);
    // print_r($arProps);
}

$this->IncludeComponentTemplate();