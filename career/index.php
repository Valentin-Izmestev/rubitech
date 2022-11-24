<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<? $APPLICATION->AddHeadString('<link rel="canonical" href="https://'. SITE_SERVER_NAME . $APPLICATION->GetCurPage(false) . '">'); ?>

<? $APPLICATION->IncludeComponent("rubytech:career", "", array("IBLOCK_ID" => "25"), false); ?>

<script src="<?=SITE_TEMPLATE_PATH?>/js/career.js"></script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>