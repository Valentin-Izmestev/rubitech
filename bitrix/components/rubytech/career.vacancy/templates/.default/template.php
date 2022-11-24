<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if ($arResult['TEXT_TITLE'])
     $APPLICATION->SetPageProperty("title", $arResult['TEXT_TITLE']);
else $APPLICATION->SetPageProperty("title", $arResult['NAME']);
if ($arResult['TEXT_DESCR'])
     $APPLICATION->SetPageProperty("description", $arResult['TEXT_DESCR']);
else $APPLICATION->SetPageProperty("description", $arResult['NAME']);
?>

<section class="article nobanner">
    <div class="wrap flex bgwhite rounded">

        <aside class="flex column">
            <div class="breadcrumbs"><a href="/career/">Все вакансии</a></div>
            <div class="leftnav">
                <a href="#01">Ваши задачи</a>
                <a href="#02">Наши ожидания</a>
                <a href="#03">Мы предлагаем</a>
            </div>
            <a class="btn btn-transparent" href="<?=($arResult["HHLINK"]? $arResult["HHLINK"] : $arResult['HHDEFAULT'])?>" target="_blank">Вакансия на hh</a>
            <a class="btn" href="mailto:<?=$arResult['EMAIL']?>">Отправить резюме</a>
        </aside>
        
        <article>
            <div class="name"><?=$arResult["DEPT"]?></div>
            <h1><?=$arResult['NAME']?></h1>
            <div class="bigtext"><?=$arResult["DESCR"]?></div>
            <h2 id="01">Ваши задачи</h2>
            <?=$arResult["TASKS"]?>
            <h2 id="02">Наши ожидания</h2>
            <?=$arResult["SKILLS"]?>
            <h2 id="03">Мы предлагаем</h2>
            <?=$arResult["BENEFITS"]?>
        </article>
    </div>
</section>	

<? if ($arResult['SHOWFORM']=='true') { ?>
	<section class="wrap feedback background3">
		<div class="flex feedback-full">
			<div>
				<h3>Обратная связь</h3>
				<p>Пожалуйста, заполните форму обратной связи. Наши специалисты
					рассмотрят ваш&nbsp;запрос и свяжутся с&nbsp;вами.</p>
            </div>
            <div class="form">
                <? $APPLICATION->IncludeFile(SITE_DIR."include/feedback.php", Array("template"=>"feedback-vacancy", "formid"=>"3", "folder"=>"/career/"), Array("MODE"=>"php"));?>
            </div>
        </div>
	</section>

<? } ?>