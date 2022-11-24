<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!((strtok($_SERVER["REQUEST_URI"], '?') == '/products/') ||
	 (strtok($_SERVER["REQUEST_URI"], '?') == '/products/index.php'))) {
	$this->AbortResultCache();
    @define('ERROR_404', 'Y');
    return;
}


CModule::IncludeModule("iblock");
// инфо из инфоблока страницы
$arFilter = Array("IBLOCK_ID" => 16, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
	$arProps = $ob->GetProperties();
}
$arResult['HEADER1']    = $arProps['header1']['~VALUE'];
$arFile = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
if ($arFile["SRC"]) {
	$arResult["BANNER"]["SRC"] 	 = $arFile["SRC"];
	$arResult["BANNER"]["STYLE"] = 'style="padding-top:calc('.$arFile["HEIGHT"].' / '.$arFile["WIDTH"].' * 100%)"';
} else {
	$arResult["BANNER"]["SRC"] 	 = SITE_TEMPLATE_PATH.'/img/banner_products.jpg';
	$arResult["BANNER"]["STYLE"] = ' style="padding-top:calc(340 / 1700 * 100%)"';
}
$arResult['H1COLOR']    = $arProps["h1color"]['VALUE_XML_ID'];
$arResult['SHOWFORM']   = $arProps['feedback_show']['VALUE_XML_ID'];
// тайтл и дескрипшн
$arResult["TEXT_TITLE"]	= $arProps['title_ru']["~VALUE"];
$arResult["TEXT_DESCR"]	= $arProps['descr_ru']["~VALUE"];

// инфо из инфоблока СКАЛА и АРЕНАДАТА
$arFilter = Array("IBLOCK_ID" => 27, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PICTURE", "PROPERTY_*");
$result = CIBlockElement::GetList(array('SORT'=>'ASC'), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
    $arFields = $ob->GetFields();
	$arProps  = $ob->GetProperties();
	$arEl['NAME']      = $arFields['NAME'];
	$arFile = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
	$arEl["BACKIMG"]   = $arFile["SRC"];
	$arEl['MAINCOLOR'] = $arProps["maincolor"]['VALUE_XML_ID'];
	$arEl['ANONS']     = $arProps['anons']['~VALUE'];
	$arEl['LINK']      = $arProps['sitelink']['~VALUE'];
	$arEl['TEXT']      = $arProps['text']['~VALUE']['TEXT'];
	$arFile = CFile::GetFileArray($arProps['logo']['~VALUE']);
	$arEl["LOGO"]      = $arFile["SRC"];
	$arResult['EXTRA'][] = $arEl;
}


// дерево разделов инфоблока Продукты и решения (15)
function getSectionList($filter, $select)
{
	$arFilter = array_merge( Array('ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y'), is_array($filter) ? $filter : Array() );
	$arSelect = array_merge(Array('ID', 'IBLOCK_SECTION_ID'), is_array($select) ? $select : Array() );
	$dbSection = CIBlockSection::GetList(Array('LEFT_MARGIN' => 'ASC', ), $arFilter, true, $arSelect);
	while( $arSection = $dbSection-> GetNext(true, false) ){
		$SID = $arSection['ID'];
		$PSID = (int) $arSection['IBLOCK_SECTION_ID'];
		$arLinks[$PSID]['CHILDS'][$SID] = $arSection;    
		$arLinks[$SID] = &$arLinks[$PSID]['CHILDS'][$SID];
	}
	return array_shift($arLinks);
}   

$arSections = getSectionList(
	Array('IBLOCK_ID' => $arParams['IBLOCK_ID']),
	Array(
	   'NAME',
	   'CODE',
	   'SORT',
	   'ELEMENT_CNT'
	)
);
   
// список элементов инфоблока Продукты и решения (15)
$arFilter = Array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y');
$arSelect = Array('NAME','CODE','IBLOCK_SECTION_ID','SORT');
$dbElement = CIBlockElement::GetList(Array('SORT'=>'ASC'), $arFilter, false, false, $arSelect);
while($ar_element = $dbElement->GetNext(false, false)) {
	$arElements[] = $ar_element;
}

// сборка дерева разделов и элементов
foreach ($arSections['CHILDS'] as $k1 => $section) {
	$arProducts[$k1] = $section;
	foreach ($arElements as $k2 => $el) {
		if ($el['IBLOCK_SECTION_ID'] == $k1) {
			$arProducts[$k1]['CHILDS'][$k2] = $el;
		}
	}
	foreach ($section['CHILDS'] as $k3 => $sec) {
		foreach ($arElements as $k2 => $el) {
			if ($el['IBLOCK_SECTION_ID'] == $k3) {
				$arProducts[$k1]['CHILDS'][$k3]['CHILDS'][$k2] = $el;
			}
		}    
	}
}
// сортировка собранного дерева
foreach ($arProducts as $k => &$v) {    
	uasort($v['CHILDS'], function($a, $b) {
		$retval = $a['SORT'] <=> $b['SORT'];
		if ($retval == 0) {
			$retval = $a['ID'] <=> $b['ID'];
		}
		return $retval;
	});
}
unset($v);

$arResult['PRODUCTS'] = $arProducts;

if ($_SERVER['REMOTE_ADDR'] == '95.220.44.210') {    
	// print_r($arResult);
}


$this->IncludeComponentTemplate();

?>