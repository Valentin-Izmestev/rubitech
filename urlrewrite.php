<?php
$arUrlRewrite=array (
  15 => 
  array (
    'CONDITION' => '#^/press-center/(.+)/(\\\\?(.*))?#',
    'RULE' => 'CODE=$1&$3',
    'ID' => '',
    'PATH' => '/press-center/detail.php',
    'SORT' => 100,
  ),
  23 => 
  array (
    'CONDITION' => '#^/directions/(.*)/(\\\\?(.*))?#',
    'RULE' => 'CODE=$1&$3',
    'ID' => 'bitrix:form',
    'PATH' => '/directions/detail.php',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/products/(.*)/(\\\\?(.*))?#',
    'RULE' => 'CODE=$1&$3',
    'ID' => 'bitrix:form',
    'PATH' => '/products/detail.php',
    'SORT' => 100,
  ),
  25 => 
  array (
    'CONDITION' => '#^/projects/(.*)/(\\\\?(.*))?#',
    'RULE' => 'CODE=$1&$3',
    'ID' => 'bitrix:form',
    'PATH' => '/projects/detail.php',
    'SORT' => 100,
  ),
  16 => 
  array (
    'CONDITION' => '#^/career/(.*)/(\\\\?(.*))?#',
    'RULE' => 'CODE=$1&$3',
    'ID' => 'bitrix:form',
    'PATH' => '/career/detail.php',
    'SORT' => 100,
  ),
  17 => 
  array (
    'CONDITION' => '#^/press-center/#',
    'RULE' => '',
    'ID' => 'bitrix:form',
    'PATH' => '/press-center/index.php',
    'SORT' => 100,
  ),
  22 => 
  array (
    'CONDITION' => '#^/directions/#',
    'RULE' => '',
    'ID' => 'bitrix:form',
    'PATH' => '/directions/index.php',
    'SORT' => 100,
  ),
  18 => 
  array (
    'CONDITION' => '#^/products/#',
    'RULE' => '',
    'ID' => 'bitrix:form',
    'PATH' => '/products/index.php',
    'SORT' => 100,
  ),
  19 => 
  array (
    'CONDITION' => '#^/contacts/#',
    'RULE' => '',
    'ID' => 'bitrix:form',
    'PATH' => '/contacts/index.php',
    'SORT' => 100,
  ),
  24 => 
  array (
    'CONDITION' => '#^/projects/#',
    'RULE' => '',
    'ID' => 'bitrix:form',
    'PATH' => '/projects/index.php',
    'SORT' => 100,
  ),
  20 => 
  array (
    'CONDITION' => '#^/career/#',
    'RULE' => '',
    'ID' => 'bitrix:form',
    'PATH' => '/career/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  21 => 
  array (
    'CONDITION' => '#^/#',
    'RULE' => '',
    'ID' => 'bitrix:form',
    'PATH' => '/index.php',
    'SORT' => 100,
  ),
);
