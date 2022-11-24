<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<? $APPLICATION->AddHeadString('<link rel="canonical" href="https://'. SITE_SERVER_NAME . $APPLICATION->GetCurPage(false) . '">'); ?>

<?
$APPLICATION->IncludeComponent("rubytech:partners", "", array(), false);
?>

<script src="<?=SITE_TEMPLATE_PATH?>/js/partners.js"></script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>