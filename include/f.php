<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$APPLICATION->IncludeComponent(
	"bitrix:form", 
	"feedback-full", 
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
		"WEB_FORM_ID" => "2",
		"COMPONENT_TEMPLATE" => "",
		"SEF_FOLDER" => "/products/",
		"SEF_URL_TEMPLATES" => array(
			"new"  => "#WEB_FORM_ID#/",
			"list" => "#WEB_FORM_ID#/list/",
			"edit" => "#WEB_FORM_ID#/edit/#RESULT_ID#/",
			"view" => "#WEB_FORM_ID#/view/#RESULT_ID#/",
		)
	),
	false
);?>

<script>
    // var zxc = BX.ajax.UpdatePageData
    // BX.ajax.UpdatePageData= function(asd) {
    //     console.log(asd)
    //     zxc(asd)
	// }
	// var asd = BX.ajax.submitComponentForm
	// BX.ajax.submitComponentForm = function(a,b,c) {
	// 	console.log(a,b,c)
	// 	asd(a,b,c)
	// }

	BX.ajax.submitComponentForm = function(obForm, container, bWait) {
		if (!obForm.target) {
			if (null == obForm.BXFormTarget) {
				var frame_name = 'formTarget_' + Math.random();
				obForm.BXFormTarget = document.body.appendChild(BX.create('IFRAME', {
					props: {
						name: frame_name,
						id: frame_name,
						src: 'javascript:void(0)'
					},
					style: {
						display: 'none'
					}
				}));
			}
			obForm.target = obForm.BXFormTarget.name;
		}

		if (!!bWait) var w = BX.showWait(container);

		obForm.BXFormCallback = function(d) {
			if (!!bWait)
				BX.closeWait(w);
			var callOnload = function() {
				if(!!window.bxcompajaxframeonload) {
					setTimeout(function(){window.bxcompajaxframeonload();window.bxcompajaxframeonload=null;}, 10);
				}
			};
			// console.log(d)
			if(d == 'Success') {
				console.log('Work!')
				alert('sent');
				obForm.reset();
			} else {
				BX(container).innerHTML = d;
			}
			BX.onCustomEvent('onAjaxSuccess', [null,null,callOnload]);
		};
		BX.bind(obForm.BXFormTarget, 'load', BX.proxy(BX.ajax._submit_callback, obForm));
		return true;
	};


</script>
