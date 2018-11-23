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

namespace i3Soft\CDA\tests\Elements;

/**
 *
 * @package     i3Soft\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://github.com/pgee70/cda
 *
 * @group       CDA
 * @group       CDA_Elements
 * @group       CDA_Elements_BirthTime
 *
 * phpunit-debug  --no-coverage --group CDA_Elements_BirthTime
 *
 */

use i3Soft\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use i3Soft\CDA\Elements\BirthTime;
use i3Soft\CDA\tests\MyTestCase;

class BirthTime_test extends MyTestCase
{
  public function test_Code ()
  {
    $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<birthTime value="20100101000000"/>

XML;

    $birth_time = new BirthTime(new TimeStamp(new \DateTime('2010-01-01', new \DateTimeZone('Australia/Hobart'))));
    $dom        = new \DOMDocument('1.0', 'UTF-8');
    $doc        = $birth_time->toDOMElement($dom);
    $dom->appendChild($doc);
    $cda = $dom->saveXML();
    $this->assertXmlStringEqualsXmlString($expected, $cda);
  }
}
