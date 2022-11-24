<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<footer>
	<div class="wrap">
		<div class="footer-inner">
			<div class="col contacty" itemscope itemtype="http://schema.org/Organization">
				<meta itemprop="name" content="ООО Рубитех" />
				<div class="title">Контакты</div>
				<div>
					<a itemprop="telephone" href="tel:+<?=preg_replace('~[^0-9]+~', '',$arResult['PHONE'])?>"><?=$arResult['PHONE']?></a>
					<a itemprop="email" href="mailto:<?=$arResult['EMAIL']?>"><?=$arResult['EMAIL']?></a>
				</div>
				<div>
					<div itemprop="address"><?=$arResult['ADDRESS']?></div>
				</div>
			</div>
			<div class="social">
                <? if ($arResult['HH']) { ?>
				<a href="<?=$arResult['HH']?>">
					<img class="logo-white" src="<?=SITE_TEMPLATE_PATH?>/img/headhunter.svg" width="27" height="30" alt="follow us">
					<img class="logo-color" src="<?=SITE_TEMPLATE_PATH?>/img/headhunter-color.svg" width="27" height="30" alt="follow us">
				</a>
                <? } ?>
			</div>
			<div class="col expert">
				<div class="title">Экспертиза</div>
				<div>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "bottommenu", Array(
				    "ROOT_MENU_TYPE" => "ext",	// Тип меню для первого уровня
					"MAX_LEVEL" => "1",	// Уровень вложенности меню
					"CHILD_MENU_TYPE" => "ext",	// Тип меню для остальных уровней
					"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
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
				</div>
			</div>
			<div class="col nav">
				<div class="title">Компания</div>
				<div>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "bottommenu", Array(
				    "ROOT_MENU_TYPE" => "bot",	// Тип меню для первого уровня
					"MAX_LEVEL" => "1",	// Уровень вложенности меню
					"CHILD_MENU_TYPE" => "bot",	// Тип меню для остальных уровней
					"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
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
				</div>
			</div>
			<div class="logo">
				<svg class="svg-icon" viewBox="40 7.5 128 29">
					<g>
						<path class="color" d="M52.4,30.1L47,23.3h-3v6.8h-4V7.8h8.4c2.7,0,4.8,0.7,6.3,2.1c1.5,1.4,2.2,3.2,2.2,5.7c0,1.9-0.5,3.4-1.4,4.7c-0.8,1.2-2.1,2.1-3.8,2.6l-0.3,0.1l5.6,6.9v0.2L52.4,30.1L52.4,30.1z M44,19.5h4.2c1.6,0,2.7-0.3,3.4-0.9c0.8-0.7,1.1-1.7,1.1-3s-0.4-2.3-1.1-3c-0.7-0.6-1.9-1-3.4-1H44V19.5z"/>
						<path class="color" d="M64.4,30.5c-1.8,0-3.2-0.6-4.3-1.7c-1-1.2-1.6-2.7-1.6-4.8v-9.5h3.8V23c0,2.6,1.2,4,3.5,4c1.2,0,2-0.3,2.7-1.1c0.7-0.7,1-1.8,1-3v-8.4h3.8v15.7h-3.2l-0.4-2.3h-0.4L69.2,28c-0.4,0.8-1,1.4-1.9,1.9C66.5,30.2,65.5,30.5,64.4,30.5z"/>
						<path class="color" d="M84.9,30.5c-1,0-2-0.2-2.9-0.6c-0.9-0.5-1.6-1.2-1.9-1.8l-0.1-0.1h-0.4l-0.5,2.2H76V7.8h3.8v8.9h0.5l0.1-0.1c0.5-0.8,1.1-1.4,1.9-1.8c0.8-0.5,1.8-0.6,2.9-0.6c1.4,0,2.6,0.4,3.7,1c1.2,0.8,2.1,1.8,2.7,2.9c0.6,1.2,1,2.7,1,4.2c0,1.5-0.3,2.9-1,4.2c-0.6,1.2-1.6,2.2-2.7,2.9S86.3,30.5,84.9,30.5z M84,17.6c-1.3,0-2.4,0.5-3.2,1.4c-0.8,0.9-1.2,2-1.2,3.4c0,1.4,0.4,2.5,1.2,3.4c0.8,0.8,1.9,1.3,3.2,1.3c1.4,0,2.5-0.5,3.2-1.3c0.8-0.8,1.2-2,1.2-3.4c0-1.4-0.4-2.5-1.2-3.4C86.5,18,85.4,17.6,84,17.6z"/>
						<path class="color" d="M115.5,30.5c-2,0-3.5-0.5-4.5-1.5c-1-1-1.5-2.5-1.5-4.7V10.5h3.8v4h3.8V18h-3.8v5.8c0,1.2,0.2,1.9,0.7,2.5c0.5,0.5,1.3,0.7,2.3,0.7c0.3,0,0.5,0,0.7,0v3.4C116.6,30.4,116,30.5,115.5,30.5z"/>
						<path class="color" d="M164.2,30.1v-8.4c0-1.4-0.3-2.2-1-3c-0.6-0.7-1.4-1-2.5-1c-1.2,0-2,0.3-2.7,1.1c-0.6,0.7-1,1.7-1,3.1v8.3h-3.8V7.8h3.8v9h0.5l0.1-0.1c0.5-0.8,1.1-1.5,1.9-1.9c0.8-0.5,1.8-0.7,2.9-0.7c1.8,0,3.2,0.6,4.3,1.7c1,1.2,1.6,2.7,1.6,4.7v9.5L164.2,30.1L164.2,30.1z"/>
						<polygon class="color" points="95.5,36.2 95.5,36 97.9,30.1 91.6,14.7 91.6,14.5 95.7,14.5 99.9,25.1 100.2,25.1 104.4,14.5 108.4,14.5 108.4,14.7 99.6,36.2"/>
						<path class="color" d="M126.3,30.5c-1.6,0-3.1-0.3-4.4-1c-1.2-0.7-2.2-1.7-2.9-2.9c-0.6-1.2-1-2.7-1-4.2s0.3-3,1-4.2c0.7-1.3,1.6-2.3,2.8-2.9c1.2-0.7,2.7-1,4.2-1c1.5,0,2.9,0.3,4.1,1c1.2,0.7,2.2,1.7,2.9,2.9c0.6,1.2,1,2.7,1,4.3c0,0.3,0,0.7,0,1.1h-12.3v0.2c0.3,2.3,2,3.9,4.5,3.9c1,0,1.9-0.2,2.5-0.6c0.5-0.3,1-0.7,1.2-1.2h3.6c-0.4,1.3-1.2,2.5-2.4,3.3C130,30,128.3,30.5,126.3,30.5z M126.2,17.1c-2.3,0-3.9,1.4-4.2,3.9v0.2h8.4V21C130,18.6,128.4,17.1,126.2,17.1z"/>
						<path class="color" d="M143.8,30.5c-1.6,0-3.1-0.4-4.3-1.1c-1.2-0.7-2.2-1.7-2.9-2.9s-1-2.7-1-4.2s0.3-2.9,1-4.2c0.7-1.3,1.6-2.3,2.8-2.9c1.2-0.7,2.7-1.1,4.3-1.1c1.4,0,2.7,0.3,3.8,0.8s2.1,1.4,2.8,2.3c0.6,0.8,0.9,1.8,1,2.8h-3.8c-0.2-0.6-0.6-1.3-1.3-1.8c-0.7-0.6-1.6-0.9-2.5-0.9c-1.2,0-2.3,0.5-3.1,1.4c-0.7,0.8-1.1,2-1.1,3.4c0,1.4,0.4,2.5,1.2,3.4c0.8,0.9,1.9,1.4,3.1,1.4c1,0,1.8-0.3,2.5-0.8c0.6-0.5,1-1,1.2-1.8h3.8c-0.1,1-0.5,2.1-1,2.9c-0.7,1-1.6,1.8-2.7,2.3C146.5,30.2,145.3,30.5,143.8,30.5z"/>
					</g>
				</svg>
				<div class="underlogo">Будущее сегодня</div>
			</div>
		</div>
    </div>
    
	<div class="footer-bottom">
		<div class="wrap">
			<div class="col">&copy; <?=Date('Y')?> Rubytech</div>
			<div class="col"><a href="/obrabotka-personalnykh-dannykh.php">Обработка персональных данных</a></div>
			<div class="col"><a href="/about-cookie-files.php">Сведения о cookies-файлах</a></div>
			<a class="ams" href="https://www.alexeymalina.com" target="_blank">AMS</a>
		</div>
    </div>
    
</footer>