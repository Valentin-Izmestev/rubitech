<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule("iblock");

// инфо из инфоблока страницы
$arFilter = Array("IBLOCK_ID" => 18, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
	$arProps  = $ob->GetProperties();
}
$arResult['PHONE']   = $arProps["phone"]["~VALUE"];
$arResult['EMAIL']   = $arProps["email"]["~VALUE"];
$arResult['ADDRESS'] = $arProps["address"]["~VALUE"]["TEXT"];
$arResult['FB']      = $arProps["facebook"]["~VALUE"];
$arResult['HH']      = $arProps["headhunter"]["~VALUE"];
$arResult['YT']      = $arProps["youtube"]["~VALUE"];

$this->IncludeComponentTemplate();