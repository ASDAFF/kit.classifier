<?
global $MESS;
$strPath2Lang = str_replace("\\", "/", __FILE__);
$strPath2Lang = substr($strPath2Lang, 0, strlen($strPath2Lang)-strlen("/install/index.php"));
include(GetLangFileName($strPath2Lang."/lang/", "/install/index.php"));

if(class_exists("smanline_classifier")) return;

Class smanline_classifier extends CModule
{
	var $MODULE_ID = "smanline.classifier";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	
	function smanline_classifier()
	{
        $this->MODULE_NAME = GetMessage("SMANLINE_INSTALL_NAME"); 
        $this->MODULE_DESCRIPTION = GetMessage("SMANLINE_INSTALL_DESCRIPTION");
		$this->PARTNER_NAME = "Smanline";
		$this->PARTNER_URI = "http://www.smanline.ru";

		$arModuleVersion = array();
        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }
	}

	function DoInstall()
	{
		if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/bitrix/components/smanline')) mkdir($_SERVER['DOCUMENT_ROOT'].'/bitrix/components/smanline');
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/'.$this->MODULE_ID.'/install/components/smanline', $_SERVER["DOCUMENT_ROOT"].'/bitrix/components/smanline', true, true);
		RegisterModule($this->MODULE_ID);
	}

	function DoUninstall()
	{
		define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/smanline/errlog.txt");
		if (!DeleteDirFilesEx('/bitrix/components/smanline/classifier.section.list'))
			AddMessage2Log("Ошибка удаления папки модуля", $this->MODULE_ID);
		UnRegisterModule($this->MODULE_ID);
	}
}
?>