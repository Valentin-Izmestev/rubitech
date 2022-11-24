<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule("iblock");

$arFilter = Array("IBLOCK_ID" => 21, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
    $arFields = $ob->GetFields();
	$arProps  = $ob->GetProperties();
    $arEl["NAME"]  = $arFields["NAME"];
    $arFile = CFile::GetFileArray($arProps["logo"]["~VALUE"]);
    $arEl["IMG"]   = $arFile["SRC"];
    $arEl["LOGOW"] = $arProps["logo_width"]["~VALUE"];
    $arEl["LOGOH"] = $arProps["logo_height"]["~VALUE"];
    $arEl["LOGOB"] = $arProps["logo_marginb"]["~VALUE"];
    $arResult["CLIENTS"][] = $arEl;
}


$this->IncludeComponentTemplate();