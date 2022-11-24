<?

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;

Loc::loadMessages(__FILE__);

$request = HttpApplication::getInstance()->getContext()->getRequest();

$module_id = htmlspecialcharsbx($request["mid"] != "" ? $request["mid"] : $request["id"]);

Loader::includeModule($module_id);

$positions = array (
	'BOT'=>'Внизу по всей ширине',
	'BOTLEFT'=>'Внизу слева',
	'BOTRIGHT'=>'Внизу справа',
);

$aTabs = array(
	array(
		"DIV" 	  => "edit",
		"TAB" 	  => Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_TAB_NAME"),
		"TITLE"   => Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_TAB_NAME"),
		"OPTIONS" => array(
			Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_TAB_COMMON"),
			array(
				"switch_on",
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_TAB_SWITCH_ON"),
				"N",
				array("checkbox")
			),						
			array(
				"jquery_on",
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_TAB_JQUERY_ON"),
				"N",
				array("checkbox")
			),
			Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW"),
			array(
				"Position",
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW_POSITION"),
				"BOT",
				array("selectbox", $positions)
			),
			array(
				"BgColor",
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW_BGCOLOR"),
				"#00a3e1",
				array("text",7)
			),
			array(
				"TextColor",
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW_TEXTCOLOR"),
				"#FFFFFF",
				array("text",7)
			),
			array(
				"ButtonBgColor",
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW_BGBUTTON"),
				"#ffd507",
				array("text",7)
			),
			array(
				"ButtonTextColor",
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW_TEXTCOLOR"),
				"#333333",
				array("text",7)
			),
			array(
				"Text",
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW_TEXT"),
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW_DEFTEXT"),
				array("textarea",5,70)
			),
			array(
				"ButtonText",
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW_BUTTONTEXT"),
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW_DEFBUTTONTEXT"),
				array("text",15)
			),
			array(
				"Delay",
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW_DELAY"),
				"600",
				array("text",5)
			),
			array(
				"Days",
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW_DAYS"),
				"10",
				array("text",5)
			),
			Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_TAB_DOCUM"),
			array(
				"Developer",
				Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_DEVELOPER"),
				"<a href='https://brainforce.pro' target='_blank'>".Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_DEVELOPER_LINK")."</a>",
				array("statichtml")
			)
		)
	),
    array (
        "DIV" 	  => "instruction",
        "TAB" 	  => Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_TAB_INSTRUCTION"),
        "TITLE"   => Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_TAB_INSTRUCTION_NAME"),
    ),
    array (
        "DIV" 	  => "donate",
        "TAB" 	  => Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_TAB_DONATE"),
        "TITLE"   => Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_TAB_DONATE_NAME"),
    ),
);

if($request->isPost() && check_bitrix_sessid()){

	foreach($aTabs as $aTab){

		foreach($aTab["OPTIONS"] as $arOption){

			if(!is_array($arOption)){

				continue;
			}

			if($arOption["note"]){

				continue;
			}

			if($request["apply"]){

				$optionValue = $request->getPost($arOption[0]);

				if($arOption[0] == "switch_on"){

					if($optionValue == ""){

						$optionValue = "N";
					}
				}

				Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(",", $optionValue) : $optionValue);
			}elseif($request["default"]){

				Option::set($module_id, $arOption[0], $arOption[2]);
			}
		}
	}

	LocalRedirect($APPLICATION->GetCurPage()."?mid=".$module_id."&lang=".LANG);
}


$tabControl = new CAdminTabControl(
	"tabControl",
	$aTabs
);

$tabControl->Begin();
?>

<form action="<? echo($APPLICATION->GetCurPage()); ?>?mid=<? echo($module_id); ?>&lang=<? echo(LANG); ?>" method="post">

	<?
	foreach($aTabs as $aTab){

		if ($aTab['DIV'] == 'donate') {
                include __DIR__.'/tabs/donate.php';                
        }elseif ($aTab['DIV'] == 'instruction'){
                include __DIR__.'/tabs/instruction.php';
        }else {  
    		if($aTab["OPTIONS"]){
    
    			$tabControl->BeginNextTab();
    
    			__AdmSettingsDrawList($module_id, $aTab["OPTIONS"]);
    		}
        }
	}

	$tabControl->Buttons();
	?>

	<input type="submit" name="apply" value="<? echo(Loc::GetMessage("BRAINFORCE_COOKIES_OPTIONS_INPUT_APPLY")); ?>" class="adm-btn-save" />
	<input type="submit" name="default" value="<? echo(Loc::GetMessage("BRAINFORCE_COOKIES_OPTIONS_INPUT_DEFAULT")); ?>" />

	<?
	echo(bitrix_sessid_post());
	?>

</form>
<?
$tabControl->End();
?>