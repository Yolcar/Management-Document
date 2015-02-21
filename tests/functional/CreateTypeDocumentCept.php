<?php 
$I = new FunctionalTester($scenario);
$I->am('a template creator');
$I->wantTo('Crear nuevo tipo de documento');

$I->amOnPage('type_document');
$I->click('Crear Tipo');
$I->seeCurrentUrlEquals('/type_document/create');
$I->see('Crear Nuevo Tipo de Documento','h1');

$I->fillField('name','Memo');
$I->click('Crear');

$I->seeCurrentUrlEquals('/type_document');
$I->seeRecord('type_documents',['name' => 'Memo']);