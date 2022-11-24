<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!((strtok($_SERVER["REQUEST_URI"], '?') == '/press-center/') ||
     (strtok($_SERVER["REQUEST_URI"], '?') == '/press-center/index.php'))) {
    $this->AbortResultCache();
    @define('ERROR_404', 'Y');
    return;
}

function EditData($DATA) // конвертирует формат даты с 04.11.2020 в 04 Ноября 2020
{
    $MES = array( 
    "01" => "Января", 
    "02" => "Февраля", 
    "03" => "Марта", 
    "04" => "Апреля", 
    "05" => "Мая", 
    "06" => "Июня", 
    "07" => "Июля", 
    "08" => "Августа", 
    "09" => "Сентября", 
    "10" => "Октября", 
    "11" => "Ноября", 
    "12" => "Декабря"
    );
    $arData = explode(".", $DATA); 
    $d = ($arData[0] < 10) ? substr($arData[0], 1) : $arData[0];
    $newData = $d." ".$MES[$arData[1]]." ".$arData[2]; 
    return $newData;
}

CModule::IncludeModule("iblock");

$count = 14; // записей на странице
$curpage = ($_GET['page']) ? $_GET['page'] : 1;

// все публикации
$arFilter = Array("IBLOCK_ID" => 22, "ACTIVE"=>"Y");
// если в строке поиска что-то набрали
$QUERY = strip_tags(trim($_REQUEST['q']));
$QUERY = htmlentities($QUERY, ENT_QUOTES, "UTF-8");
$QUERY = htmlspecialchars($QUERY, ENT_QUOTES); 
if($QUERY) { 
    $arFilter = Array("IBLOCK_ID" => 22, "ACTIVE"=>"Y", "SEARCHABLE_CONTENT"=>'%'.$QUERY.'%');
}
$arResult['QUERY'] = $QUERY;

$allCnt = CIBlockElement::GetList (Array("ID" => "DESC"), $arFilter, [], [], false);
$arResult['ALL_COUNT'] = $allCnt;
$arResult['PAGE_COUNT'] = $count;


$arSelect = Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "CODE", "PREVIEW_PICTURE", "PROPERTY_*");
$result = CIBlockElement::GetList(array('SORT' => 'ASC','PROPERTY_publicdate'=>'DESC'), $arFilter, false, 
    Array(
        'nPageSize' => $count,
        'nTopCount' => false,
        'iNumPage' => $curpage,
        'checkOutOfRange' => true
    ),
    $arSelect);

while($ob = $result->GetNext()) {
    $arEl["NAME"]     = $ob["NAME"];
    $arEl["CODE"]     = $ob["CODE"];
    // $arF    = CFile::GetFileArray($ob["PREVIEW_PICTURE"]);
    $arFile = CFile::ResizeImageGet($ob["PREVIEW_PICTURE"], array('width'=>585, 'height'=>320), BX_RESIZE_IMAGE_EXACT, true);
    $arEl["ANONSIMG"] = $arFile["src"];
    $arEl["DATE"]     = EditData($ob['~PROPERTY_PUBLICDATE_VALUE']);
    
    $res = CIBlockSection::GetNavChain($arParams['IBLOCK_ID'], $ob['IBLOCK_SECTION_ID'], Array('NAME','CODE'));
    while($ob = $res->GetNextElement()) {
        $arF  = $ob->GetFields();
        $rn   = $arF['NAME'];
        $rc   = $arF['CODE'];
    }
    $arEl['RUBRICNAME'] = $rn;
    $arEl['RUBRICCODE'] = $rc;
    
    $arResult["NEWS"][] = $arEl;
}

// данные страницы
$arFilter = Array("IBLOCK_ID" => 23, "ACTIVE"=>"Y");
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
	$arResult["BANNER"]["SRC"] 	 = SITE_TEMPLATE_PATH.'/img/banner-press.jpg';
	$arResult["BANNER"]["STYLE"] = ' style="padding-top:calc(340 / 1700 * 100%)"';
}
$arResult['HEADER1']    = $arFields["NAME"];
$arResult['SHOWFORM']   = $arProps['feedback_show']['VALUE_XML_ID'];
// тайтл и дескрипшн
$arResult["TEXT_TITLE"]	= $arProps['title_ru']["~VALUE"];
$arResult["TEXT_DESCR"]	= $arProps['descr_ru']["~VALUE"];

// список рубрик для селекта
$arFilter = Array('IBLOCK_ID'=>22, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE'=>'Y'); 
$arSelect = Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "CODE");
$result = CIBlockSection::GetList(Array('SORT' => 'ASC'), $arFilter, false, $arSelect);
while( $arSection = $result-> GetNext(true, false) ){
    $list["NAME"] = $arSection['NAME'];
    $list["CODE"] = $arSection['CODE'];
    $arResult["RUBRICS"][] = $list;
}

if ($_SERVER['REMOTE_ADDR'] == '95.220.44.210') {
    // print_r($arResult);
}

$this->IncludeComponentTemplate();