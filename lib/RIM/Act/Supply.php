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
 */


namespace i3Soft\CDA\RIM\Act;

use i3Soft\CDA\Elements\AbstractElement;
use i3Soft\CDA\Interfaces\ClassCodeInterface;
use i3Soft\CDA\Interfaces\MoodCodeInterface;
use i3Soft\CDA\Traits\AuthorsTrait;
use i3Soft\CDA\Traits\ClassCodeTrait;
use i3Soft\CDA\Traits\CodeTrait;
use i3Soft\CDA\Traits\EffectiveTimesTrait;
use i3Soft\CDA\Traits\EntryRelationshipsTrait;
use i3Soft\CDA\Traits\ExpectedUseTimeTrait;
use i3Soft\CDA\Traits\ExtCoveragesTrait;
use i3Soft\CDA\Traits\ExtSubjectOf2Trait;
use i3Soft\CDA\Traits\IdsTrait;
use i3Soft\CDA\Traits\IndependentIndTrait;
use i3Soft\CDA\Traits\InformantsTrait;
use i3Soft\CDA\Traits\MoodCodeTrait;
use i3Soft\CDA\Traits\ParticipantsTrait;
use i3Soft\CDA\Traits\PerformersTrait;
use i3Soft\CDA\Traits\PreconditionsTrait;
use i3Soft\CDA\Traits\PriorityCodesTrait;
use i3Soft\CDA\Traits\ProductTrait;
use i3Soft\CDA\Traits\QuantityTrait;
use i3Soft\CDA\Traits\ReferencesTrait;
use i3Soft\CDA\Traits\RepeatNumberTrait;
use i3Soft\CDA\Traits\SpecimensTrait;
use i3Soft\CDA\Traits\StatusCodeTrait;
use i3Soft\CDA\Traits\SubjectTrait;
use i3Soft\CDA\Traits\TextTrait;

class Supply Extends AbstractElement implements ClassCodeInterface, MoodCodeInterface
{
  use IdsTrait;
  use CodeTrait;
  use TextTrait;
  use StatusCodeTrait;
  use EffectiveTimesTrait;
  use PriorityCodesTrait;
  use RepeatNumberTrait;
  use IndependentIndTrait;
  use QuantityTrait;
  use ExpectedUseTimeTrait;
  use SubjectTrait;
  use SpecimensTrait;
  use ProductTrait;
  use PerformersTrait;
  use AuthorsTrait;
  use InformantsTrait;
  use ParticipantsTrait;
  use EntryRelationshipsTrait;
  use ReferencesTrait;
  use PreconditionsTrait;
  use ExtSubjectOf2Trait;
  use ExtCoveragesTrait;

  use ClassCodeTrait;
  use MoodCodeTrait;

  public function __construct ()
  {
    $this->setAcceptableClassCodes([ClassCodeInterface::SUPPLY])
      ->setClassCode(ClassCodeInterface::SUPPLY)
      ->setAcceptableMoodCodes(MoodCodeInterface::x_DocumentSubstanceMood);
  }

  /**
   * @inheritDoc
   */
  public function toDOMElement (\DOMDocument $doc): \DOMElement
  {
    $el = $this->createElement($doc);
    $this->renderIds($el, $doc);
    $this->renderCode($el, $doc);
    $this->renderText($el, $doc);
    $this->renderStatusCode($el, $doc);
    $this->renderEffectiveTimes($el, $doc);
    $this->renderPriorityCodes($el, $doc);
    $this->renderRepeatNumber($el, $doc);
    $this->renderIndependentInd($el, $doc);
    $this->renderQuantity($el, $doc);
    $this->renderExpectedUseTime($el, $doc);
    $this->renderSubject($el, $doc);
    $this->renderSpecimens($el, $doc);
    $this->renderProduct($el, $doc);
    $this->renderPerformers($el, $doc);
    $this->renderAuthors($el, $doc);
    $this->renderInformants($el, $doc);
    $this->renderParticipants($el, $doc);
    $this->renderEntryRelationships($el, $doc);
    $this->renderReferences($el, $doc);
    $this->renderPreconditions($el, $doc);
    $this->renderExtSubjectOf2($el, $doc);
    $this->renderExtCoverages($el, $doc);
    return $el;
  }

  /**
   * @inheritDoc
   */
  protected function getElementTag (): string
  {
    return 'supply';
  }


}