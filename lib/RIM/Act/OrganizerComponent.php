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
use i3Soft\CDA\Elements\Procedure;
use i3Soft\CDA\Interfaces\ContextConductionIndInterface;
use i3Soft\CDA\Interfaces\TypeCodeInterface;
use i3Soft\CDA\Traits\ActTrait;
use i3Soft\CDA\Traits\ContextConductionIndTrait;
use i3Soft\CDA\Traits\EncounterTrait;
use i3Soft\CDA\Traits\ObservationMediaTrait;
use i3Soft\CDA\Traits\ObservationTrait;
use i3Soft\CDA\Traits\OrganizerTrait;
use i3Soft\CDA\Traits\ProcedureTrait;
use i3Soft\CDA\Traits\RegionOfInterestTrait;
use i3Soft\CDA\Traits\SeperatableIndTrait;
use i3Soft\CDA\Traits\SequenceNumberTrait;
use i3Soft\CDA\Traits\SubstanceAdministrationTrait;
use i3Soft\CDA\Traits\SupplyTrait;
use i3Soft\CDA\Traits\TypeCodeTrait;

class OrganizerComponent extends AbstractElement implements TypeCodeInterface, ContextConductionIndInterface
{
  use TypeCodeTrait;
  use ActTrait;
  use SequenceNumberTrait;
  use SeperatableIndTrait;
  use EncounterTrait;
  use ObservationTrait;
  use ObservationMediaTrait;
  use OrganizerTrait;
  use ProcedureTrait;
  use RegionOfInterestTrait;
  use SubstanceAdministrationTrait;
  use SupplyTrait;
  use ContextConductionIndTrait;

  public function __construct ($choice = NULL)
  {
    $this->setAcceptableTypeCodes(TypeCodeInterface::ActRelationshipHasComponent)
      ->setTypeCode('');
    if ($choice instanceOf Act)
    {
      $this->setAct($choice);
    }
    elseif ($choice instanceOf Encounter)
    {
      $this->setEncounter($choice);
    }
    elseif ($choice instanceOf Observation)
    {
      $this->setObservation($choice);
    }
    elseif ($choice instanceOf ObservationMedia)
    {
      $this->setObservationMedia($choice);
    }
    elseif ($choice instanceOf Organizer)
    {
      $this->setOrganizer($choice);
    }
    elseif ($choice instanceOf Procedure)
    {
      $this->setProcedure($choice);
    }
    elseif ($choice instanceOf SubstanceAdministration)
    {
      $this->setSubstanceAdministration($choice);
    }
  }

  /**
   * @inheritDoc
   */
  public function toDOMElement (\DOMDocument $doc): \DOMElement
  {
    $el = $this->createElement($doc);
    if ($this->hasSequenceNumber())
    {
      $el->appendChild($this->getSequenceNumber()->toDOMElement($doc));
    }
    if ($this->hasSeperatableInd())
    {
      $el->appendChild($this->getSeperatableInd()->toDOMElement($doc));
    }
    if ($this->hasAct())
    {
      $el->appendChild($this->getAct()->toDOMElement($doc));
    }
    elseif ($this->hasEncounter())
    {
      $el->appendChild($this->getEncounter()->toDOMElement($doc));
    }
    elseif ($this->hasObservation())
    {
      $el->appendChild($this->getObservation()->toDOMElement($doc));
    }
    elseif ($this->hasObservationMedia())
    {
      $el->appendChild($this->getObservationMedia()->toDOMElement($doc));
    }
    elseif ($this->hasOrganizer())
    {
      $el->appendChild($this->getOrganizer()->toDOMElement($doc));
    }
    elseif ($this->hasProcedure())
    {
      $el->appendChild($this->getProcedure()->toDOMElement($doc));
    }
    elseif ($this->hasRegionOfInterest())
    {
      $el->appendChild($this->getRegionOfInterest()->toDOMElement($doc));
    }
    elseif ($this->hasSubstanceAdministration())
    {
      $el->appendChild($this->getSubstanceAdministration()->toDOMElement($doc));
    }
    elseif ($this->hasSupply())
    {
      $el->appendChild($this->getSupply()->toDOMElement($doc));
    }

    return $el;
  }


  /**
   * @inheritDoc
   */
  protected function getElementTag (): string
  {
    return 'component';
  }
}