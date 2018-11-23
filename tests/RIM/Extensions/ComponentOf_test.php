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

namespace i3Soft\CDA\tests\RIM\Extensions;

/**
 *
 * @package     i3Soft\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://github.com/pgee70/cda
 *
 * @group       CDA
 * @group       CDA_RIM
 * @group       CDA_RIM_ComponentOf
 *
 * phpunit-debug  --no-coverage --group CDA_RIM_ComponentOf
 *
 */


use i3Soft\CDA\DataType\Collection\Interval\IntervalOfTime;
use i3Soft\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use i3Soft\CDA\Elements\EffectiveTime;
use i3Soft\CDA\RIM\Act\ComponentOf;
use i3Soft\CDA\RIM\Act\EncompassingEncounter;
use i3Soft\CDA\tests\MyTestCase;

class ComponentOf_test extends MyTestCase
{
  public function test_tag ()
  {
    $expected = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<componentOf>
  <encompassingEncounter classCode="ENC">
    <effectiveTime xsi:type="IVL_TS">
      <!-- DateTime Health Event Started -->
      <low value="201112141100+1000" />
      <!-- DateTime Health Event Ended -->
      <high value="201112141130+1000" />
    </effectiveTime>
  </encompassingEncounter>
</componentOf>
XML;
    $tag      = new ComponentOf(
      new EncompassingEncounter(
        new EffectiveTime(
          new IntervalOfTime(
            (new TimeStamp(
              new \DateTime('2011-12-14 11:00:00', new \DateTimeZone('+1000'))))
              ->setOffset(TRUE)
              ->setPrecision(TimeStamp::PRECISION_MINUTES),
            (new TimeStamp(new \DateTime('2011-12-14 11:30:00', new \DateTimeZone('+1000'))))
              ->setOffset(TRUE)
              ->setPrecision(TimeStamp::PRECISION_MINUTES))
        )
      )
    );

    $dom = new \DOMDocument('1.0', 'UTF-8');
    $doc = $tag->toDOMElement($dom);
    $dom->appendChild($doc);
    $cda = $dom->saveXML();
    $this->assertXmlStringEqualsXmlString($expected, $cda);
  }
}