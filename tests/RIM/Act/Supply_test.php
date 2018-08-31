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

/**
 *
 * @package     i3Soft\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://github.com/pgee70/cda
 *
 * @group       CDA
 * @group       CDA_RIM
 * @group       CDA_RIM_supply
 *
 * phpunit-debug  --no-coverage --group CDA_RIM_supply
 *
 */

use i3Soft\CDA\DataType\Code\AddressCodeType;
use i3Soft\CDA\DataType\Collection\Set;
use i3Soft\CDA\DataType\Identifier\InstanceIdentifier;
use i3Soft\CDA\DataType\Name\EntityName;
use i3Soft\CDA\DataType\Name\PersonName;
use i3Soft\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use i3Soft\CDA\Elements\Address\Addr;
use i3Soft\CDA\Elements\Address\Telecom;
use i3Soft\CDA\Elements\Id;
use i3Soft\CDA\Elements\Quantity;
use i3Soft\CDA\Elements\RepeatNumber;
use i3Soft\CDA\Interfaces\TypeCodeInterface;
use i3Soft\CDA\Interfaces\UseAttributeInterface;
use i3Soft\CDA\RIM\Act\EntryRelationship;
use i3Soft\CDA\RIM\Act\Supply;
use i3Soft\CDA\RIM\Entity\AssignedEntity;
use i3Soft\CDA\RIM\Entity\AssignedPerson;
use i3Soft\CDA\RIM\Entity\RepresentedOrganization;
use i3Soft\CDA\RIM\Participation\Author;
use i3Soft\CDA\RIM\Participation\Performer;
use i3Soft\CDA\RIM\Role\AssignedAuthor;
use i3Soft\CDA\tests\MyTestCase;

class Supply_test extends MyTestCase
{

    /**
     * example taken and adapted from
     *
     * @link https://wiki.ihe.net/index.php/CDA_Entry_Content_Modules#Specification_16
     * note that exmplar on the site had the sequence numbers different from the xsd document  so performer
     *  and author tags were change around
     */

    public function test_tag()
    {
        $expected = <<<'CDA'
<supply classCode='SPLY' moodCode='INT'>
	<templateId root='2.16.840.1.113883.10.20.1.34'/>
	<templateId root='1.3.6.1.4.1.19376.1.5.3.1.4.7.3'/>
	<id root='abc' extension='def'/>
	<repeatNumber value='2'/>
	<quantity value='5' unit='mg'/>
	<performer typeCode='PRF'>
		<time value='201801011235+1100'/>
		<assignedEntity>
			<id root='asdf' extension='ghjk'/>
			<addr></addr>
			<telecom use='WP' value='789456132'/>
			<representedOrganization>
				<name></name>
			</representedOrganization>
		</assignedEntity>
	</performer>
	<author>
		<time value='201801011235+1100'/>
		<assignedAuthor>
			<id root='qwerty' extension='uiop'/>
			<addr></addr>
			<telecom use='WP' value='123456789'/>
			<assignedPerson>
				<name use="L">
					<prefix>Dr</prefix>
					<given>Bone</given>
					<family>Doctor</family>
				</name>
			</assignedPerson>
			<representedOrganization>
				<name></name>
			</representedOrganization>
		</assignedAuthor>
	</author>
	<!-- Optional Fulfillment instructions -->
	<entryRelationship typeCode='SUBJ'></entryRelationship>
</supply>

CDA;
        $tag      = (new Supply())
          ->setMoodCode(\i3Soft\CDA\Interfaces\MoodCodeInterface::INTENT)
          ->addTemplateId(new InstanceIdentifier('2.16.840.1.113883.10.20.1.34'))
          ->addTemplateId(new InstanceIdentifier('1.3.6.1.4.1.19376.1.5.3.1.4.7.3'))
          ->returnSupply()
          ->addId(Id::fromString('abc', 'def'))
          ->returnSupply()
          ->setRepeatNumber(new RepeatNumber('2'))
          ->setQuantity(Quantity::fromString('mg', '5'))
          ->addAuthor(
            (new Author())
              ->setTypeCode('')
              ->setTime(TimeStamp::fromString('2018-01-01 12:35', '+1100'))
              ->setAssignedAuthor(
                (new AssignedAuthor())
                  ->setClassCode('')
                  ->addId(Id::fromString('qwerty', 'uiop'))
                  ->addAddr(new Addr())
                  ->addTelecom(new Telecom(AddressCodeType::BUSINESS, '123456789'))
                  ->setAssignedPerson(
                    (new AssignedPerson(
                      (new Set(PersonName::class))
                        ->add((new PersonName())
                          ->setUseAttribute(UseAttributeInterface::LEGAL_NAME)
                          ->addPart(PersonName::HONORIFIC, 'Dr')
                          ->addPart(PersonName::FIRST_NAME, 'Bone')
                          ->addPart(PersonName::LAST_NAME, 'Doctor'))))
                      ->setClassCode('')
                  )
                  ->setRepresentedOrganization(
                    (new RepresentedOrganization())
                      ->setClassCode('')
                      ->addName(new EntityName())
                  )
              )
          )
          ->addPerformer(
            (new Performer())
              ->setTypeCode(TypeCodeInterface::PERFORMER)
              ->setTime(TimeStamp::fromString('2018-01-01 12:35', '+1100'))
              ->setAssignedEntity(
                (new AssignedEntity(Id::fromString('asdf', 'ghjk')))
                  ->setClassCode('')
                  ->addAddr(new Addr())
                  ->addTelecom(new Telecom(AddressCodeType::BUSINESS, '789456132'))
                  ->setRepresentedOrganization(
                    (new RepresentedOrganization())
                      ->setClassCode('')
                      ->addName(new EntityName())
                  )
              )
          )
          ->addEntryRelationship((new EntryRelationship())->setTypeCode(TypeCodeInterface::HAS_SUBJECT));


        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $doc               = $tag->toDOMElement($dom);
        $dom->formatOutput = true;
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }
}

