<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
if ($arResult['TEXT_TITLE'])
     $APPLICATION->SetPageProperty("title", $arResult['TEXT_TITLE']);
else $APPLICATION->SetPageProperty("title", $arResult['NAME']);
if ($arResult['TEXT_DESCR'])
     $APPLICATION->SetPageProperty("description", $arResult['TEXT_DESCR']);
else $APPLICATION->SetPageProperty("description", $arResult['ANONCE']);
?>

<section class="article nobanner">
	<div class="wrap flex bgwhite rounded">

		<aside class="flex column">
			<div class="breadcrumbs"><a href="/projects/">Все проекты</a></div>
			<div class="concern">
				<? if ($arResult["EXPERTLINKS"]) {?>
				<div>Экспертное решение</div>
					<? foreach ($arResult["EXPERTLINKS"] as $key => $link) { ?>
						<a class="Semibold" href="<?=$link["code"]?>" target="_blank"><span><?=$link["name"]?></span></a>
					<? } ?>
				<? } ?>
			</div>
			<div class="share">
				<script src="https://yastatic.net/share2/share.js"></script>
				<div>Поделиться</div>
				<div class="flex">
					<div class="ya-share2" data-curtain data-color-scheme="whiteblack" data-services="facebook,twitter" data-copy="extraItem"></div>
					<a class="em" href="mailto:?subject=<?=$arResult['NAME']?>" title="E-mail"></a>
				</div> 
			</div>
		</aside>
		
		<article class="news">
			<h1><?=$arResult['NAME']?></h1>
			
			<?=$arResult["TEXT"]?>

			<div class="last"></div>
		</article>
	</div>
</section>


<? if ($arResult['SHOWFORM']=='true') { ?>
	<section class="feedback feedback-personal">
        <div class="wrap">
            <div class="flex">
                <div class="person">
                    <img src="<?=$arResult["AVATAR"]?>" alt="person">
                    <div>
                        <div class="name"><?=$arResult['FIO']?></div>
                        <div class="job"><?=$arResult['JOB']?></div>
                    </div>
                </div>
                <div class="form">
                    <h3>Запросить контакты</h3>
                    <p>Пожалуйста, заполните форму. Наши специалисты 
                    рассмотрят ваш запрос и проконсультируют вас.</p>
                    <? $APPLICATION->IncludeFile("/include/feedback.php", Array("template"=>"feedback-short", "formid"=>"4", "folder"=>"/projects/"), Array("MODE"=>"php"));?>
                </div>
            </div>
        </div>
    </section>
<? } ?>
