<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
CModule::IncludeModule("iblock");


$arFilter = Array("IBLOCK_ID" => 25, "CODE"=>basename($arParams['CODE']), "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PICTURE", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
    $arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
}
$arResult["NAME"]     = $arFields["NAME"];
$arResult["CODE"]     = $arFields["CODE"];
$arResult["HHLINK"]   = $arProps["hh_link"]['~VALUE'];
$arResult["DEPT"]     = $arProps["dept_name"]['~VALUE'];
// $arResult["ANONS"]    = $arProps["anons"]['~VALUE'];
$arResult["DESCR"]    = $arProps["descr_text"]['~VALUE']['TEXT'];
$arResult["TASKS"]    = $arProps["your_tasks"]['~VALUE']['TEXT'];
$arResult["SKILLS"]   = $arProps["your_skills"]['~VALUE']['TEXT'];
$arResult["BENEFITS"] = $arProps["benefits"]['~VALUE']['TEXT'];
$arResult['SHOWFORM'] = $arProps['feedback_show']['VALUE_XML_ID'];
// тайтл и дескрипшн
$arResult["TEXT_TITLE"]	= $arProps['title_ru']["~VALUE"];
$arResult["TEXT_DESCR"]	= $arProps['descr_ru']["~VALUE"];


// контакты
$arFilter = Array("IBLOCK_ID" => 18, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
	$arProps  = $ob->GetProperties();
}
$arResult['EMAIL']      = $arProps["email"]["~VALUE"];
$arResult['HHDEFAULT']  = $arProps["headhunter"]["~VALUE"];


if(!isset($arResult['CODE'])) {
    $this->AbortResultCache();
    @define('ERROR_404', 'Y');
    return;
}


if ($_SERVER['REMOTE_ADDR'] == '95.220.44.210') {
    //  var_dump($arResult);
    //echo (!$arResult['CODE']);
}

$this->IncludeComponentTemplate();