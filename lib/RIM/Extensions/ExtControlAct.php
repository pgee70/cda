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


namespace i3Soft\CDA\RIM\Extensions;


use i3Soft\CDA\Elements\AbstractElement;
use i3Soft\CDA\Interfaces\ClassCodeInterface;
use i3Soft\CDA\Interfaces\MoodCodeInterface;
use i3Soft\CDA\Interfaces\NegationInterface;
use i3Soft\CDA\Traits\AuthorsTrait;
use i3Soft\CDA\Traits\ClassCodeTrait;
use i3Soft\CDA\Traits\CodeTrait;
use i3Soft\CDA\Traits\EffectiveTimeTrait;
use i3Soft\CDA\Traits\EntryRelationshipsTrait;
use i3Soft\CDA\Traits\IdsTrait;
use i3Soft\CDA\Traits\InformantsTrait;
use i3Soft\CDA\Traits\MoodCodeTrait;
use i3Soft\CDA\Traits\NegationIndTrait;
use i3Soft\CDA\Traits\ParticipantsTrait;
use i3Soft\CDA\Traits\PerformersTrait;
use i3Soft\CDA\Traits\PreconditionsTrait;
use i3Soft\CDA\Traits\PriorityCodeTrait;
use i3Soft\CDA\Traits\ReferencesTrait;
use i3Soft\CDA\Traits\SpecimensTrait;
use i3Soft\CDA\Traits\StatusCodeTrait;
use i3Soft\CDA\Traits\SubjectTrait;
use i3Soft\CDA\Traits\TextTrait;

class ExtControlAct extends AbstractElement implements ClassCodeInterface, MoodCodeInterface, NegationInterface
{
  use IdsTrait;
  use CodeTrait;
  use TextTrait;
  use StatusCodeTrait;
  use EffectiveTimeTrait;
  use PriorityCodeTrait;
  use SubjectTrait;
  use SpecimensTrait;
  use PerformersTrait;
  use AuthorsTrait;
  use InformantsTrait;
  use ParticipantsTrait;
  use EntryRelationshipsTrait;
  use ReferencesTrait;
  use PreconditionsTrait;

  use ClassCodeTrait;
  use MoodCodeTrait;
  use NegationIndTrait;


  public function __construct ()
  {
    // note the mood code is required.
    $this->setAcceptableClassCodes(ClassCodeInterface::ActClass)
      ->setClassCode(ClassCodeInterface::CONTROL_ACT)
      ->setAcceptableClassCodes(MoodCodeInterface::x_DocumentActMood);
  }

  /**
   * @inheritDoc
   */
  public function toDOMElement (\DOMDocument $doc): \DOMElement
  {
    return $this->createElement($doc);
  }

  /**
   * @inheritDoc
   */
  protected function getElementTag (): string
  {
    return 'controlAct';
  }


}