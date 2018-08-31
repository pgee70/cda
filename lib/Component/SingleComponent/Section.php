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

namespace i3Soft\CDA\Component\SingleComponent;

/**
 *
 * @package     i3Soft\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://github.com/pgee70/cda
 *
 */

use i3Soft\CDA\Elements\AbstractElement;
use i3Soft\CDA\Elements\Code;
use i3Soft\CDA\Elements\Entry;
use i3Soft\CDA\Elements\Html\Text;
use i3Soft\CDA\Elements\Html\Title;
use i3Soft\CDA\Elements\Id;
use i3Soft\CDA\Interfaces\ClassCodeInterface;
use i3Soft\CDA\Interfaces\MoodCodeInterface;
use i3Soft\CDA\Traits\AuthorTrait;
use i3Soft\CDA\Traits\ClassCodeTrait;
use i3Soft\CDA\Traits\CodeTrait;
use i3Soft\CDA\Traits\ConfidentialityCodeTrait;
use i3Soft\CDA\Traits\EntriesTrait;
use i3Soft\CDA\Traits\ExtCoverage2Trait;
use i3Soft\CDA\Traits\IdTrait;
use i3Soft\CDA\Traits\InformantsTrait;
use i3Soft\CDA\Traits\LanguageCodeTrait;
use i3Soft\CDA\Traits\MoodCodeTrait;
use i3Soft\CDA\Traits\SingleComponentTrait;
use i3Soft\CDA\Traits\SubjectTrait;
use i3Soft\CDA\Traits\TextTrait;
use i3Soft\CDA\Traits\TitleTrait;

/**
 * Class Section
 *
 * @package i3Soft\CDA\Component\SingleComponent
 */
class Section extends AbstractElement implements ClassCodeInterface, MoodCodeInterface
{
    use AuthorTrait;
    use CodeTrait;
    use ConfidentialityCodeTrait;
    use EntriesTrait;
    use IdTrait;
    use LanguageCodeTrait;
    use SingleComponentTrait;
    use SubjectTrait;
    use TextTrait;
    use TitleTrait;
    use InformantsTrait;
    use ExtCoverage2Trait;
    use ClassCodeTrait;
    use MoodCodeTrait;

    /** @noinspection ArrayTypeOfParameterByDefaultValueInspection */

    /**
     * Section constructor.
     *
     * @param Id    $id
     * @param Code  $code
     * @param Title $title
     * @param Text  $text
     * @param       $entry
     */
    public function __construct($id = null, $code = null, $title = null, $text = null, $entry = [])
    {
        $this->setAcceptableClassCodes(ClassCodeInterface::ActClass)
          ->setAcceptableMoodCodes(MoodCodeInterface::ActMood)
          ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
          ->setMoodCode(MoodCodeInterface::EVENT);

        $this->entries = [];

        if ($id && $id instanceof Id) {
            $this->setId($id);
        }
        if ($code && $code instanceof Code) {
            $this->setCode($code);
        }

        if ($title && $title instanceof Title) {
            $this->setTitle($title);
        }

        if ($text && $text instanceof Text) {
            $this->setText($text);
        }
        if ($entry) {
            if (\is_array($entry)) {
                $this->setEntries($entry);
            } elseif ($entry instanceof Entry) {
                $this->addEntry($entry);
            }
        }
    }


    /**
     * @return self
     */
    public function clearEntries(): self
    {
        $this->entries = array();
        return $this;
    }

    /**
     * create an entry, which is already bound to the current section
     *
     * @return Entry
     */
    public function createEntry(): Entry
    {
        $entry = new Entry();
        $this->addEntry($entry);
        return $entry;
    }


    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderId($el, $doc)
          ->renderCode($el, $doc)
          ->renderTitle($el, $doc)
          ->renderText($el, $doc)
          ->renderConfidentialityCode($el, $doc)
          ->renderLanguageCode($el, $doc)
          ->renderSubject($el, $doc)
          ->renderAuthor($el, $doc)
          ->renderInformants($el, $doc)
          ->renderEntries($el, $doc)
          ->renderComponents($el, $doc)
          ->renderExtCoverage2($el, $doc);
        return $el;
    }


    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'section';
    }

}