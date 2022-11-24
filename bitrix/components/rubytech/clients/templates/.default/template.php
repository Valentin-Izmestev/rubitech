<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<div class="clients">
    <div class="flex">
        <? foreach ($arResult["CLIENTS"] as $client) { ?>
			<div>
                <img src="<?=$client['IMG']?>" alt="<?=$client['NAME']?>" <?=($client["LOGOB"]? 'style="margin-bottom:'.$client["LOGOB"].'px"':'')?> width="<?=$client["LOGOW"]?>" height="<?=$client["LOGOH"]?>">
            </div>
        <? } ?>
    </div>
</div>