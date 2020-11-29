<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>

  .content{
    clear:both;
  }
  .content .element {
	padding-right: 10px;
  }
  #content2 div{
    float:left;
  }
</style>

<div id="content2" class="content" style=" text-align:left;">    
<?
$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));

	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
	<div class="element" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
        <?
        $fontSize=intval($arParams["TOP_DEPTH"]-$arSection["DEPTH_LEVEL"]-1);
        ?>
        <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><font size="<?=($fontSize>=0?'+'.$fontSize:$fontSize)?>"><!--<?=(isset($arSection["CODE"])?$arSection["CODE"]:'')?>--> <?=strtolower($arSection["NAME"])?><?if($arParams["COUNT_ELEMENTS"] && $arSection["ELEMENT_CNT"]>0):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?endif;?></font></a>
        </div>
<?endforeach?>
</div>
