<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if ($arResult['TEXT_TITLE'])
     $APPLICATION->SetPageProperty("title", $arResult['TEXT_TITLE']);
else $APPLICATION->SetPageProperty("title", $arResult['NAME']);
if ($arResult['TEXT_DESCR'])
     $APPLICATION->SetPageProperty("description", $arResult['TEXT_DESCR']);
else $APPLICATION->SetPageProperty("description", "Вакансии компании Rubytech");


echo "\n<script>var jsVacancies = ". json_encode($arResult['VACANCIES']) . "</script>\n";

?>

<section class="banner banner-inner" <?=$arResult["BANNER"]["STYLE"]?>>
    <div class="banner-img">
        <img src="<?=$arResult["BANNER"]["SRC"]?>" alt="bg">
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
                <h2><?=$arResult['HEADER2']?></h2>
                <a href="mailto:<?=$arResult['EMAIL']?>" class="btn grey">Отправить резюме</a>
            </div>
            <div class="half">
                <?=$arResult['TEXT']?>
            </div>
        </div>
    </div>
</section>

<section class="list-block vacancies bgwhite">
    <div class="wrap">
        <div class="filters flex">
            <div class="filter bordered">
                <div class="current">Все вакансии</div>
                <ul class="select">
                    <li class="option selected" data-value="">Все вакансии</li>
                    <? foreach ($arResult["RUBRICS"] as $rubric) { ?>
                        <li class="option" data-value="<?=$rubric['CODE']?>"><?=$rubric['NAME']?></li>
                    <? } ?>
                </ul>
            </div>
            <div class="search bordered">
                <form>
                    <input class="search-text" placeholder="Поиск вакансии" name="q">
                    <button type="submit"></button>
                </form>
            </div>
        </div>

        <? if($arResult['QUERY']) {?>
			<p class="search-msg">По запросу "<?=$arResult['QUERY']?>" <?=((count($arResult["VACANCIES"]) > 0)? "найдено: " : "ничего не найдено ")?> 
			<a class="reset-btn" href="/career/" title="Сбросить фильтр">✖</a></p>
        <?}?>

        <div class="items-list">

            <? $i=0; ?>    
            <? foreach ($arResult['VACANCIES'] as $sec) { ?>
                <div class="<?=$sec['CODE']?>">
				    <h2><span><?=$sec['NAME']?></span><span class="counts"><?=$sec['ELEMENT_CNT']?></span></h2>
                
                    <div class="list<?=($i==0? ' opened': '')?>">
                    <?  $i++; 
                        $last = count($sec['CHILDS']);
                    ?>
                    <? foreach ($sec['CHILDS'] as $k => $el) { ?>
                        <? if ($k%2 == 0) { ?>
						    <div class="flex">
                        <?}?>
                            <div class="half">
                                <div class="bordered vacancy-card">
                                    <div class="flex column">
                                        <a href="<?=$sec['CODE']?>/<?=$el['CODE']?>/" class="title bigtext Semibold dark"><?=$el['NAME']?></a>
                                        <div><?=$el['DEPT']?></div>
                                        <div class="anons"><?=$el['ANONS']?></div>
                                        <div class="descr"><?=$el['DESCR']?></div>
                                    </div>
                                    <div class="opener">
                                        <a class="arrowlink next" href="<?=$sec['CODE']?>/<?=$el['CODE']?>/"></a>
                                    </div>
                                </div>
                            </div>
                        <? if (($k%2 == 1) || ($k+1 == $last)) { ?>
                            </div>
                        <?}?>
                    <?}?>
                    </div>
                </div>
            <?}?>
        </div>
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
                <? $APPLICATION->IncludeFile(SITE_DIR."include/feedback.php", Array("template"=>"feedback-vacancy", "formid"=>"3", "folder"=>"/career/"), Array("MODE"=>"php"));?>
            </div>
        </div>
	</section>

<? } ?>