<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<br /><br />
<b>&copy; 2002 Битрикс, 2007 <a href="http://www.1c-bitrix.ru">1С-Битрикс</a></b>

<!-- CLEANTALK template addon -->
<?php \Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("area"); if(CModule::IncludeModule("cleantalk.antispam")) echo CleantalkAntispam::FormAddon(); ?>
<!-- /CLEANTALK template addon -->
</body>
</html>