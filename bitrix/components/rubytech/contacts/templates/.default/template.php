<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?
if ($arResult['TEXT_TITLE'])
     $APPLICATION->SetPageProperty("title", $arResult['TEXT_TITLE']);
else $APPLICATION->SetPageProperty("title", $arResult['NAME']);
if ($arResult['TEXT_DESCR'])
     $APPLICATION->SetPageProperty("description", $arResult['TEXT_DESCR']);
else $APPLICATION->SetPageProperty("description", 'Контактная информация - компания Рубитех');
?>

    <section class="banner banner-inner" <?=$arResult["BANNER"]["STYLE"]?>>
		<div class="banner-img">
			<img src="<?=$arResult["BANNER"]["SRC"]?>" alt="Контакты">
		</div>
		<div class="banner-intro">
			<div class="wrap">
				<div class="title">
                    <h1 class="<?=$arResult['H1COLOR']?>">Контакты</h1>
				</div>
			</div>
		</div>
	</section>

	<section class="content bgwhite">
		<div class="wrap">
            <div id="persons" class="flex threecol contacts">
                <div>
                    <a class="Semibold" href="tel:+<?=preg_replace('~[^0-9]+~', '', $arResult['PHONE'])?>"><?=$arResult['PHONE']?></a>
                    <a class="Semibold" href="mailto:<?=$arResult['EMAIL']?>"><?=$arResult['EMAIL']?></a>
                    <div class="address"><?=$arResult['ADDRESS']?></div>
                    <div class="socials">
                    <? if ($arResult['HH']) { ?>
                        <a class="hh" href="<?=$arResult['HH']?>"></a>
                    <? } ?>
                    <? if ($arResult['YT']) { ?>
                        <a class="yt" href="<?=$arResult['YT']?>"></a>
                    <? } ?>
                    </div>
                </div>
                <? foreach ($arResult['PERSON'] as $person) { ?>
                    <div>
                        <div class="bordered">
                            <div class="dept"><?=$person['DEPT']?></div>
                            <div class="name"><?=$person['NAME']?></div>
                            <div class="job"><?=$person['JOB']?></div>
                            <a href="tel:<?=preg_replace('~[^0-9]+~', '', $person['TEL'])?>" class="tel"><?=$person['TEL']?></a>
                            <a href="mailto:<?=$person['MAIL']?>" class="mail"><?=$person['MAIL']?></a>
                        </div>
                    </div>
                <? }?>
            </div>
            <div id="feedback" class="flex feedback-full">
                <div>
                    <h3>Обратная связь</h3>
                    <p>Пожалуйста, заполните форму обратной связи. Наши специалисты
                        рассмотрят ваш&nbsp;запрос и проконсультируют вас.</p>
                </div>
                <div class="form">
                <? $APPLICATION->IncludeFile("/include/feedback.php", Array("template"=>"feedback-full", "formid"=>"2", "folder"=>"/contacts/"), Array("MODE"=>"php"));?>
                </div>
            </div>
		</div>
    </section>

    <section class="bgwhite map">
        <div class="wrap">
            <h3>Схема проезда</h3>
            <div id="YMaps" style="background-image: url('<?=$arResult['MAPIMG']?>')">
            <? //if ($arResult['MAPLINK']) { ?>
                <!-- <script charset="utf-8" async src="<?//=$arResult['MAPLINK']?>"></script> -->
            <? //} ?>
            </div>
            <script src="https://api-maps.yandex.ru/2.1/?apikey=4223ac18-0d4f-44c3-8dff-a53b74da8659&lang=ru"></script>
            <script type="text/javascript">
                var maptext = '<?=preg_replace( "/\r|\n/", "", $arResult["MAPTEXT"])?>',
                    mapcenter = [<?=$arResult['YAMAP']?>]
                // console.log(maptext)
            </script>
            <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH ?>/js/yamap.js"></script>
            <style>
            [class*="ymaps-2"][class*="-ground-pane"] {
                filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale");
                -webkit-filter: grayscale(100%);
            }</style>

        </div>
    </section>
