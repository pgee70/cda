# CDA

Create HL7-CDA (tm) documents in PHP.

This library has some Australian CDA Extensions enabled.  
This library is a work in progress and does not currently provide full CDA coverage.


[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pgee70/cda/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pgee70/cda/?branch=master)

## Usage

To see how to use the library check out the tests folder.  [ClinicalDocument_test](tests/ClinicalDocument_test.php) and [NCTIS_test](tests/NCTIS_test.php)
 are good starting points.


### Manage references

Each `ClinicalDocument` has its own `ReferenceManager`, which help to manage references across documents.

`ReferenceType` may be added on some elements to create a reference :

```
$doc = new ClinicalDocument();

$refManager = $doc->getReferenceManager();

// create an element 'element' which may have a reference

$element->setReference($refManager->getReferenceType('my_reference'));
// will create <element ID="my_reference">blabla</element>

// add the reference in a text

$text->setText($refManager->getReferenceElement('my_reference'));
// will create <text><reference value="my_reference" /></text>

```
## Getting started
1. Quickstart

make sure you have [composer](https://getcomposer.org/download/) set up in your path.

```
composer clearcache
mkdir cda
mkdir cda/vendor
cd cda
composer require i3soft/cda
nano test.php

```
enter:
```
<?php
use i3Soft\CDA\ClinicalDocument;
use i3Soft\CDA\Elements\Html\Title;
require 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
$doc = new ClinicalDocument();
$doc->setTitle(
  new Title('Good Health Clinic Consultation Note')
);
echo $doc->toDOMDocument()->saveXML();
```
run the code:
```
php test.php
```

2. Run tests

you will need to install <https://phpunit.de/> and have `phpunit` available on your $PATH environment variable.
you might see the the file phpunit-debug in the tests, the file sets up command line debugging for intellij:

```
export XDEBUG_CONFIG="idekey=phpstorm-xdebug";
phpunit $@
```
Tests are structured so you can run the tests per group.  look for the @group docblock in each test file.

```
// run all the tests
cd vendor/i3soft/cda/tests/
phpunit 

// run one test:
phpunit --no-coverage --group CDA_RIM_Authorization

```

## Version History
### Version 1.0.6
Added static methods to Clinical Document so NS can be overloaded.
### Version 1.0.5
Added support for multiple family names and name qualifiers.
### Version 1.0.3
Updated documentation.

had some weird case-errors on the text that made unit tests fail.

### Version 1.0.2
Getting autoload to work properly.

### Version 1.0.0
This version has undergone significant refactoring and has had many more tags implemented. There has been some 
customisation to the Australian context.  The [NCTIS_test](tests/NCTIS_test.php) implements the code examples for 
an event summary CDA document.

In this version there is now a lot better checking of tag attributes such as moodCodes, classCodes, TypeCodes.  These 
acceptable codes are enumerated  in their Interfaces.  Check out [ClassCodeInterface](lib/Interfaces/ClassCodeInterface.php) 
for an example. The possible attributes for each tag are derived from the schema documents and set using the 
setAcceptable< Attribute >Codes methods.

PHP Traits have been used extensively to improve the code-styling/readability and to reduce unnecessary code duplication.

Note that while every effort was made to maintain compatibility with the previous version some changes were required,
and some breaking changes were made.


### Version 0.1.0
First release