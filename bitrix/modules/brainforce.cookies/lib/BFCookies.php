<?

use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;

class BFCookies{

	public function constructor(){
	
		return true;
	}

	public function ShowCookiesWindow(){

		if(!defined("ADMIN_SECTION") && $ADMIN_SECTION !== true){

			$module_id = pathinfo(dirname(__DIR__))["basename"];

			$UseModule = Option::get($module_id, "switch_on");

			//Если модуль включен, то подгружаем нужные скрипты
			if ($UseModule == 'Y') {
				$WindowPosition = Option::get($module_id, "Position");	//Положение окна
				$LoadjQuery = Option::get($module_id, "jquery_on");	//Нужно ли подгружать jQuery?
				$BgColor = Option::get($module_id, "BgColor");	//Фоновый цвет окна
				if (!$BgColor) $BgColor ='#00a3e1';
				$TextColor = Option::get($module_id, "TextColor");	//Цвет текста в окне
				if (!$TextColor) $TextColor ='#FFFFFF';
				$ButtonBgColor = Option::get($module_id, "ButtonBgColor");	//Цвет кнопки
				if (!$ButtonBgColor) $ButtonBgColor ='#ffd507';
				$ButtonTextColor = Option::get($module_id, "ButtonTextColor");	//Цвет текста на кнопке
				if (!$ButtonTextColor) $ButtonTextColor ='#333333';
				$ButtonTextValue = Option::get($module_id, "ButtonText");	//Текст на кнопке
				if (!$ButtonTextValue) $ButtonTextValue = Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW_DEFBUTTONTEXT");
				$TextValue = Option::get($module_id, "Text");	//Текст в окне
				if (!$TextValue) $TextValue = Loc::getMessage("BRAINFORCE_COOKIES_OPTIONS_SHOW_WINDOW_DEFTEXT");
				$Delay = Option::get($module_id, "Delay");	//Время задержки
				if (!$Delay) $Delay = 600;
				$Days = Option::get($module_id, "Days");	//Время жизни куки
				if (!$Days) $Days = 10;
				
				

				Asset::getInstance()->addString("<style>
					:root {
						--window-bg-color: ".$BgColor.";
						--window-text-color: ".$TextColor.";
						--window-button-bg-color: ".$ButtonBgColor.";
						--window-button-text-color: ".$ButtonTextColor.";
					}
				</style>");
				
				switch ($WindowPosition) {
					case ('BOT'):
						Asset::getInstance()->addString("<style>#gdpr-cookie-message {bottom: 0;padding: 10px 0 10px 0px !important;width:100%;}
							#gdpr-cookie-message p{padding:0 10px; text-align:center}
							#gdpr-cookie-message p:last-child {margin-bottom: 0;text-align: center;}
							</style>");
						
					break;
					case ('BOTLEFT'):
						Asset::getInstance()->addString("<style>#gdpr-cookie-message {left: 10px;bottom: 10px;max-width: 375px;}</style>");
					break;
					CASE ('BOTRIGHT'):
						Asset::getInstance()->addString("<style>#gdpr-cookie-message {right: 10px;bottom: 10px;max-width: 375px;}</style>");
					break;
				}
				
				Asset::getInstance()->addCss("/bitrix/css/brainforce.cookies/brainforce.cookies.min.css");
				
				if ($LoadjQuery == 'Y') {
					Asset::getInstance()->addJs("https://code.jquery.com/jquery-2.2.4.min.js");
				}

				Asset::getInstance()->addJs("/bitrix/js/brainforce.cookies/jquery.ihavecookies.min.js");

				Asset::getInstance()->addString("<script type='text/javascript'>
					$(document).ready(function() {
						$('body').ihavecookies({
							message: '".$TextValue."',
							delay: ".$Delay.",
							expires: ".$Days.",
							link: '#privacy',
							onAccept: function(){
								var myPreferences = $.fn.ihavecookies.cookie();
								//console.log('Yay! The following preferences were saved...');
								//console.log(myPreferences);
							},
							acceptBtnLabel: '".$ButtonTextValue."',
							fixedCookieTypeDesc: 'These are essential for the website to work correctly.'
						});
					});
					</script>",
					true
				);
			
			}
		}

		return false;
	}
}