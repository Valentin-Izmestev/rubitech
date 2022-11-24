<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if ($arResult['TEXT_TITLE'])
	 $APPLICATION->SetPageProperty("title", $arResult['TEXT_TITLE']);
else $APPLICATION->SetPageProperty("title", "Экспертные решения от компании Rubytech");
if ($arResult['TEXT_DESCR'])
	 $APPLICATION->SetPageProperty("description", $arResult['TEXT_DESCR']);
else $APPLICATION->SetPageProperty("description", "Направления экспертных решений компании Rubytech — системного интегратора в области IT систем");

?>
	<section class="banner banner-inner" <?=$arResult["BANNER"]["STYLE"]?>>
		<div class="banner-img">
            <img src="<?=$arResult["BANNER"]["SRC"]?>" alt="Наши направления">
		</div>
		<div class="banner-intro">
			<div class="wrap">
				<div class="title">
					<h1 class="<?=$arResult['H1COLOR']?>"><?=$arResult['HEADER1']?></h1>
				</div>
			</div>
		</div>
	</section>

	<section class="expertise">
		<div class="wrap">

				<? 
				$k = 0;
				foreach ($arResult['SOLUTIONS'] as $sol) { ?>
					<div class="solution <?=($k%2==0? "left" : "right")?>">
						<div class="pic">
							<div <?=$sol['IMG']['STYLE']?>><img src="<?=$sol['IMG']['SRC']?>" alt="пиктограмма"></div>
						</div>
						<div class="text">
							<h2><?=$sol['NAME']?></h2>
							<p><?=$sol['TEXT']?></p>
							<a class="link Semibold" href="/directions/<?=$sol['CODE']?>/">Подробнее</a>
						</div>			
					</div>
					<?$k++;?>
				<?}?>

		</div>
	</section>

	<? if ($arResult['SHOWFORM']=='true') { ?>
	<section class="feedback">
		<div class="wrap">
			<div class="form">
				<h3>Запросить контакты</h3>
				<p>Пожалуйста, заполните форму. Наши специалисты 
				рассмотрят ваш запрос и проконсультируют вас.</p>
				<? $APPLICATION->IncludeFile("/include/feedback.php", Array("template"=>"feedback-short", "formid"=>"4", "folder"=>"/directions/"), Array("MODE"=>"php"));?>
			</div>
		</div>
	</section>
<? } ?>