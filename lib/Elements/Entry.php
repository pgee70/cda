<?php
/**
 * The MIT License
 *
 * Copyright 2017 Julien Fastré <julien.fastre@champs-libres.coop>.
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

namespace i3Soft\CDA\Elements;

use i3Soft\CDA\Interfaces\TypeCodeInterface;
use i3Soft\CDA\RIM\Act\Act;
use i3Soft\CDA\RIM\Act\Encounter;
use i3Soft\CDA\RIM\Act\Observation;
use i3Soft\CDA\RIM\Act\SubstanceAdministration;
use i3Soft\CDA\Traits\ActTrait;
use i3Soft\CDA\Traits\ContextConductionIndTrait;
use i3Soft\CDA\Traits\EncounterTrait;
use i3Soft\CDA\Traits\IdsTrait;
use i3Soft\CDA\Traits\ObservationMediaTrait;
use i3Soft\CDA\Traits\ObservationTrait;
use i3Soft\CDA\Traits\OrganizerTrait;
use i3Soft\CDA\Traits\ProcedureTrait;
use i3Soft\CDA\Traits\RegionOfInterestTrait;
use i3Soft\CDA\Traits\SubstanceAdministrationTrait;
use i3Soft\CDA\Traits\SupplyTrait;
use i3Soft\CDA\Traits\TypeCodeTrait;

/**
 * Class Entry
 *
 * @package i3Soft\CDA\Elements
 */
class Entry extends AbstractElement implements TypeCodeInterface
{

  use IdsTrait;
  use ActTrait;
  use EncounterTrait;
  use ObservationTrait;
  use ObservationMediaTrait;
  use OrganizerTrait;
  use ProcedureTrait;
  use RegionOfInterestTrait;
  use SubstanceAdministrationTrait;
  use SupplyTrait;
  // <xs:element ref="ext:controlAct"/>
  use TypeCodeTrait;
  use ContextConductionIndTrait;

  /**
   * Entry constructor.
   *
   * @param null $choice
   */
  public function __construct ($choice = NULL)
  {
    $this->setAcceptableTypeCodes(TypeCodeInterface::x_ActRelationshipEntry)
      ->setTypeCode(TypeCodeInterface::COMPONENT);
    if ($choice instanceof Act)
    {
      $this->setAct($choice);
    }
    elseif ($choice instanceof Encounter)
    {
      $this->setEncounter($choice);
    }
    elseif ($choice instanceof Observation)
    {
      $this->setObservation($choice);
    }
    elseif ($choice instanceof Procedure)
    {
      $this->setProcedure($choice);
    }
    elseif ($choice instanceof SubstanceAdministration)
    {
      $this->setSubstanceAdministration($choice);
    }

  }


  /**
   * @param \DOMDocument $doc
   *
   * @return \DOMElement
   */
  public function toDOMElement (\DOMDocument $doc): \DOMElement
  {
    $el = $this->createElement($doc);
    $this->renderIds($el, $doc);
    if ($this->hasAct())
    {
      $this->renderAct($el, $doc);
    }
    elseif ($this->hasEncounter())
    {
      $this->renderEncounter($el, $doc);
    }
    elseif ($this->hasObservation())
    {
      $this->renderObservation($el, $doc);
    }
    elseif ($this->hasObservationMedia())
    {
      $this->renderObservationMedia($el, $doc);
    }
    elseif ($this->hasOrganizer())
    {
      $this->renderOrganizer($el, $doc);
    }
    elseif ($this->hasProcedure())
    {
      $this->renderProcedure($el, $doc);
    }
    elseif ($this->hasRegionOfInterest())
    {
      $this->renderRegionOfInterest($el, $doc);
    }
    elseif ($this->hasSubstanceAdministration())
    {
      $this->renderSubstanceAdministration($el, $doc);
    }
    elseif ($this->hasSupply())
    {
      $this->renderSupply($el, $doc);
    }

    return $el;
  }


  /**
   * @return string
   */
  protected function getElementTag (): string
  {
    return 'entry';
  }

}
