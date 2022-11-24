<?
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;

Loc::loadMessages(__FILE__);

class brainforce_cookies extends CModule {

	var $MODULE_ID = "brainforce.cookies";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;

	public function __construct(){
	
		if(file_exists(__DIR__."/version.php")){
	
			$arModuleVersion = [];
            		include __DIR__ . '/version.php';

			$this->MODULE_ID 		   = str_replace("_", ".", get_class($this));
			$this->MODULE_VERSION 	   = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
			$this->MODULE_NAME 		   = Loc::getMessage("BRAINFORCE_COOKIES_NAME");
			$this->MODULE_DESCRIPTION  = Loc::getMessage("BRAINFORCE_COOKIES_DESCRIPTION");
			$this->PARTNER_NAME 	   = Loc::getMessage("BRAINFORCE_COOKIES_PARTNER_NAME");
			$this->PARTNER_URI  	   = Loc::getMessage("BRAINFORCE_COOKIES_PARTNER_URI");
		}
	
		return false;
	}

	public function DoInstall(){
	
		global $APPLICATION;
	
		if(CheckVersion(ModuleManager::getVersion("main"), "14.00.00")){
	
			$this->InstallFiles();
			$this->InstallDB();
	
			ModuleManager::registerModule($this->MODULE_ID);
	
			$this->InstallEvents();
		}else{
	
			$APPLICATION->ThrowException(
				Loc::getMessage("BRAINFORCE_COOKIES_INSTALL_ERROR_VERSION")
			);
		}
	
		$APPLICATION->IncludeAdminFile(
			Loc::getMessage("BRAINFORCE_COOKIES_INSTALL_TITLE")." \"".Loc::getMessage("BRAINFORCE_COOKIES_NAME")."\"",
			__DIR__."/step.php"
		);
	
		return false;
	}

	public function InstallFiles(){

		CopyDirFiles(__DIR__."/assets/js",Application::getDocumentRoot()."/bitrix/js/".$this->MODULE_ID."/",true,true);
		CopyDirFiles(__DIR__."/assets/css",Application::getDocumentRoot()."/bitrix/css/".$this->MODULE_ID."/",true,true);
		return false;
	}

	public function InstallDB(){
	
		return false;
	}

	public function InstallEvents(){
	
		EventManager::getInstance()->registerEventHandler(
			"main",
			"OnBeforeEndBufferContent",
			$this->MODULE_ID,
			"BFCookies",
			"ShowCookiesWindow"
		);
	
		return false;
	}

	public function DoUninstall(){
	
		global $APPLICATION;
	
		$this->UnInstallFiles();
		$this->UnInstallDB();
		$this->UnInstallEvents();
	
		ModuleManager::unRegisterModule($this->MODULE_ID);
	
		$APPLICATION->IncludeAdminFile(
			Loc::getMessage("BRAINFORCE_COOKIES_UNINSTALL_TITLE")." \"".Loc::getMessage("BRAINFORCE_COOKIES_NAME")."\"",
			__DIR__."/unstep.php"
		);
	
		return false;
	}

	public function UnInstallFiles(){

		Directory::deleteDirectory(Application::getDocumentRoot()."/bitrix/js/".$this->MODULE_ID);
		Directory::deleteDirectory(Application::getDocumentRoot()."/bitrix/css/".$this->MODULE_ID);
	
		return false;
	}

	public function UnInstallDB(){
	
		Option::delete($this->MODULE_ID);
	
		return false;
	}

	public function UnInstallEvents(){
	
		EventManager::getInstance()->unRegisterEventHandler(
			"main",
			"OnBeforeEndBufferContent",
			$this->MODULE_ID,
			"BFCookies",
			"ShowCookiesWindow"
		);
	
		return false;
	}

}