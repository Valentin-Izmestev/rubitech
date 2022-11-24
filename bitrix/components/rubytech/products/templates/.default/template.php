<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult['TEXT_TITLE'])
     $APPLICATION->SetPageProperty("title", $arResult['TEXT_TITLE']);
else $APPLICATION->SetPageProperty("title", $arResult['NAME']);
if ($arResult['TEXT_DESCR'])
     $APPLICATION->SetPageProperty("description", $arResult['TEXT_DESCR']);
else $APPLICATION->SetPageProperty("description", "Rubytech — системный интегратор, IT-инфраструктура, поддержка IT систем");
?>
	<section class="banner banner-inner" <?=$arResult["BANNER"]["STYLE"]?>>
		<div class="banner-img">
            <img src="<?=$arResult["BANNER"]["SRC"]?>" alt="Наши продукты">
		</div>
		<div class="banner-intro">
			<div class="wrap">
				<div class="title">
					<h1 class="<?=$arResult['H1COLOR']?>"><?=$arResult['HEADER1']?></h1>
				</div>
			</div>
		</div>
	</section>

	<section class="content bgwhite">
		<div class="wrap">
			<? foreach ($arResult['PRODUCTS'] as $sec) { ?>
				<h2><?=$sec['NAME']?><span class="counts"><?=$sec['ELEMENT_CNT']?></span></h2>
				<div class="flex">
					<div class="columns-2">
						<? foreach ($sec['CHILDS'] as $el) { ?>
							<div class="bordered">
								<? if (count($el['CHILDS']) > 0) { ?>
									<div class="title Semibold"><?=$el['NAME']?></div>
								<?} else {?>
									<a href="<?=$sec['CODE']?>/<?=$el['CODE']?>/" class="title Semibold"><?=$el['NAME']?></a>
								<?}?>
								<? foreach ($el['CHILDS'] as $el2) { ?>
									<p><a href="<?=$sec['CODE']?>/<?=$el['CODE']?>/<?=$el2['CODE']?>/" class="linkblock"><?=$el2['NAME']?></a></p>	
								<?}?>
							</div>
						<?}?>
					</div>
				</div>
			<?}?>
		</div>
	</section>

<? foreach ($arResult['EXTRA'] as $extra) { ?>
	<section class="extra">
		<div class="wrap">
			<img class="backimg" src="<?=$extra["BACKIMG"]?>" alt="bg">
			<div class="flex">
				<div class="half">
					<h2 class="Medium"><?=$extra['NAME']?></h2>
					<div>
						<p><?=$extra['ANONS']?></p>
						<p>Узнайте больше на сайте:<br>
						<a href="<?=$extra['LINK']?>" class="<?=$extra['MAINCOLOR']?>-underlined"><?=$extra['LINK']?></a></p>
					</div>
					<div class="bottom"><img src="<?=$extra['LOGO']?>" alt="<?=$extra['NAME']?>"></div>
				</div>
				<div class="half">
					<p class="color-title <?=$extra['MAINCOLOR']?>">Продукты <?=$extra['NAME']?></p>
					<div>
						<?=$extra['TEXT']?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?}?>


<? if ($arResult['SHOWFORM']=='true') { ?>
	<section class="feedback">
		<div class="wrap">
			<div class="form">
				<h3>Запросить контакты</h3>
				<p>Пожалуйста, заполните форму. Наши специалисты 
				рассмотрят ваш запрос и проконсультируют вас.</p>
				<? $APPLICATION->IncludeFile("/include/feedback.php", Array("template"=>"feedback-short", "formid"=>"4", "folder"=>"/products/"), Array("MODE"=>"php"));?>
			</div>
		</div>
	</section>
<? } ?>