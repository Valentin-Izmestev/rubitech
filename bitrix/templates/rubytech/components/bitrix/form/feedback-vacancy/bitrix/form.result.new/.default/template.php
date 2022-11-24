<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> <?
// reading errors
	if (is_array($arResult["FORM_ERRORS"]) && array_key_exists("NAME", $arResult['FORM_ERRORS'])) { 
		$erNAME = htmlspecialcharsbx($arResult["FORM_ERRORS"]["NAME"]);
	}
	if (is_array($arResult["FORM_ERRORS"]) && array_key_exists("COMPANY", $arResult['FORM_ERRORS'])) {
		$erCOMPANY = htmlspecialcharsbx($arResult["FORM_ERRORS"]["COMPANY"]);
	}
	if (is_array($arResult["FORM_ERRORS"]) && array_key_exists("PHONE", $arResult['FORM_ERRORS'])) {
		$erPHONE = htmlspecialcharsbx($arResult["FORM_ERRORS"]["PHONE"]);
	}
	if (is_array($arResult["FORM_ERRORS"]) && array_key_exists("EMAIL", $arResult['FORM_ERRORS'])) {
		$erEMAIL = htmlspecialcharsbx($arResult["FORM_ERRORS"]["EMAIL"]);
	}
	if (is_array($arResult["FORM_ERRORS"]) && array_key_exists("CVFILE", $arResult['FORM_ERRORS'])) {
		$erCVFILE = htmlspecialcharsbx($arResult["FORM_ERRORS"]["CVFILE"]);
	}
	if (is_array($arResult["FORM_ERRORS"]) && array_key_exists("MESSAGETEXT", $arResult['FORM_ERRORS'])) {
		$erMESTEXT = htmlspecialcharsbx($arResult["FORM_ERRORS"]["MESSAGETEXT"]);
	}
	if (is_array($arResult["FORM_ERRORS"]) && array_key_exists("agree", $arResult['FORM_ERRORS'])) { 
		$eragree = htmlspecialcharsbx($arResult["FORM_ERRORS"]["agree"]);
	}
?> <?=$arResult["FORM_HEADER"]?>
<div class="flex pdata">
	 <?=substr_replace($arResult["QUESTIONS"]["NAME"]["HTML_CODE"], 		($erNAME? 	  ' title="'.$erNAME.'"' 	 : '').' placeholder="Имя и Фамилия*"', 	-1, 0)?> <?=substr_replace($arResult["QUESTIONS"]["COMPANY"]["HTML_CODE"], 	($erCOMPANY?  ' title="'.$erCOMPANY.'"'  : '').' placeholder="Название компании"', 	-1, 0)?>
</div>
<div class="flex pdata">
	 <?=substr_replace($arResult["QUESTIONS"]["PHONE"]["HTML_CODE"], 	($erPHONE? 	  ' title="'.$erPHONE.'"' 	 : '').' placeholder="Телефон*"', 	  		-1, 0)?> <?=substr_replace($arResult["QUESTIONS"]["EMAIL"]["HTML_CODE"], 	($erEMAIL? 	  ' title="'.$erEMAIL.'"'  	 : '').' placeholder="E-mail*"',			-1, 0)?>
</div>
<div class="flex attach">
	 <?=substr_replace($arResult["QUESTIONS"]["CVFILE"]["HTML_CODE"], 	($erCVFILE?  ' title="'.$erCVFILE.'"'  : ''), 	-1, 0)?> <label for="att">Прикрепить резюме (doc, pdf не более 20Мб)</label>
</div>
<div class="flex pdata">
	 <?=substr_replace($arResult["QUESTIONS"]["MESSAGETEXT"]["HTML_CODE"],($erMESTEXT? ' title="'.$erMESTEXT.'"'  : '').' placeholder="Почему вы хотите работать у нас*"', 75, 0)?>
	<div>
		<div class="hhagree">
			 <?=substr_replace(strstr($arResult["QUESTIONS"]["agree"]["HTML_CODE"], '<label', true), ($eragree? ' title="'.$eragree.'"' : ''),	-1, 0) ?>
			<div>
				<div class="chkbox">
				</div>
				<div>
					 Я даю 
					<!--noindex--><a rel="nofollow" target="_blank" href="/SoglasieRubytech.pdf">согласие</a><!--/noindex--> на <a href="/obrabotka-personalnykh-dannykh.php">обработку персональных данных</a>
				</div>
			</div>
			<div class="flex submit-row">
 <input type="hidden" name="web_form_apply" value="Y"> <button class="btn" type="submit" name="web_form_submit">Отправить</button>
			</div>
		</div>
	</div>
	 <?=$arResult["FORM_FOOTER"]?> <script src="<?=SITE_TEMPLATE_PATH?>/js/form.js"></script>
</div>
 <br>