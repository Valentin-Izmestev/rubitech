<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule("iblock");

// инфо из инфоблока страницы
$arFilter = Array("IBLOCK_ID" => 18, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
	$arProps  = $ob->GetProperties();
}
$PHONE = $arProps["phone"]["~VALUE"];
?>
<a class="tel" href="tel:+<?=preg_replace('~[^0-9]+~', '', $PHONE)?>"><?=$PHONE?></a>
