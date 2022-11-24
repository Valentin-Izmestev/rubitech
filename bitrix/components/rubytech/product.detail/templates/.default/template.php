<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
if ($arResult['TEXT_TITLE'])
     $APPLICATION->SetPageProperty("title", $arResult['TEXT_TITLE']);
else $APPLICATION->SetPageProperty("title", $arResult['NAME']);
if ($arResult['TEXT_DESCR'])
     $APPLICATION->SetPageProperty("description", $arResult['TEXT_DESCR']);
else $APPLICATION->SetPageProperty("description", $arResult['BIGTEXT']);
?>
<section class="banner banner-inner banner-narrow" <?=$arResult["BANNER"]["STYLE"]?>>
		<div class="banner-img">
			<img src="<?=$arResult["BANNER"]["SRC"]?>" alt="<?=$arResult['NAME']?>">
		</div>
		<div class="banner-intro">
			<div class="wrap">
				<div class="title variant36">
                    <div class="<?=$arResult['H1COLOR']?>"><?=$arResult['NAVCHAIN'][0]?></div>
                    <? if (count($arResult['NAVCHAIN'])==2) { ?>
                        <p class="<?=$arResult['H1COLOR']?>"><?=$arResult['NAVCHAIN'][1]?></p>
                    <? } ?>
				</div>
			</div>
		</div>
	</section>

    <section class="article">
		<div class="wrap flex bgwhite rounded">

            <aside class="flex column">
                <div class="breadcrumbs"><a href="/products/">Все продукты</a></div>
                <div class="leftnav">
                    <? foreach ($arResult['NAVBLOCK'] as $k => $nav) { ?>
                        <a href="#<?=($k<9 ? '0'.($k+1) : $k+1)?>"><?=$nav['name']?></a>
                    <? } ?>
                </div>
                <div class="consult">Консультация эксперта</div>
                <a class="tel" href="tel:+<?=preg_replace('~[^0-9]+~', '', $arResult['PHONE'])?>"><?=$arResult['PHONE']?></a>
                <a class="btn" href="mailto:<?=$arResult['EMAIL']?>">Отправить заявку</a>
            </aside>
            
            <article>
                <div class="name">Наши продукты</div>
                <h1><?=$arResult['NAME']?></h1>
                <p class="bigtext"><?=$arResult['BIGTEXT']?></p>
                <p><?=$arResult['TEXT']?></p>
                
                <? foreach ($arResult['NAVBLOCK'] as $k => $nav) { ?>
                    <h2 id="<?=($k<9 ? '0'.($k+1) : $k+1)?>"><?=$nav['name']?></h2>
                    <?=$nav['text']?>
                <? } ?>
                        
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
                    <? $APPLICATION->IncludeFile("/include/feedback.php", Array("template"=>"feedback-short", "formid"=>"4", "folder"=>"/products/"), Array("MODE"=>"php"));?>
                </div>
            </div>
        </div>
    </section>
<? } ?>
