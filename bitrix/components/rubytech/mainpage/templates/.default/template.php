<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if ($arResult['TEXT_TITLE'])
	 $APPLICATION->SetPageProperty("title", $arResult['TEXT_TITLE']);
else $APPLICATION->SetPageProperty("title", "Rubytech — современный системный интегратор");
if ($arResult['TEXT_DESCR'])
	 $APPLICATION->SetPageProperty("description", $arResult['TEXT_DESCR']);
else $APPLICATION->SetPageProperty("description", "Rubytech — системный интегратор, IT-инфраструктура, поддержка IT систем");

?>
	<section class="banner banner-fromtop" <?=$arResult["BANNER"]["STYLE"]?>>
		<div class="banner-img">
			<picture>
				<source srcset="<?=$arResult["BANNERSMALL"]["src"]?>" media="(max-width: 640px)">
				<source srcset="<?=$arResult["BANNER"]["SRC"]?>">
				<img src="<?=$arResult["BANNER"]["SRC"]?>" alt="bg">
			</picture>
			<img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/triangle.svg" alt=".">
		</div>
		<div class="banner-intro">
			<div class="wrap">
				<div class="title">
					<h1 class="<?=$arResult['H1COLOR']?>"><?=$arResult['HEADER_BIG']?></h1>
					<p class="<?=$arResult['H1COLOR']?>"><?=$arResult['HEADER_SMALL']?></p>
				</div>
			</div>
		</div>
	</section>

	<section class="about">
		<div class="wrap">
			<div class="flex">
				<div class="text">
					<?=$arResult['FIRST_TEXT']?>
				</div>
				<div class="pic">
					<img src="<?=$arResult["FIRST_IMG"]?>" alt="Компания Rubytech">
				</div>
				<div class="block-digits">
					<? foreach ($arResult['DIGITS'] as $d) { ?>
						<div>
							<div class="digit"><?=$d['DIGIT']?></div>
							<div><?=$d['TEXT']?></div>
						</div>
					<?}?>
				</div>
			</div>
		</div>
	</section>

	<section class="romb">
		<img class="svg top" src="<?=SITE_TEMPLATE_PATH?>/img/romb_top.svg" alt=".">
		<div class="romb_inner">
			<div class="wrap">
				<h2><?=$arResult['MAINBLOCK_HEADER']?></h2>
			
				<? 
				$k = 0;
				foreach ($arResult['SOLUTIONS'] as $sol) { ?>
					<div class="solution <?=($k%2==0? "left" : "right")?>">
						<div class="pic">
							<div <?=$sol['IMG']['STYLE']?>><img src="<?=$sol['IMG']['SRC']?>" alt="пиктограмма"></div>
						</div>
						<div class="text">
							<div class="rubric-name">Продукты и решения</div>
							<?=$sol['TEXT']?>
						</div>
						<div class="block-ico">
							<? foreach ($sol['PIC'] as $pic) {?>
								<div>
									<div class="icon"><img src="<?=$pic['IMG']?>" width="24" height="24" alt="ico"></div>
									<?=$pic['TEXT']?>
								</div>
							<?}?>
						</div>			
					</div>
					<?$k++;?>
				<?}?>

			</div>
		</div>
		<img class="svg bottom" src="<?=SITE_TEMPLATE_PATH?>/img/romb_bottom.svg" alt=".">
	</section>

	<section class="digital">
		<div class="bgpic">
			<div class="left"></div>
			<div class="right"></div>
		</div>
		<div class="wrap">
			<div class="narrow">
				<?=$arResult['UNDERMAIN_TEXT']?>
				<div class="running">
					<? foreach ($arResult['RUNNING_DIGITS'] as $digit) { ?><span><?=$digit?></span><?}?>
				</div>
				<div class="running-desc"><?=$arResult['RUNNING_DIGITS_DESC']?></div>
			</div>
		</div>
		<?$APPLICATION->IncludeComponent("rubytech:clients", "", array(), false);?>
	</section>

	<section class="humanres">
		<div class="wrap">
			<div class="flex">
				<div class="text">
					<?=$arResult['FORM_TEXT_LEFT']?>
				</div>
				<div class="form">
					<h3>Обратная связь</h3>
					<p>Пожалуйста, заполните форму. Наши специалисты рассмотрят ваш запрос и проконсультируют вас.</p>
					<? $APPLICATION->IncludeFile("/include/feedback.php", Array("template"=>"feedback-main", "formid"=>"4", "folder"=>"/"), Array("MODE"=>"php"));?>
				</div>
			</div>
		</div>
	</section>
