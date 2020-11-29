<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="catalog-section-list">
<ul>
<?
$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
		echo "<ul>";
	elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"])
		echo str_repeat("</ul>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
	<li id="<?=$this->GetEditAreaId($arSection['ID']);?>">
        <?
        $fontSize=intval($arParams["TOP_DEPTH"]-$arSection["DEPTH_LEVEL"]-1);
        ?>
        <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><font size="<?=($fontSize>=0?'+'.$fontSize:$fontSize)?>"><?=(isset($arSection["CODE"])?$arSection["CODE"]:'')?> <?=$arSection["NAME"]?><?if($arParams["COUNT_ELEMENTS"] && $arSection["ELEMENT_CNT"]>0):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?endif;?></font></a>
        </li>
<?endforeach?>
</ul>
</div>
