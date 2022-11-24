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

$jsNews = json_encode($arResult['NEWS']);
echo "\n<script>var jsNews = ". $jsNews . "</script>\n";
?>

<section class="banner banner-inner" <?=$arResult["BANNER"]["STYLE"]?>>
	<div class="banner-img">
		<img src="<?=$arResult["BANNER"]["SRC"]?>" alt="Пресс-центр">
	</div>
	<div class="banner-intro">
		<div class="wrap">
			<div class="title">
				<h1 class="white"><?=$arResult['HEADER1']?></h1>
			</div>
		</div>
	</div>
</section>

<section class="list-block bgwhite">
	<div class="wrap">
		<div class="filters flex">
			<div class="filter bordered">
				<div class="current">Все публикации</div>
				<ul class="select">
					<li class="option" data-value="">Все публикации</li>
					<? foreach ($arResult["RUBRICS"] as $rubric) { ?>
						<li class="option" data-value="<?=$rubric['CODE']?>"><?=$rubric['NAME']?></li>
					<? } ?>
				</ul>
			</div>
			<div class="search bordered">
				<form>
					<input class="search-text" placeholder="Поиск публикации" name="q">
					<button type="submit"></button>
				</form>
			</div>
		</div>

		<h2>Актуальные материалы</h2>
		<? if($arResult['QUERY']) {?>
			<p class="search-msg">По запросу "<?=$arResult['QUERY']?>" <?=((count($arResult["NEWS"]) > 0)? "найдено: " : "ничего не найдено ")?> 
			<a class="reset-btn" href="/press-center/" title="Сбросить фильтр">✖</a></p>
		<? } ?>

		<div class="newslist">
			<div class="top-news flex">
				<? foreach ($arResult["NEWS"] as $key => $news) { ?>
					<? if($key < 2) { ?>
						<a href="<?=$news['CODE']?>/" class="half card flex column">
							<div class="img">
								<img src="<?=$news['ANONSIMG']?>" alt="<?=$news['NAME']?>">
							</div>
							<div class="anonce flex column">
								<div class="type Semibold"><?=$news['RUBRICNAME']?></div>
								<div class="title Semibold"><span><?=$news['NAME']?></span></div>
								<div class="date"><?=$news['DATE']?></div>
							</div>
						</a>
					<? } ?>
				<? } ?>
			</div>

			<? if(count($arResult["NEWS"])>2) { ?>
			<div class="flex threecol">
				<? foreach ($arResult["NEWS"] as $key => $news) { ?>
					<? if($key > 1) { ?>
						<a href="<?=$news['CODE']?>/" class="card flex column">
							<div class="img">
								<img src="<?=$news['ANONSIMG']?>" alt="<?=$news['NAME']?>">
							</div>
							<div class="anonce flex column">
								<div class="type Semibold"><?=$news['RUBRICNAME']?></div>
								<div class="title Semibold"><span><?=$news['NAME']?></span></div>
								<div class="date"><?=$news['DATE']?></div>
							</div>
						</a>
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
				<? $APPLICATION->IncludeFile("/include/feedback.php", Array("template"=>"feedback-short", "formid"=>"4", "folder"=>"/press-center/"), Array("MODE"=>"php"));?>
			</div>
		</div>
	</section>
<? } ?>