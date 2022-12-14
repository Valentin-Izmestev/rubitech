<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @global \CMain $APPLICATION
 * @var \StoreMenuSidebar $classBlock
 */

?>
<header class="landing-block landing-semantic-background-color container g-bg-white">
	<ul class="landing-block-node-menu-top catalog-sections-list-menu-items">
		<li class="landing-block-node-section-menu-item catalog-sections-list-menu-item">
			<a
				href="#system_mainpage"
				class="landing-block-node-menu-link catalog-sections-list-menu-item-link g-font-size-18"
			>
				Main page
			</a>
		</li>
	</ul>
	<?php $APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"store_v3_menu",
		[
			'IBLOCK_TYPE' => '',
			'IBLOCK_ID' => $classBlock->get('IBLOCK_ID'),
			'SECTION_ID' => $classBlock->get('SECTION_ID'),
			'SECTION_URL' => '#system_catalog#SECTION_CODE_PATH#/',
			'COUNT_ELEMENTS' => 'Y',
			'TOP_DEPTH' => '1',
			'CACHE_GROUPS' => 'N',
			'CACHE_TIME' => '36000000',
			'CACHE_TYPE' => 'A',
			'SHOW_ANGLE' => 'N',
		]
	); ?>
	<ul class="g-font-size-16 g-font-roboto u-list-inline g-py-10">
		<li class="landing-block-node-section-menu-item-custom g-pl-17 g-pr-17 g-py-9 active">
			<a
				href="#"
				class="landing-block-node-menu-link-custom g-text-decoration-none--hover g-opacity-0_6"
			>
				Business Card
			</a>
		</li>
		<li class="landing-block-node-section-menu-item-custom g-pl-17 g-pr-17 g-py-9 active">
			<a
				href="#"
				class="landing-block-node-menu-link-custom g-text-decoration-none--hover g-opacity-0_6"
			>
				Payment Options
			</a>
		</li>
	</ul>
</header>