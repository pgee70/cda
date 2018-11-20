<?php


/**
 * The MIT License
 *
 * Copyright 2018  Peter Gee <https://github.com/pgee70>.
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

namespace i3Soft\CDA\tests\RIM\Role;

/**
 *
 * @package     i3Soft\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://github.com/pgee70/cda
 *
 * @package     i3Soft\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://github.com/pgee70/cda
 *
 * @group       CDA
 * @group       CDA_RIM
 * @group       CDA_RIM_AssignedEntity
 *
 * phpunit-debug  --no-coverage --group CDA_RIM_AssignedEntity
 *
 */


use i3Soft\CDA\DataType\Collection\Set;
use i3Soft\CDA\DataType\Identifier\InstanceIdentifier;
use i3Soft\CDA\DataType\Name\EntityName;
use i3Soft\CDA\DataType\Name\PersonName;
use i3Soft\CDA\DataType\TextAndMultimedia\SimpleString;
use i3Soft\CDA\Elements\Address\AdditionalLocator;
use i3Soft\CDA\Elements\Address\Addr;
use i3Soft\CDA\Elements\Address\City;
use i3Soft\CDA\Elements\Address\PostalCode;
use i3Soft\CDA\Elements\Address\State;
use i3Soft\CDA\Elements\Address\StreetAddressLine;
use i3Soft\CDA\Elements\Address\Telecom;
use i3Soft\CDA\Elements\Code;
use i3Soft\CDA\Elements\Id;
use i3Soft\CDA\RIM\Entity\AssignedEntity;
use i3Soft\CDA\RIM\Entity\AssignedPerson;
use i3Soft\CDA\RIM\Entity\RepresentedOrganization;
use i3Soft\CDA\RIM\Extensions\AsEntityIdentifier;
use i3Soft\CDA\RIM\Extensions\AssigningGeographicArea;
use i3Soft\CDA\RIM\Extensions\ExtEntityName;
use i3Soft\CDA\RIM\Extensions\ExtId;
use i3Soft\CDA\tests\MyTestCase;

class AssignedEntity_test extends MyTestCase
{
    public function test_tag()
    {
        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<assignedEntity>
  <id root="123F9366-78EC-11DF-861B-EE24DFD72085"/>
  <code code="253111" displayName="General Practitioner" codeSystem="2.16.840.1.113883.13.62" codeSystemName="1220.0 - ANZSCO -- Australian and New Zealand Standard Classification of Occupations, 2013, Version 1.2"/>
  <addr use="WP">
    <streetAddressLine>1 Clinician street</streetAddressLine>
    <city>Nethaville</city>
    <state>QLD</state>
    <postalCode>5555</postalCode>
    <additionalLocator>32568931</additionalLocator>
  </addr>
  <telecom use="WP" value="tel:0712341234"/>
  <assignedPerson classCode="PSN">
    <name>
      <prefix>Dr.</prefix>
      <given>General</given>
      <family>Doctor</family>
    </name>
  </assignedPerson>
  <ext:asEntityIdentifier classCode="IDENT">
    <ext:id assigningAuthorityName="HPI-I" root="1.2.36.1.2001.1003.0" extension="8003611566682112"/>
    <ext:assigningGeographicArea classCode="PLC">
      <ext:name>National Identifier</ext:name>
    </ext:assigningGeographicArea>
  </ext:asEntityIdentifier>
  <representedOrganization classCode="IDENT">
    <name>Good Health Clinic</name>
    <ext:asEntityIdentifier classCode="IDENT">
      <ext:id assigningAuthorityName="HPI-O" root="1.2.36.1.2001.1003.0" extension="8003621566684455"/>
      <ext:assigningGeographicArea classCode="PLC">
        <ext:name>National Identifier</ext:name>
      </ext:assigningGeographicArea>
    </ext:asEntityIdentifier>
  </representedOrganization>
</assignedEntity>

XML;
        $names    = new Set(PersonName::class);
        $names->add((new PersonName())
          ->addPart('prefix', 'Dr.')
          ->addPart(PersonName::FIRST_NAME, 'General')
          ->addPart(PersonName::LAST_NAME, 'Doctor')
        );
        $addr = new Addr(
          new StreetAddressLine('1 Clinician street'),
          new City('Nethaville'),
          new State('QLD'),
          new PostalCode('5555'),
          new AdditionalLocator('32568931')
        );
        $addr->setUseAttribute('WP');
        $tag               = new AssignedEntity(
          new Id(new InstanceIdentifier('123F9366-78EC-11DF-861B-EE24DFD72085')),
          Code::Occupation('253111'),
          $addr,
          new Telecom('WP', 'tel:0712341234'),
          new AssignedPerson($names),
          new AsEntityIdentifier(
            new ExtId('HPI-I', '1.2.36.1.2001.1003.0', '8003611566682112'),
            new AssigningGeographicArea(new ExtEntityName(new SimpleString('National Identifier')))
          ),
          new RepresentedOrganization(
            new EntityName('Good Health Clinic'),
            new AsEntityIdentifier(
              new ExtId('HPI-O', '1.2.36.1.2001.1003.0', '8003621566684455'),
              new AssigningGeographicArea(new ExtEntityName(new SimpleString('National Identifier')))))
        );
        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $doc               = $tag->toDOMElement($dom);
        $dom->formatOutput = true;
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }
}