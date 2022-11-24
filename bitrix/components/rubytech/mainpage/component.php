<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!((strtok($_SERVER["REQUEST_URI"], '?') == '/') ||
	 (strtok($_SERVER["REQUEST_URI"], '?') == '/index.php'))) {
	$this->AbortResultCache();
    @define('ERROR_404', 'Y');
    return;
}

CModule::IncludeModule("iblock");
// инфо из инфоблока страницы
$arFilter = Array("IBLOCK_ID" => 24, "ACTIVE"=>"Y");
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
	$arResult["BANNERSMALL"] 	 = CFile::ResizeImageGet($arFields["DETAIL_PICTURE"], Array("width" => 640, "height" => 381), BX_RESIZE_IMAGE_EXACT, false);
} else {
	$arResult["BANNER"]["SRC"] 	 = SITE_TEMPLATE_PATH.'/img/rubytech_banner.jpg';
	$arResult["BANNER"]["STYLE"] = ' style="padding-top:calc(700 / 1700 * 100%)"';
	$arResult["BANNERSMALL"]["src"]	= SITE_TEMPLATE_PATH.'/img/rubytech_banner_small.jpg';
}
$arResult['H1COLOR']             = $arProps["h1color"]['VALUE_XML_ID'];
$arResult['HEADER_BIG']          = $arProps["header_big"]["~VALUE"]["TEXT"];
$arResult['HEADER_SMALL']        = $arProps["header_small"]["~VALUE"]["TEXT"];
$arResult['FIRST_TEXT']          = $arProps["first_text"]["~VALUE"]["TEXT"];
$arFile = CFile::GetFileArray($arProps["first_img"]["~VALUE"]);
$arResult["FIRST_IMG"]           = $arFile["SRC"];
$arResult['DIGITS'][1]['DIGIT']  = $arProps["digits1_digit"]["~VALUE"];
$arResult['DIGITS'][2]['DIGIT']  = $arProps["digits2_digit"]["~VALUE"];
$arResult['DIGITS'][3]['DIGIT']  = $arProps["digits3_digit"]["~VALUE"];
$arResult['DIGITS'][1]['TEXT']   = $arProps["digits1_text"]["~VALUE"];
$arResult['DIGITS'][2]['TEXT']   = $arProps["digits2_text"]["~VALUE"];
$arResult['DIGITS'][3]['TEXT']   = $arProps["digits3_text"]["~VALUE"];
$arResult['MAINBLOCK_HEADER']    = $arProps["mainblock_header"]["~VALUE"]["TEXT"];
$arResult['UNDERMAIN_TEXT']      = $arProps["undermain_text"]["~VALUE"]["TEXT"];
$arResult['RUNNING_DIGITS']      = str_split($arProps["running_digits"]["~VALUE"]);
$arResult['RUNNING_DIGITS_DESC'] = $arProps["running_digits_desc"]["~VALUE"]["TEXT"];
$arResult['FORM_TEXT_LEFT']      = $arProps["form_text_left"]["~VALUE"]["TEXT"];

// тайтл и дескрипшн
$arResult["TEXT_TITLE"]	= $arProps['title_ru']["~VALUE"];
$arResult["TEXT_DESCR"]	= $arProps['descr_ru']["~VALUE"];

// Решения
$arFilter = Array("IBLOCK_ID" => 28, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_*");
$result = CIBlockElement::GetList(array('SORT' => 'ASC'), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
	$arProps  = $ob->GetProperties();
	$arEl['TEXT']  			 = $arProps["text"]["~VALUE"]["TEXT"];
	$arFile  = CFile::GetFileArray($arProps["solution_img"]["~VALUE"]);
	$arEl['IMG']['SRC'] 	 = $arFile["SRC"];
	$arEl['IMG']['STYLE'] 	 = 'style="padding-top:'.$arFile['HEIGHT'].'px"';
	$arEl['PIC'][1]['TEXT']  = $arProps["pic1_text"]["~VALUE"]["TEXT"];
	$arFile  = CFile::GetFileArray($arProps["pic1_img"]["~VALUE"]);
	$arEl['PIC'][1]['IMG']   = $arFile["SRC"];
	$arEl['PIC'][2]['TEXT']  = $arProps["pic2_text"]["~VALUE"]["TEXT"];
	$arFile  = CFile::GetFileArray($arProps["pic2_img"]["~VALUE"]);
	$arEl['PIC'][2]['IMG']   = $arFile["SRC"];
	$arEl['PIC'][3]['TEXT']  = $arProps["pic3_text"]["~VALUE"]["TEXT"];
	$arFile  = CFile::GetFileArray($arProps["pic3_img"]["~VALUE"]);
	$arEl['PIC'][3]['IMG']   = $arFile["SRC"];
	$arResult['SOLUTIONS'][] = $arEl;
}
if ($_SERVER['REMOTE_ADDR'] == '95.220.44.210') {
	// print_r($arResult);
}
$this->IncludeComponentTemplate();