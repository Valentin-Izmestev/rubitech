<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");?>
<?$APPLICATION->AddHeadString('<link rel="canonical" href="https://'. SITE_SERVER_NAME . $APPLICATION->GetCurPage(false) . '">'); ?>

	
<?$APPLICATION->IncludeComponent("rubytech:mainpage", "", array(), false);?>

<![if IE]>
<script src="<?=SITE_TEMPLATE_PATH?>/js/intersection-observer-polyfill.js"></script>
<![endif]>
<script src="<?=SITE_TEMPLATE_PATH?>/js/runner.js"></script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>