<?php
/**
 * The MIT License
 *
 * Copyright 2017 Julien Fastré <julien.fastre@champs-libres.coop>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace i3Soft\CDA\tests\RIM\Participation;

use i3Soft\CDA\DataType\Collection\Set;
use i3Soft\CDA\DataType\Name\EntityName;
use i3Soft\CDA\DataType\TextAndMultimedia\SimpleString;
use i3Soft\CDA\Elements\Address\AdditionalLocator;
use i3Soft\CDA\Elements\Address\Addr;
use i3Soft\CDA\Elements\Address\City;
use i3Soft\CDA\Elements\Address\PostalCode;
use i3Soft\CDA\Elements\Address\State;
use i3Soft\CDA\Elements\Address\StreetAddressLine;
use i3Soft\CDA\Elements\Address\Telecom;
use i3Soft\CDA\Elements\Id;
use i3Soft\CDA\RIM\Entity\AssignedCustodian;
use i3Soft\CDA\RIM\Entity\RepresentedCustodianOrganization;
use i3Soft\CDA\RIM\Extensions\AsEntityIdentifier;
use i3Soft\CDA\RIM\Extensions\AssigningGeographicArea;
use i3Soft\CDA\RIM\Extensions\ExtEntityName;
use i3Soft\CDA\RIM\Extensions\ExtId;
use i3Soft\CDA\RIM\Participation\Custodian;
use i3Soft\CDA\tests\MyTestCase;

/**
 * @author     Julien Fastré <julien.fastre@champs-libres.coop>
 * @group      CDA
 * @group      CDA_Custodian
 *
 * phpunit-debug  --no-coverage --group CDA_Custodian
 *
 */
class Custodian_test extends MyTestCase
{
  public function test_Custodian ()
  {
    $names         = (new Set(EntityName::class))
      ->add(new EntityName('ABRUMET asbl'));
    $reprCustodian = new RepresentedCustodianOrganization($names, Id::fromString('82112744-ea24-11e6-95be-17f96f76d55c'));

    $assignedCustodian = new AssignedCustodian($reprCustodian);

    $custodian = new Custodian($assignedCustodian);

    $expected    = <<<'CDA'
 	  <custodian typeCode="CST">
 	    <assignedCustodian classCode="ASSIGNED">
 	      <representedCustodianOrganization classCode="ORG">
	        <id root="82112744-ea24-11e6-95be-17f96f76d55c"/>
 	        <name>ABRUMET asbl</name>
 	      </representedCustodianOrganization>
 	    </assignedCustodian>
 	  </custodian>
CDA;
    $expectedDoc = new \DOMDocument('1.0');
    $expectedDoc->loadXML($expected);
    $expectedCustodian = $expectedDoc
      ->getElementsByTagName('custodian')
      ->item(0);

    $this->assertEqualXMLStructure($expectedCustodian,
      $custodian->toDOMElement(new \DOMDocument()), TRUE);

  }

  /**
   * see page 55 of EventSummary_CDAImplementationGuide_v1.3.pdf
   */
  public function test_custodian_extended ()
  {
    $expected     = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<custodian typeCode="CST">
  <assignedCustodian classCode="ASSIGNED">
    <representedCustodianOrganization classCode="ORG">
      <id root="c9c04faf-d7a8-4802-8c69-980b0ce4d798"/>
      <name>Custodian</name>
      <telecom use="WP" value="tel:0712341234"/>
      <addr>
        <streetAddressLine>1 Clinician street</streetAddressLine>
        <city>Nethaville</city>
        <state>QLD</state>
        <postalCode>5555</postalCode>
        <additionalLocator>32568931</additionalLocator>
      </addr>
      <ext:asEntityIdentifier classCode="IDENT">
        <ext:id assigningAuthorityName="PAI-O" root="1.2.36.1.2001.1007.1" extension="8003640001000036"/>
        <ext:assigningGeographicArea classCode="PLC">
          <ext:name>National Identifier</ext:name>
        </ext:assigningGeographicArea>
      </ext:asEntityIdentifier>
    </representedCustodianOrganization>
  </assignedCustodian>
</custodian>

XML;
    $rep_cust_org = new RepresentedCustodianOrganization(
      (new Set(EntityName::class))->add(new EntityName('Custodian')),
      Id::fromString('c9c04faf-d7a8-4802-8c69-980b0ce4d798')
    );
    $rep_cust_org->addTelecom(new Telecom('WP', 'tel:0712341234'))
      ->addAddr(new Addr(
        new StreetAddressLine('1 Clinician street'),
        new City('Nethaville'),
        new State('QLD'),
        new PostalCode('5555'),
        new AdditionalLocator('32568931')
      ))
      ->setAsEntityIdentifier(
        new AsEntityIdentifier(
          new ExtId('PAI-O', '1.2.36.1.2001.1007.1', '8003640001000036'),
          new AssigningGeographicArea(new ExtEntityName(new SimpleString('National Identifier')))
        ));
    $custodian         = new Custodian(
      new AssignedCustodian($rep_cust_org));
    $dom               = new \DOMDocument('1.0', 'UTF-8');
    $doc               = $custodian->toDOMElement($dom);
    $dom->formatOutput = TRUE;
    $dom->appendChild($doc);
    $cda = $dom->saveXML();
    $this->assertXmlStringEqualsXmlString($expected, $cda);
  }
}
