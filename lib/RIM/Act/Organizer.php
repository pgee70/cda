<?php /**
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
/** @noinspection MissingOrEmptyGroupStatementInspection */

/**
 *
 * @package     i3Soft\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://github.com/pgee70/cda
 *
 */


namespace i3Soft\CDA\RIM\Act;


use i3Soft\CDA\Elements\AbstractElement;
use i3Soft\CDA\Interfaces\ClassCodeInterface;
use i3Soft\CDA\Interfaces\MoodCodeInterface;
use i3Soft\CDA\Traits\AuthorsTrait;
use i3Soft\CDA\Traits\ClassCodeTrait;
use i3Soft\CDA\Traits\CodeTrait;
use i3Soft\CDA\Traits\EffectiveTimeTrait;
use i3Soft\CDA\Traits\IdsTrait;
use i3Soft\CDA\Traits\InformantsTrait;
use i3Soft\CDA\Traits\MoodCodeTrait;
use i3Soft\CDA\Traits\OrganizerComponentsTrait;
use i3Soft\CDA\Traits\ParticipantsTrait;
use i3Soft\CDA\Traits\PerformersTrait;
use i3Soft\CDA\Traits\PreconditionsTrait;
use i3Soft\CDA\Traits\ReferencesTrait;
use i3Soft\CDA\Traits\SpecimensTrait;
use i3Soft\CDA\Traits\StatusCodeTrait;
use i3Soft\CDA\Traits\SubjectTrait;

/**
 * Class Organizer
 *
 * @package i3Soft\CDA\RIM\Act
 */
class Organizer extends AbstractElement implements ClassCodeInterface, MoodCodeInterface
{
  use IdsTrait;
  use CodeTrait;
  use StatusCodeTrait;
  use EffectiveTimeTrait;
  use SubjectTrait;
  use SpecimensTrait;
  use PerformersTrait;
  use AuthorsTrait;
  use InformantsTrait;
  use ParticipantsTrait;
  use ReferencesTrait;
  use PreconditionsTrait;
  use OrganizerComponentsTrait;
  use ClassCodeTrait;
  use MoodCodeTrait;

  /**
   * Organizer constructor.
   *
   */
  public function __construct ()
  {
    $this->setAcceptableClassCodes(ClassCodeInterface::x_ActClassDocumentEntryOrganizer)
      ->setAcceptableMoodCodes(MoodCodeInterface::ActMood)
      ->setClassCode(ClassCodeInterface::BATTERY)
      ->setMoodCode(MoodCodeInterface::EVENT);
    $this->ids = array();
  }

  /**
   * @inheritDoc
   */
  public function toDOMElement (\DOMDocument $doc): \DOMElement
  {
    $el = $this->createElement($doc);
    $this->renderIds($el, $doc);
    $this->renderCode($el, $doc);
    $this->renderStatusCode($el, $doc);
    $this->renderEffectiveTime($el, $doc);
    $this->renderSubject($el, $doc);
    $this->renderSpecimens($el, $doc);
    $this->renderPerformers($el, $doc);
    $this->renderAuthors($el, $doc);
    $this->renderInformants($el, $doc);
    $this->renderParticipants($el, $doc);
    $this->renderReferences($el, $doc);
    $this->renderPreconditions($el, $doc);
    $this->renderComponents($el, $doc);
    return $el;
  }


  /**
   * @inheritDoc
   */
  protected function getElementTag (): string
  {
    return 'organizer';
  }

}