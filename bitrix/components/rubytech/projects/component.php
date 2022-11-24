<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!((strtok($_SERVER["REQUEST_URI"], '?') == '/projects/') ||
     (strtok($_SERVER["REQUEST_URI"], '?') == '/projects/index.php'))) {
    $this->AbortResultCache();
    @define('ERROR_404', 'Y');
    return;
}


CModule::IncludeModule("iblock");

$count = 14; // записей на странице
$curpage = ($_GET['page']) ? $_GET['page'] : 1;

// все публикации
$arFilter = Array("IBLOCK_ID" => 31, "ACTIVE"=>"Y");

$allCnt = CIBlockElement::GetList (Array("ID" => "DESC"), $arFilter, [], [], false);
$arResult['ALL_COUNT'] = $allCnt;
$arResult['PAGE_COUNT'] = $count;


$arSelect = Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "CODE", "PREVIEW_PICTURE", "PROPERTY_*");
$result = CIBlockElement::GetList(array('SORT' => 'ASC'), $arFilter, false, 
    Array(
        'nPageSize' => $count,
        'nTopCount' => false,
        'iNumPage' => $curpage,
        'checkOutOfRange' => true
    ),
    $arSelect);

while($ob = $result->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arProps  = $ob->GetProperties();

    $arEl["NAME"]     	 = $arFields["NAME"];
    $arEl["CODE"]     	 = $arFields["CODE"];
	$arEl["ISPUBLISHED"] = $arProps["publish_link"]["VALUE_XML_ID"]; 
    $arFile = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array('width'=>585, 'height'=>320), BX_RESIZE_IMAGE_EXACT, true);
    $arEl["ANONSIMG"] 	 = $arFile["src"];
    $arEl["DESCR"] 	  	 = $arProps["anonce"]["~VALUE"]["TEXT"];
    
    $arResult["PROJECTS"][] = $arEl;
}

// данные страницы
$arFilter = Array("IBLOCK_ID" => 32, "ACTIVE"=>"Y");
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
	$arResult["BANNER"]["SRC"] 	 = SITE_TEMPLATE_PATH.'/img/banner-projects.jpg';
	$arResult["BANNER"]["STYLE"] = ' style="padding-top:calc(340 / 1700 * 100%)"';
}
$arResult['HEADER1']    = $arFields["NAME"];
$arResult['H1COLOR']    = $arProps["h1color"]['VALUE_XML_ID'];
$arResult['SHOWFORM']   = $arProps['feedback_show']['VALUE_XML_ID'];
// тайтл и дескрипшн
$arResult["TEXT_TITLE"]	= $arProps['title_ru']["~VALUE"];
$arResult["TEXT_DESCR"]	= $arProps['descr_ru']["~VALUE"];


if ($_SERVER['REMOTE_ADDR'] == '46.73.139.195') {
    // print_r($arResult);
}

$this->IncludeComponentTemplate();