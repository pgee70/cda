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

namespace i3Soft\CDA\tests\DataType\Name;

use i3Soft\CDA\DataType\Name\PersonName;
use i3Soft\CDA\tests\MyTestCase;

/**
 * @author     Julien Fastré <julien.fastre@champs-libres.coop>
 * @group      CDA
 * @group      CDA_PersonName
 *
 * phpunit-debug  --no-coverage --group CDA_PersonName
 *
 */
class PersonName_test extends MyTestCase
{
  public function test_PersonName ()
  {
    $n = new PersonName();
    $n->addPart(PersonName::FIRST_NAME, 'Quick');
    $n->addPart(PersonName::LAST_NAME, 'Flupke');

    $dom = new \DOMDocument('1.0', 'UTF-8');
    $el  = $dom->createElement('el');
    $dom->appendChild($el);

    $n->setValueToElement($el, $dom);

    $expected    = <<<'CDA'
<el><name><given>Quick</given><family>Flupke</family></name></el>
CDA;
    $expectedDoc = new \DOMDocument('1.0');
    $expectedDoc->loadXML($expected);
    $expectedEl = $expectedDoc
      ->getElementsByTagName('el')
      ->item(0);

    $this->assertEqualXMLStructure($expectedEl, $el, TRUE);
  }

  public function test_PersonNameSingle ()
  {
    $n = new PersonName();
    $n->setString('test');

    $dom = new \DOMDocument('1.0', 'UTF-8');
    $el  = $dom->createElement('el');
    $dom->appendChild($el);

    $n->setValueToElement($el, $dom);

    $expected    = <<<'CDA'
<el><name>test</name></el>
CDA;
    $expectedDoc = new \DOMDocument('1.0');
    $expectedDoc->loadXML($expected);
    $expectedEl = $expectedDoc
      ->getElementsByTagName('el')
      ->item(0);

    $this->assertEqualXMLStructure($expectedEl, $el, TRUE);
  }

  /**
   * @throws \InvalidArgumentException
   */
  public function test_PersonNameEmpty ()
  {
    $n = new PersonName();
    $n->setString('test');

    $dom = new \DOMDocument('1.0', 'UTF-8');
    $el  = $dom->createElement('el');
    $dom->appendChild($el);
    $n->setValueToElement($el, $dom);
    $expected    = <<<'CDA'
<el><name>test</name></el>
CDA;
    $expectedDoc = new \DOMDocument('1.0');
    $expectedDoc->loadXML($expected);
    $expectedEl = $expectedDoc
      ->getElementsByTagName('el')
      ->item(0);

    $this->assertEqualXMLStructure($expectedEl, $el, TRUE);
  }

  public function test_PersonNameNULL ()
  {
    $n   = new PersonName();
    $dom = new \DOMDocument('1.0', 'UTF-8');
    $el  = $dom->createElement('el');
    $dom->appendChild($el);
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('the element does not contains any parts nor string');
    $n->setValueToElement($el, $dom);

  }

  public function test_PersonNameMultipleFamilyNames ()
  {
    $expected = <<<'CDA'
<el>
  <name>
   <given>Ella</given>
   <family qualifier="SP">PADEBEAUL</family>
   <family qualifier="BR">PADECHENSE</family>
  </name>
</el>
CDA;

    $person = (new PersonName())
      ->addPart(PersonName::FIRST_NAME, 'Ella')
      ->addPart(PersonName::LAST_NAME, 'PADEBEAUL', 'SP')
      ->addPart(PersonName::LAST_NAME, 'PADECHENSE', 'BR');

    $dom = new \DOMDocument('1.0', 'UTF-8');
    $el  = $dom->createElement('el');
    $dom->appendChild($el);
    $person->setValueToElement($el, $dom);
    $expectedDoc = new \DOMDocument('1.0');
    $expectedDoc->loadXML($expected);
    $expectedEl = $expectedDoc
      ->getElementsByTagName('el')
      ->item(0);
    $this->assertEqualXMLStructure($expectedEl, $el, TRUE);
  }
}
