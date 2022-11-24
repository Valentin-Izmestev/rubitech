<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if ($arResult['TEXT_TITLE'])
     $APPLICATION->SetPageProperty("title", $arResult['TEXT_TITLE']);
else $APPLICATION->SetPageProperty("title", $arResult['NAME']);
if ($arResult['TEXT_DESCR'])
     $APPLICATION->SetPageProperty("description", $arResult['TEXT_DESCR']);
else $APPLICATION->SetPageProperty("description", $arResult['BIGTEXT']);
?>
	<section class="banner banner-inner" <?=$arResult["BANNER"]["STYLE"]?>>
		<div class="banner-img">
			<img src="<?=$arResult["BANNER"]["SRC"]?>" alt="о компании">
		</div>
		<div class="banner-intro">
			<div class="wrap">
				<div class="title">
					<div></div>
				</div>
			</div>
		</div>
	</section>

	<section class="content bgwhite">
		<div class="wrap">
            <div class="intro flex">
                <div class="half">
                    <div class="rubric-name">О компании</div>
                    <h1><?=$arResult['BIGTEXT']?></h1>
                </div>
                <div class="half">
                    <?=$arResult['TEXT'] ?>
                </div>
            </div>
		</div>
	</section>

    <section class="steps">
        <div class="wrap">
            <div class="grid">
                <img class="img" src="<?=$arResult['IMG_PROD']?>" alt="Наши продукты">
                <div class="step-about">
                    <h3 class="Semibold">Наши продукты</h3>
                    <div>
                        <?=$arResult['TEXT_PROD']?>
                        <a class="link Semibold" href="/products/">Все продукты</a>
                    </div>
                </div>
                <img class="img" src="<?=$arResult['IMG_EXPERT']?>" alt="Наша экспертиза">
                <div class="step-about">
                    <h3 class="Semibold">Наша экспертиза</h3>
                    <div>
                        <?=$arResult['TEXT_EXPERT']?>
                        <a class="link Semibold" href="/directions/">Узнать больше</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-clients">
        <div class="center narrow">
            <div class="rubric-name">Наши заказчики</div>
            <h2><?=$arResult['TEXT_CLIENTS']?></h2>
        </div>
        <?$APPLICATION->IncludeComponent("rubytech:clients", "", array(), false);?>
    </section>

    <!-- <section class="cases">
        <div class="wrap">
            <div class="rubric-name center">Кейсы</div>
            <div class="flex threecol caselist">
                <? foreach ($arResult['CASES'] as $case) { ?>
                    <div class="flex column">
                        <a href="<?=$case['LINK']?>"><img src="<?=$case["IMG"]?>" alt="<?=$case['NAME']?>"></a>
                        <a href="<?=$case['LINK']?>" class="title"><?=$case['NAME']?></a>
                        <?=$case['COMPANY']?>
                    </div>
                <? } ?>
            </div>
        </div>
    </section> -->

    <section class="team bgwhite">
        <div class="wrap">
            <div class="center">
                <div class="rubric-name">Команда</div>
                <h2><?=$arResult['TEAM_BIGTEXT']?></h2>
            </div>
            <img src="<?=$arResult["TEAM_IMG"]?>" alt="<?=$arResult["TEAM_IMG_DESC"]?>">
            <div class="text">
                <?=$arResult['TEAM_TEXT']?>
            </div>
            <? if($arResult['TEAM_QUOTE']) { ?>
            <blockquote><?=$arResult['TEAM_QUOTE']?></blockquote>
            <? } ?>
        </div>
    </section>
