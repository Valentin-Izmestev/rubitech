<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule("iblock");

// проект
$arFilter = Array("IBLOCK_ID" => 31, "CODE"=>basename($arParams['CODE']), "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "CODE", "PREVIEW_PICTURE", "PREVIEW_TEXT", "DETAIL_PICTURE", "DETAIL_TEXT", "PROPERTY_*");
$result = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($ob = $result->GetNextElement()) {
    $arFields = $ob->GetFields();
	$arProps  = $ob->GetProperties();
}
// тайтл и дескрипшн
$arResult["TEXT_TITLE"]		= $arProps['title_ru']["~VALUE"];
$arResult["TEXT_DESCR"]		= $arProps['descr_ru']["~VALUE"];

$arResult['NAME']       	= $arFields["NAME"];
$arResult["LINK"]       	= $arFields["CODE"];
$arFile = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
$arResult["ANONSIMG"]   	= $arFile["SRC"];
$arResult["TEXT"]       	= $arFields["DETAIL_TEXT"];
$arResult["ANONCE"]       	= $arFields["PREVIEW_TEXT"];

$arResult['PUBLISHED']  	= $arProps['publish_link']['VALUE_XML_ID'];
$arResult['FIO']        	= $arProps["form_fio"]["~VALUE"];
$arResult['JOB']        	= $arProps["form_job"]["~VALUE"];
$arFile2 = CFile::GetFileArray($arProps["form_avatar"]["~VALUE"]);
$arResult["AVATAR"]     	= ($arFile2["SRC"]? $arFile2["SRC"] : SITE_TEMPLATE_PATH.'/img/person.jpg');
$arResult['SHOWFORM'] 		= $arProps['feedback_show']['VALUE_XML_ID'];

if (count($arProps['directions_link']['~VALUE']) > 0) {
	foreach ($arProps['directions_link']['~VALUE'] as $key => $ID) {
		$res = CIBlockElement::GetByID($ID);
		if ($ob = $res->GetNext()) {
			$el['name'] = $ob['NAME'];
			$el['code'] = $ob['DETAIL_PAGE_URL'];
			$arResult['EXPERTLINKS'][] = $el;
		}
	}
}

// получение предыдущей и двух следующих статей
// $counter = 0;
// $current = 0;
// $prev  = 0;
// $next  = 0;
// $next2 = 0;
// $arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE", "PREVIEW_PICTURE", "PROPERTY_*");
// $arFilter = Array("IBLOCK_ID"=>22, "ACTIVE"=>"Y");
// $result = CIBlockElement::GetList(array('SORT' => 'ASC','PROPERTY_publicdate'=>'DESC'), $arFilter, false, false, $arSelect);
// while($ob = $result->GetNextElement()) {
//     $arFields = $ob->GetFields();
//     $arProps  = $ob->GetProperties();
//     $arEl = array();

//     $arEl["NAME"] = $arFields["NAME"];
//     $arEl['DATE'] = EditData($arProps['publicdate']['~VALUE']); 
//     $arEl["LINK"] = $arFields["CODE"];
//     if($arEl["LINK"]==$arResult["LINK"])
//         $current = $counter;

//     $arFile = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array('width'=> 380, 'height'=> 210), BX_RESIZE_IMAGE_EXACT, true);
//     $arEl["IMG_PREVIEW"] = $arFile['src'];
//     $res = CIBlockSection::GetNavChain($arParams['IBLOCK_ID'], $arFields['IBLOCK_SECTION_ID'], Array('NAME'));
//     while($ob = $res->GetNextElement()) {
//         $arF  = $ob->GetFields();
//         $rn   = $arF['NAME'];
//     }
//     $arEl['RUBRICNAME'] = $rn;
    
//     $articles[] = $arEl;
//     $counter++;
// }
// if (sizeof($articles) > 1) {
//     if($current > 0)  $prev = $current - 1;
//                  else $prev = sizeof($articles) - 1;
//     if (sizeof($articles) > 2) {
//         if($current < (sizeof($articles)-2)) { 
//             $next  = $current + 1;
//             $next2 = $current + 2;
//         } elseif ($current < (sizeof($articles)-1)) {
//             $next  = $current + 1;
//             if (sizeof($articles) > 3) {
//                 $next2 = 0;
//             }
//         } else {
//             $next  = 0;
//             if (sizeof($articles) > 3) {
//                 $next2 = 1;
//             }
//         }
//     }
//     $arResult["MORE"][0]  = $articles[$prev];
//     if($articles[$next])
//     $arResult["MORE"][1]  = $articles[$next];
//     if($articles[$next2])
//     $arResult["MORE"][2]  = $articles[$next2];
// }


if(!isset($arResult['LINK'])) {
    $this->AbortResultCache();
    @define('ERROR_404', 'Y');
    return;
}

if ($_SERVER['REMOTE_ADDR'] == '46.73.139.195') {
    // print_r($arResult);
}

$this->IncludeComponentTemplate();