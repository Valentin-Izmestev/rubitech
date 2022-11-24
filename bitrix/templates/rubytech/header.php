<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
define("SITE_SERVER_PROTOCOL", (CMain::IsHTTPS()) ? "https://" : "http://");
$curPage = $APPLICATION->GetCurPage();
?><!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?$APPLICATION->ShowTitle()?></title>
	<?$APPLICATION->ShowHead()?>
	<link rel="shortcut icon" href="/rubytech_favicon.ico" type="image/x-icon">
	<link rel="icon" href="/rubytech_favicon.ico" type="image/x-icon">
	<link href="<?=SITE_TEMPLATE_PATH?>/css/jquery.fancybox.min.css" rel="stylesheet" type="text/css">
	<link href="<?=SITE_TEMPLATE_PATH?>/css/styles.css?v=<?=time()?>" rel="stylesheet" type="text/css">
	<meta itemprop="image" content="<?=SITE_TEMPLATE_PATH?>/img/rubytech.jpg">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="https://rubytech.ru">
	<meta name="twitter:title" content="<?$APPLICATION->ShowProperty("title")?>">
	<meta name="twitter:description" content="<?=$APPLICATION->ShowProperty("description")?>">
	<meta name="twitter:image:src" content="<?=SITE_TEMPLATE_PATH?>/img/rubytech.jpg">
	<meta property="og:url" content="<?=SITE_SERVER_PROTOCOL . SITE_SERVER_NAME . $curPage?>">
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?$APPLICATION->ShowProperty("title")?>">
	<meta property="og:description" content="<?=$APPLICATION->ShowProperty("description")?>">
	<meta property="og:site_name" content="Рубитех">
	<meta property="og:image" content="<?=SITE_TEMPLATE_PATH?>/img/rubytech.jpg">	
	<script src="<?=SITE_TEMPLATE_PATH?>/js/maskedinput.js"></script>
</head>
<body>
<?$APPLICATION->ShowPanel();?>
<header>
	<div class="wrap">
		<a class="logo" href="/">
			<svg class="svg-icon" viewBox="0 0 285 70">
				<g>
					<path class="color" d="M97.6,41.6h-4.2V52h-6.8V17.1h13.3c4.3,0,7.6,1.1,9.9,3.3c2.3,2.2,3.5,5.1,3.5,9c0,3-0.7,5.4-2.1,7.4
						c-1.4,2-3.4,3.3-6,4.1l8.4,10.5V52h-7.6L97.6,41.6z M93.4,35.2h6.2c2.3,0,4-0.4,5.1-1.4c1.1-1,1.7-2.4,1.7-4.4c0-2-0.6-3.4-1.7-4.4
						c-1.1-1-2.8-1.5-5.1-1.5h-6.2V35.2z"></path>
					<path class="color" d="M138.6,27.4V52h-5.5l-0.7-3.5h-0.2c-0.6,1.3-1.7,2.3-3,3.1c-1.4,0.7-3,1.1-4.8,1.1c-2.9,0-5.1-0.9-6.8-2.7
						c-1.6-1.8-2.4-4.3-2.4-7.6v-15h6.4v13.4c0,3.9,1.8,5.9,5.1,5.9c1.8,0,3-0.5,4-1.6c1-1.1,1.5-2.5,1.5-4.4V27.4H138.6z"></path>
					<path class="color" d="M162.1,28.5c1.8,1.1,3.3,2.7,4.3,4.6c1,2,1.5,4.2,1.5,6.6c0,2.4-0.5,4.6-1.5,6.6c-1,2-2.5,3.5-4.3,4.6
						c-1.8,1.1-3.8,1.7-6,1.7c-1.7,0-3.2-0.3-4.6-1c-1.4-0.7-2.5-1.9-3.1-3h-0.2l-0.7,3.4H142V17.2h6.4v13.7h0.2c0.7-1.3,1.7-2.3,3.1-3
						c1.3-0.7,2.9-1,4.5-1C158.4,26.9,160.3,27.4,162.1,28.5z M159.5,44.8c1.2-1.3,1.8-3,1.8-5c0-2-0.6-3.7-1.8-5c-1.2-1.3-2.9-2-4.8-2
						c-2,0-3.5,0.7-4.7,2c-1.2,1.3-1.8,3-1.8,5c0,2,0.6,3.7,1.8,5c1.2,1.3,2.8,1.9,4.7,1.9C156.7,46.7,158.4,46,159.5,44.8z"></path>
					<path class="color" d="M205.9,46.7c-0.5,0-0.9,0-1.4,0c-1.6,0-2.7-0.3-3.4-1c-0.7-0.7-1-1.7-1-3.6v-8.7h5.8v-6H200v-6.1h-6.4v21.6
						c0,3.6,0.8,5.8,2.4,7.4c1.6,1.6,4,2.4,7.2,2.4c1,0,1.9-0.1,2.7-0.3V46.7z"></path>
					<path class="color" d="M281.8,29.6c1.6,1.8,2.5,4.3,2.5,7.5V52h-6.4V38.8c0-2.3-0.5-3.4-1.4-4.4c-0.9-1-2.1-1.5-3.7-1.5
						c-1.8,0-3,0.5-4,1.6c-1,1.1-1.4,2.5-1.4,4.6V52h-6.5V17.2h6.4V31h0.2c0.7-1.2,1.6-2.3,3-3.1c1.4-0.7,2.8-1.1,4.6-1.1
						C277.9,26.9,280.1,27.8,281.8,29.6z"></path>
					<polygon class="color" points="172.1,61.4 178.9,61.4 192.6,28 192.6,27.4 185.9,27.4 179.5,43.8 179.3,43.8 172.8,27.4 
						166.1,27.4 166.1,28 175.8,51.7 172.1,60.8"></polygon>
					<path class="color" d="M225.4,44.6c-0.3,0.8-0.9,1.5-1.8,2c-1,0.6-2.3,0.9-3.8,0.9c-3.9,0-6.3-2.5-6.7-5.7h18.8
						c0.1-0.7,0.1-1.3,0.1-2c0-2.5-0.5-4.8-1.6-6.7c-1.1-1.9-2.7-3.5-4.5-4.5c-1.9-1.1-4.1-1.6-6.5-1.6c-2.5,0-4.7,0.6-6.6,1.7
						c-1.9,1.1-3.4,2.6-4.4,4.6c-1.1,2-1.6,4.2-1.6,6.7s0.5,4.7,1.6,6.6c1.1,1.9,2.6,3.5,4.5,4.6c2,1.1,4.2,1.7,6.8,1.7
						c3.2,0,5.8-0.8,7.9-2.4c2-1.5,3.3-3.4,3.9-5.7H225.4z M219.6,32c3.3,0,5.7,2.3,6,5.7h-12.3C213.9,33.9,216.2,32,219.6,32z"></path>
					<path class="color" d="M252.4,42.8c-0.3,1.2-1,2.1-1.8,2.8c-1,0.8-2.2,1.3-3.7,1.3c-1.9,0-3.4-0.7-4.6-2c-1.2-1.3-1.7-3-1.7-5
						c0-2.1,0.5-3.9,1.6-5.1c1.1-1.3,2.7-2,4.6-2c1.5,0,2.7,0.5,3.8,1.3c0.9,0.7,1.6,1.7,1.9,2.8h6.4c-0.1-1.6-0.7-3.4-1.7-4.8
						c-1.1-1.6-2.6-2.8-4.4-3.7c-1.8-0.9-3.8-1.3-6-1.3c-2.5,0-4.8,0.6-6.7,1.7c-1.9,1.1-3.4,2.7-4.4,4.6c-1.1,2-1.6,4.1-1.6,6.6
						c0,2.4,0.5,4.6,1.6,6.5c1.1,2,2.6,3.5,4.5,4.6c1.9,1.1,4.2,1.7,6.7,1.7c2.2,0,4.2-0.4,6-1.3c1.8-0.9,3.2-2.1,4.3-3.7
						c1-1.4,1.6-3.2,1.7-4.9H252.4z"></path>
					<g>
						<path opacity="0.55" fill="#FF4C00" d="M28.9,1.1L3.3,15.9c-1.6,0.9-2.5,1.9-2.5,4.4v29.5c0,1,0.2,1.8,0.5,2.4L31.6,0.4
							C30.7,0.4,29.7,0.6,28.9,1.1z"></path>
						<path opacity="0.8" fill="#FF4C00" d="M59.5,15.9L33.9,1.1c-0.7-0.4-1.5-0.6-2.3-0.7L1.3,52.2c0,0,0,0.1,0.1,0.1l60.1-34.7
							C61,16.9,60.3,16.4,59.5,15.9z"></path>
						<path fill="#FF4C00" d="M1.4,52.3c0.4,0.8,1.1,1.3,1.9,1.8l25.6,14.8c1.6,0.9,3.5,0.9,5,0l25.6-14.8c1.6-0.9,2.5-2.1,2.5-4.4V20.2
							c0-1.1-0.2-1.9-0.6-2.6L1.4,52.3z"></path>
						<polygon fill="#FF4C00" points="61.4,17.6 1.3,52.3 1.4,52.3 61.4,17.6"></polygon>
					</g>
				</g>
			</svg>
		</a>
		<nav>
			<?$APPLICATION->IncludeComponent("bitrix:menu", "topmenu", Array(
				"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
					"MAX_LEVEL" => "1",	// Уровень вложенности меню
					"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
					"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
					"COMPONENT_TEMPLATE" => "horizontal_multilevel",
					"MENU_CACHE_TYPE" => "N",	// Тип кеширования
					"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
					"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
					"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
					"DELAY" => "N",	// Откладывать выполнение шаблона меню
					"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
				),
				false
			);?>
		</nav>
		<div class="sidebar-toggle">
			<svg class="svg-icon" viewBox="406.9 290.1 28 15">
				<rect x="407.3" y="290.1" width="27.3" height="2.7"/>
				<rect x="407.3" y="302.4" width="27.3" height="2.7"/>
			</svg>				
		</div>
		<? $APPLICATION->IncludeFile(SITE_DIR."include/phone.php", Array(), Array());?>
	</div>
</header>
<?$APPLICATION->IncludeComponent("rubytech:sidebar", "", array(), false);?>
<script src="<?=SITE_TEMPLATE_PATH?>/js/menu.js"></script>

