<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<? $APPLICATION->AddHeadString('<link rel="canonical" href="https://'. SITE_SERVER_NAME . $APPLICATION->GetCurPage(false) . '">'); ?>

<?
$APPLICATION->IncludeComponent("rubytech:direction.detail", "", array("IBLOCK_ID" => "30", "CODE" => $CODE), false);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>