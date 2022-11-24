<?include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");
?>
<div class="wrap" style="margin-top:150px;margin-bottom:100px;">
	<h1>404</h1>
	<h2>Запрашиваемая страница не найдена</h2>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>