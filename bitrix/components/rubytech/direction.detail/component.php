<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule("iblock");

$arSelect = Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "DETAIL_PICTURE", "CODE", "PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "CODE"=>basename($arParams['CODE']), "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(array('SORT' => 'asc'), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps  = $ob->GetProperties();
    $arNeed = array();
}

// тайтл и дескрипшн
$arResult["TEXT_TITLE"]	= $arProps['title_ru']["~VALUE"];
$arResult["TEXT_DESCR"]	= $arProps['descr_ru']["~VALUE"];

$arResult['NAME']       = $arFields["NAME"];
$arResult['LONGNAME']   = $arProps["header1"]["~VALUE"];
$arFile = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
if ($arFile["SRC"]) {
	$arResult["BANNER"]["SRC"] 	 = $arFile["SRC"];
	$arResult["BANNER"]["STYLE"] = 'style="padding-top:'.$arFile["HEIGHT"].'px"';
} else {
	$arResult["BANNER"]["SRC"] 	 = SITE_TEMPLATE_PATH.'/img/banner-direction.jpg';
	$arResult["BANNER"]["STYLE"] = 'style="padding-top:320px"';
}
$arResult['H1COLOR']    = ($arProps["h1color"]['VALUE_XML_ID']? $arProps["h1color"]['VALUE_XML_ID'] : 'white');
$arResult['BIGTEXT']    = $arProps["bigtext"]["~VALUE"]["TEXT"];
$arResult['TEXT']       = $arProps["text"]["~VALUE"]["TEXT"];
$arResult['FIO']        = $arProps["form_fio"]["~VALUE"];
$arResult['JOB']        = $arProps["form_job"]["~VALUE"];
$arFile2 = CFile::GetFileArray($arProps["form_avatar"]["~VALUE"]);
$arResult["AVATAR"]     = ($arFile2["SRC"]? $arFile2["SRC"] : SITE_TEMPLATE_PATH.'/img/person.jpg');
$arResult['SHOWFORM']   = $arProps['feedback_show']['VALUE_XML_ID'];


foreach ($arProps["navblock"]["DESCRIPTION"] as $k => $val) {
    $arNeed[$k]["name"] = $val;
}
foreach ($arProps["navblock"]["~VALUE"] as $k => $val) {
    $arNeed[$k]["text"] = $val["TEXT"];
}
$arResult['NAVBLOCK'] = $arNeed;

// названия родительских разделов
// $res = CIBlockSection::GetNavChain($arParams['IBLOCK_ID'], $arFields['IBLOCK_SECTION_ID'], Array('NAME'));
// while($ob = $res->GetNextElement()) {
// 	$arF = $ob->GetFields();
// 	$zxc[] = $arF['NAME'];
// }
// $arResult['NAVCHAIN'] = $zxc;


// контакты
$arFilter = Array("IBLOCK_ID" => 18, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
	$arProps  = $ob->GetProperties();
}
$arResult['EMAIL']   = $arProps["email"]["~VALUE"];
$arResult['PHONE']   = $arProps["phone"]["~VALUE"];


if(!isset($arResult['NAME'])) {
    $this->AbortResultCache();
    @define('ERROR_404', 'Y');
    return;
}


// if ($_SERVER['REMOTE_ADDR'] == '95.220.44.210') {
// var_dump($CODE);
    // print_r($arResult);
// }


$this->IncludeComponentTemplate();