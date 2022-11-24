<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)){ ?>
	<?
	$previousLevel = 0;
	foreach($arResult as $arItem) {?>
		<? 	if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
				str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
			}
		?>
		<?if ($arItem["IS_PARENT"]) {?>
			<?if ($arItem["DEPTH_LEVEL"] == 1) {?>
		<a href="<?=$arItem["LINK"]?>" 
			class="<?=($arItem["SELECTED"] ? 'root-item-selected' : 'root-item')?>"><?=$arItem["TEXT"]?></a>
				<ul>
			<?}else{?>
					<a href="<?=$arItem["LINK"]?>" class="parent<?=($arItem["SELECTED"]? ' item-selected': '')?>"><?=$arItem["TEXT"]?></a>
					<ul>
			<?}?>
		<?} else {?>
			<?if ($arItem["PERMISSION"] > "D") {?>
				<?if ($arItem["DEPTH_LEVEL"] == 1) {?>
					<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a><br>
				<?} else {?>
					<a href="<?=$arItem["LINK"]?>"<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><?=$arItem["TEXT"]?></a><br>
				<?}?>
			<? } else { ?>
				<?if ($arItem["DEPTH_LEVEL"] == 1) {?>
					<a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a><br>
				<?} else {?>
					<a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a><br>
				<?}?>
			<?}?>
		<?}?>
		<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
	<?}?>
	<?if ($previousLevel > 1) //close last item tags
		str_repeat("</ul></li>", ($previousLevel-1) );
	?>
<? } ?>
