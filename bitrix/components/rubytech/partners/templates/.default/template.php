<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult['TEXT_TITLE'])
     $APPLICATION->SetPageProperty("title", $arResult['TEXT_TITLE']);
else $APPLICATION->SetPageProperty("title", $arResult['NAME']);
if ($arResult['TEXT_DESCR'])
     $APPLICATION->SetPageProperty("description", $arResult['TEXT_DESCR']);
else $APPLICATION->SetPageProperty("description", $arResult['BIGTEXT']);

$jsPartners = json_encode($arResult['PARTNERS']);
echo "\n<script>var jsPartners = ". $jsPartners . "</script>\n";
?>

    <section class="banner banner-inner" <?=$arResult["BANNER"]["STYLE"]?>>
		<div class="banner-img">
            <img src="<?=$arResult["BANNER"]["SRC"]?>" alt="Наши партнеры">
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
            <div class="intro flex">
                <div class="half">
                    <div class="bigtext"><?=$arResult['BIGTEXT']?></div>
                    <a class="btn grey" href="mailto:<?=$arResult['EMAIL']?>?subject=Стать партнером Rubytech">Стать партнером</a>
                </div>
                <div class="half">
                    <?=$arResult['TEXT']?>
                </div>
            </div>
        </div>
    </section>

    <section class="partners">
        <div class="wrap">
            <div class="filter">
                <div class="current bordered">Партнеры</div>
                <ul class="select">
                    <li class="option" data-value="CODE">По алфавиту</li>
                    <li class="option" data-value="STATUS">По статусу</li>
                </ul>
            </div>
            <div class="flex">
                <? foreach ($arResult['PARTNERS'] as $partner) { ?>
                    <div class="partner">
                        <div><img src="<?=$partner['LOGO']?>" alt="<?=$partner['NAME']?>"></div>
                        <div>
                            <? if($partner['LINK']) { ?>
                            <a href="<?=$partner['LINK']?>" class="name"><?=$partner['NAME']?></a>
                            <? } else { ?>
                            <div class="name"><?=$partner['NAME']?></div>
                            <? } ?>
                            <div class="status"><?=$partner['STATUS']?></div>
                        </div>
                    </div>                   
                <? }?>
            </div>
        </div>
    </section>
    

<? if ($arResult['SHOWFORM']=='true') { ?>
	<section class="feedback">
		<div class="wrap">
			<div class="form">
				<h3>Запросить контакты</h3>
				<p>Пожалуйста, заполните форму. Наши специалисты 
				рассмотрят ваш запрос и проконсультируют вас.</p>
				<? $APPLICATION->IncludeFile("/include/feedback.php", Array("template"=>"feedback-short", "formid"=>"4", "folder"=>"/partners/"), Array("MODE"=>"php"));?>
			</div>
		</div>
	</section>
<? } ?>