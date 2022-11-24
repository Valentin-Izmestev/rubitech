<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<? $APPLICATION->AddHeadString('<link rel="canonical" href="https://'. SITE_SERVER_NAME . $APPLICATION->GetCurPage(false) . '">'); ?>

<?
$APPLICATION->IncludeComponent("rubytech:career.vacancy", "", array("IBLOCK_ID" => "25", "CODE" => $CODE), false);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>