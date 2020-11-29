<?
/**
 * Copyright (c) 29/11/2020 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

global $MESS;
$strPath2Lang = str_replace("\\", "/", __FILE__);
$strPath2Lang = substr($strPath2Lang, 0, strlen($strPath2Lang)-strlen("/install/index.php"));
include(GetLangFileName($strPath2Lang."/lang/", "/install/index.php"));

if(class_exists("kit_classifier")) return;

Class kit_classifier extends CModule
{
	var $MODULE_ID = "kit.classifier";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	
	function kit_classifier()
	{
        $this->MODULE_NAME = GetMessage("KIT_INSTALL_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("KIT_INSTALL_DESCRIPTION");
		$this->PARTNER_NAME = "ASDAFF";
		$this->PARTNER_URI = "https://asdaff.github.io/";

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
		if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/bitrix/components/kit')) mkdir($_SERVER['DOCUMENT_ROOT'].'/bitrix/components/kit');
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/'.$this->MODULE_ID.'/install/components/kit', $_SERVER["DOCUMENT_ROOT"].'/bitrix/components/kit', true, true);
		RegisterModule($this->MODULE_ID);
	}

	function DoUninstall()
	{
		define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/kit/errlog.txt");
		if (!DeleteDirFilesEx('/bitrix/components/kit/classifier.section.list'))
			AddMessage2Log("Ошибка удаления папки модуля", $this->MODULE_ID);
		UnRegisterModule($this->MODULE_ID);
	}
}
?>