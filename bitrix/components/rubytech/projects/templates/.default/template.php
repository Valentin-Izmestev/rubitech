<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?
$pages = ceil($arResult['ALL_COUNT'] / $arResult['PAGE_COUNT']);
$page = ($_GET['page']? $_GET['page'] : 1);
// if(($page < 1) || ($page > $pages)) {
//     LocalRedirect('/404.php');
// }
?>

<?
if ($arResult['TEXT_TITLE'])
	 $APPLICATION->SetPageProperty("title", $arResult['TEXT_TITLE']);
else $APPLICATION->SetPageProperty("title", $arResult['NAME']);
if ($arResult['TEXT_DESCR'])
	 $APPLICATION->SetPageProperty("description", $arResult['TEXT_DESCR']);
else $APPLICATION->SetPageProperty("description", $arResult['NAME']);
?>

<section class="banner banner-inner" <?=$arResult["BANNER"]["STYLE"]?>>
	<div class="banner-img">
		<img src="<?=$arResult["BANNER"]["SRC"]?>" alt="Проектный опыт">
	</div>
	<div class="banner-intro">
		<div class="wrap">
			<div class="title">
				<h1 class="<?=$arResult['H1COLOR']?>"><?=$arResult['HEADER1']?></h1>
			</div>
		</div>
	</div>
</section>

<section class="projects list-block bgwhite">
	<div class="wrap">

		<div class="newslist">
			<div class="top-news flex">
				<? foreach ($arResult["PROJECTS"] as $key => $project) { ?>
					<? if($key < 2) { ?>
						<? if($project['ISPUBLISHED'] == 'yes') { ?>
							<a href="<?=$project['CODE']?>/" class="half card flex column">
						<? } else { ?>
							<div class="half card flex column">
						<? } ?>
							<div class="img">
								<img src="<?=$project['ANONSIMG']?>" alt="<?=$project['NAME']?>">
							</div>
							<div class="anonce flex column">
								<div class="title Semibold"><span><?=$project['NAME']?></span></div>
								<div class="descr"><?=$project['DESCR']?></div>
							</div>
						<? if($project['ISPUBLISHED'] == 'yes') { ?>
							</a>
						<? } else { ?>
							</div>
						<? } ?>
				<? }} ?>
			</div>

			<? if(count($arResult["PROJECTS"]) > 2) { ?>
			<div class="flex threecol">
				<? foreach ($arResult["PROJECTS"] as $key => $project) { ?>
					<? if($key > 1) { ?>
						<? if($project['ISPUBLISHED'] == 'yes') { ?>
						<a href="<?=$project['CODE']?>/" class="card flex column">
						<? } else { ?>
						<div class="card flex column">
						<? } ?>
							<div class="img">
								<img src="<?=$project['ANONSIMG']?>" alt="<?=$project['NAME']?>">
							</div>
							<div class="anonce flex column">
								<div class="title Semibold"><span><?=$project['NAME']?></span></div>
								<div class="descr"><?=$project['DESCR']?></div>
							</div>
						<? if($project['ISPUBLISHED'] == 'yes') { ?>
							</a>
						<? } else { ?>
							</div>
						<? } ?>
				<? }} ?>
			</div>
			<? } ?>
		</div>

		
		<? if($arResult['ALL_COUNT'] > $arResult['PAGE_COUNT']) {?>
			<div class="paginator">
				<? if($page - 1 < 1) { ?>
					<span class="arrowlink prev disabled"></span>
				<?} else {?>
					<a class="arrowlink prev" href="?page=<?=$page-1?>"></a>
				<?}?>
				<div class="page"><?=$page?> из <?=$pages?></div>
				<? if($page + 1 > $pages) {?>
					<span class="arrowlink next disabled"></span>
				<?} else {?>
					<a class="arrowlink next" href="?page=<?=$page+1?>"></a>
				<?}?>
			</div>
		<?}?>

	</div>
</section>


<? if ($arResult['SHOWFORM']=='true') { ?>
	<section class="feedback background2">
		<div class="wrap flex feedback-full">
			<div>
				<h3>Обратная связь</h3>
				<p>Пожалуйста, заполните форму обратной связи. Наши специалисты
					рассмотрят ваш&nbsp;запрос и обязательно вам ответят.</p>
			</div>
			<div class="form">
				<? $APPLICATION->IncludeFile("/include/feedback.php", Array("template"=>"feedback-short", "formid"=>"4", "folder"=>"/projects/"), Array("MODE"=>"php"));?>
			</div>
		</div>
	</section>
<? } ?>