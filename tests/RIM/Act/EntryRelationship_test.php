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

namespace i3Soft\CDA\tests\RIM\Act;

/**
 *
 * @package     i3Soft\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://github.com/pgee70/cda
 *
 * @group       CDA
 * @group       CDA_RIM
 * @group       CDA_RIM_EntryRelationship
 *
 * phpunit-debug  --no-coverage --group CDA_RIM_EntryRelationship
 *
 */

use i3Soft\CDA\Elements\Code;
use i3Soft\CDA\Elements\Id;
use i3Soft\CDA\Elements\Value;
use i3Soft\CDA\Interfaces\MoodCodeInterface;
use i3Soft\CDA\Interfaces\TypeCodeInterface;
use i3Soft\CDA\RIM\Act\EntryRelationship;
use i3Soft\CDA\RIM\Act\Observation;
use i3Soft\CDA\tests\MyTestCase;

class EntryRelationship_test extends MyTestCase
{
    /**
     * see page 118 of EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_tag()
    {
        $expected = <<<'CDA'
<entryRelationship inversionInd="true" typeCode="MFST">
    <observation classCode="OBS" moodCode="EVN">
      <id root="547FF5C0-7F8A-11E0-AE79-EE2B4924019B" />
      <!-- Manifestation -->
      <code code="39579001" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Anaphylaxis" />
      <!-- Reaction Type -->
      <value code="419076005" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Allergic reaction" xsi:type="CD" />
    </observation>
</entryRelationship>

CDA;
        $tag      = (new EntryRelationship(
          (new Observation(
            Code::SNOMED('39579001', 'Anaphylaxis'),
            Value::SNOMED('419076005', 'Allergic reaction')
          ))
            ->setMoodCode(MoodCodeInterface::EVENT)
            ->addId(Id::fromString('547FF5C0-7F8A-11E0-AE79-EE2B4924019B'))
        ))->setTypeCode(TypeCodeInterface::MANIFESTATION)
          ->setInversionInd(true);

        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $doc               = $tag->toDOMElement($dom);
        $dom->formatOutput = true;
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }
}

