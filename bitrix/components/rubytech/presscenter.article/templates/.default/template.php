<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
if ($arResult['TEXT_TITLE'])
     $APPLICATION->SetPageProperty("title", $arResult['TEXT_TITLE']);
else $APPLICATION->SetPageProperty("title", $arResult['NAME']);
if ($arResult['TEXT_DESCR'])
     $APPLICATION->SetPageProperty("description", $arResult['TEXT_DESCR']);
else $APPLICATION->SetPageProperty("description", $arResult['BIGTEXT']);
?>

<section class="article nobanner">
<div class="wrap flex bgwhite rounded">

    <aside class="flex column">
        <div class="breadcrumbs"><a href="/press-center/">Все публикации</a></div>
        <div class="source">
            <? if ($arResult["SOURCELINK"]) {?>
            <div>Источник</div>
            <a class="Semibold bordered" href="<?=$arResult["SOURCELINK"]?>" target="_blank"><?=($arResult["SOURCENAME"]? $arResult["SOURCENAME"] : "Ссылка на сайт")?></a>
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
        <div class="name"><?=$arResult['RUBRICNAME']?>&nbsp;&nbsp;|&nbsp;&nbsp;<?=$arResult['DATE']?></div>
        <h1><?=$arResult['NAME']?></h1>
        <? if($arResult["TOPIMG"]) { ?>
        <img src="<?=$arResult["TOPIMG"]?>" alt="<?=$arResult['NAME']?>">
        <? } ?>
        <p class="bigtext"><?=$arResult['BIGTEXT']?></p>

        <?=$arResult["TEXT"]?>

        <? if($arResult["VIDEOLINK"]) { ?>
        <iframe type="text/html" width="100%" height="417" src="<?=$arResult["VIDEOLINK"]?>" frameborder="0" rel="0"></iframe>
        <? } ?>

        <div class="summary">
            <? if($arResult['BIGTEXT']) {?>
            <p class="bigtext"><?=$arResult['BIGTEXT']?></p>
            <? } ?>
            <? if($arResult['AUTHOR']) {?>
            <p class="author"><?=$arResult['AUTHOR']?></p>
            <? } ?>
            <? if($arResult['AUTHORJOB']) {?>
            <p class="job"><?=$arResult['AUTHORJOB']?></p>
            <? } ?>
        </div>
                
    </article>
</div>
</section>

<? if($arResult['SECTIONSHOW']=='true') {?>
<section class="contact-us">
<div class="wrap bgwhite">
    <div class="topline">
        <div>
            <div class="Semibold"><?=$arResult['DEPARTMENT']?></div>
            <div><?=$arResult['PERSONNAME']?></div>
            <a href="mailto:<?=$arResult['PERSONEMAIL']?>"><?=$arResult['PERSONEMAIL']?></a><br>
            <a href="tel:+<?=preg_replace('~[^0-9]+~', '', $arResult['PERSONPHONE'])?>"><?=$arResult['PERSONPHONE']?></a>
        </div>
    </div>
</div>
</section>
<?}?>

<? if($arResult["MORE"]) { ?>
<section class="related">
<div class="wrap">
    <h3>Другие материалы</h3>
    <div class="flex threecol">
        <? foreach ($arResult["MORE"] as $article) {?>
            <a href="../<?=$article['LINK']?>/" class="card flex column">
                <div class="img">
                    <img src="<?=$article['IMG_PREVIEW']?>" alt="<?=$article['RUBRICNAME']?>">
                </div>
                <div class="anonce flex column">
                    <div class="type Semibold"><?=$article['RUBRICNAME']?></div>
                    <div class="title Semibold"><span><?=$article['NAME']?></span></div>
                    <div class="date"><?=$article['DATE']?></div>
                </div>
            </a>
        <?}?>
    </div>
</div>
</section>
<?}?>