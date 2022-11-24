<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$APPLICATION->IncludeComponent(
	"bitrix:form", 
	"feedback-vacancy", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "N",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_ADDITIONAL" => "N",
		"EDIT_STATUS" => "N",
		"IGNORE_CUSTOM_TEMPLATE" => "Y",
		"NOT_SHOW_FILTER" => array(
			0 => "",
			1 => "",
		),
		"NOT_SHOW_TABLE" => array(
			0 => "",
			1 => "",
		),
		"RESULT_ID" => $_REQUEST[RESULT_ID],
		"SEF_MODE" => "Y",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_STATUS" => "Y",
		"SHOW_VIEW_PAGE" => "Y",
		"START_PAGE" => "new",
		"SUCCESS_URL" => "success.php?WEB_FORM_ID=#FORM_ID#",
		"USE_EXTENDED_ERRORS" => "Y",
		"WEB_FORM_ID" => "3",
		"COMPONENT_TEMPLATE" => "",
		"SEF_FOLDER" => "/career/",
		"SEF_URL_TEMPLATES" => array(
			"new"  => "#WEB_FORM_ID#/",
			"list" => "#WEB_FORM_ID#/list/",
			"edit" => "#WEB_FORM_ID#/edit/#RESULT_ID#/",
			"view" => "#WEB_FORM_ID#/view/#RESULT_ID#/",
		)
	),
	false
);?>

<script src="<?=SITE_TEMPLATE_PATH?>/js/ajax-forms.js"></script>
