<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!((strtok($_SERVER["REQUEST_URI"], '?') == '/career/') ||
	 (strtok($_SERVER["REQUEST_URI"], '?') == '/career/index.php'))) {
	$this->AbortResultCache();
    @define('ERROR_404', 'Y');
    return;
}


CModule::IncludeModule("iblock");
// данные страницы
$arFilter = Array("IBLOCK_ID" => 26, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PICTURE", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
    $arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
}
$arFile = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
if ($arFile["SRC"]) {
	$arResult["BANNER"]["SRC"] 	 = $arFile["SRC"];
	$arResult["BANNER"]["STYLE"] = 'style="padding-top:calc('.$arFile["HEIGHT"].' / '.$arFile["WIDTH"].' * 100%)"';
} else {
	$arResult["BANNER"]["SRC"] 	 = SITE_TEMPLATE_PATH.'/img/banner-career.jpg';
	$arResult["BANNER"]["STYLE"] = ' style="padding-top:calc(340 / 1700 * 100%)"';
}
$arResult['HEADER1']    = $arFields["NAME"];
$arResult['H1COLOR']    = $arProps["h1color"]['VALUE_XML_ID'];
$arResult['HEADER2']    = $arProps["header2"]["~VALUE"];
$arResult['TEXT']       = $arProps["text"]["~VALUE"]['TEXT'];
$arResult['SHOWFORM']   = $arProps['feedback_show']['VALUE_XML_ID'];
// тайтл и дескрипшн
$arResult["TEXT_TITLE"]	= $arProps['title_ru']["~VALUE"];
$arResult["TEXT_DESCR"]	= $arProps['descr_ru']["~VALUE"];

// список рубрик для селекта
$arFilter = Array('IBLOCK_ID'=>25, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE'=>'Y'); 
$arSelect = Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "CODE");
$result = CIBlockSection::GetList(Array('SORT' => 'ASC'), $arFilter, true, $arSelect);
while( $arSection = $result-> GetNext(true, false) ){
	if($arSection['ELEMENT_CNT']==0) continue;
    $list["NAME"] = $arSection['NAME'];
    $list["CODE"] = $arSection['CODE'];
    $arResult["RUBRICS"][] = $list;
}
// контакты
$arFilter = Array("IBLOCK_ID" => 18, "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
	$arProps  = $ob->GetProperties();
}
$arResult['EMAIL']   = $arProps["email"]["~VALUE"];


// дерево разделов инфоблока Вакансии (25)
function getSectionList($filter, $select)
{
	$arFilter = array_merge( Array('ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y'), is_array($filter) ? $filter : Array() );
	$arSelect = array_merge(Array('ID', 'IBLOCK_SECTION_ID'), is_array($select) ? $select : Array() );
	$dbSection = CIBlockSection::GetList(Array('LEFT_MARGIN' => 'ASC', ), $arFilter, true, $arSelect);
	while( $arSection = $dbSection-> GetNext(true, false) ){
		if($arSection['ELEMENT_CNT']==0) continue;
		$SID = $arSection['ID'];
		$PSID = (int) $arSection['IBLOCK_SECTION_ID'];
		$arLinks[$PSID]['CHILDS'][$SID] = $arSection;    
		$arLinks[$SID] = &$arLinks[$PSID]['CHILDS'][$SID];
	}
	return array_shift($arLinks);
}


$arSections = getSectionList(Array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'CNT_ACTIVE' => "Y"),	Array('NAME','CODE','SORT','ELEMENT_CNT','PROPERTY_*'));

// список элементов инфоблока Вакансии (25)
$arFilter = Array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y');
// если в строке поиска что-то набрали
$QUERY = strip_tags(trim($_REQUEST['q']));
$QUERY = htmlentities($QUERY, ENT_QUOTES, "UTF-8");
$QUERY = htmlspecialchars($QUERY, ENT_QUOTES); 
if($QUERY) { 
    $arFilter = Array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ACTIVE"=>"Y", "SEARCHABLE_CONTENT"=>'%'.$QUERY.'%');
}
$arResult['QUERY'] = $QUERY;

$arSelect = Array('ID','IBLOCK_ID','IBLOCK_SECTION_ID','NAME','CODE','SORT','PROPERTY_*');
$dbElement = CIBlockElement::GetList(Array('SORT'=>'ASC'), $arFilter, false, false, $arSelect);
while($ob = $dbElement->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps  = $ob->GetProperties();
    $ar_el['NAME']              = $arFields['NAME'];
    $ar_el['CODE']              = $arFields['CODE'];
    $ar_el['IBLOCK_SECTION_ID'] = $arFields['IBLOCK_SECTION_ID'];
    $ar_el['SORT']              = $arFields['SORT'];
    $ar_el['DEPT']              = $arProps['dept_name']['~VALUE'];
    $ar_el['ANONS']             = $arProps['anons']['~VALUE'];
    $ar_el['DESCR']             = $arProps['descr_text']['~VALUE']['TEXT'];
	$arElements[] = $ar_el;
}

// сборка дерева разделов и элементов
$i=0;
foreach ($arSections['CHILDS'] as $k1 => $section) {
    $arVItems[$i] = $section;
    // $j=0;
	foreach ($arElements as $k2 => $el) {
		if ($el['IBLOCK_SECTION_ID'] == $k1) {
			$arVItems[$i]['CHILDS'][] = $el;
		}
	}
	foreach ($section['CHILDS'] as $k3 => $sec) {
		foreach ($arElements as $k2 => $el) {
			if ($el['IBLOCK_SECTION_ID'] == $k3) {
				$arVItems[$i]['CHILDS'][$k3]['CHILDS'][$k2] = $el;
			}
		}    
    }
    $i++;
}
// сортировка собранного дерева
foreach ($arVItems as $k => &$v) {    
	uasort($v['CHILDS'], function($a, $b) {
		$retval = $a['SORT'] <=> $b['SORT'];
		if ($retval == 0) {
			$retval = $a['ID'] <=> $b['ID'];
		}
		return $retval;
	});
}
unset($v);

$arResult['VACANCIES'] = $arVItems;


if ($_SERVER['REMOTE_ADDR'] == '95.220.44.210') {
   // print_r($arResult);
}

$this->IncludeComponentTemplate();