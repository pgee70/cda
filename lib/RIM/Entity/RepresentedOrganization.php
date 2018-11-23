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

namespace i3Soft\CDA\RIM\Entity;

/**
 *
 * @package     i3Soft\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://github.com/pgee70/cda
 *
 */

use i3Soft\CDA\DataType\Name\EntityName;
use i3Soft\CDA\Elements\AbstractElement;
use i3Soft\CDA\Elements\StandardIndustryClassCode;
use i3Soft\CDA\Interfaces\ClassCodeInterface;
use i3Soft\CDA\Interfaces\DeterminerCodeInterface;
use i3Soft\CDA\RIM\Extensions\AsEntityIdentifier;
use i3Soft\CDA\RIM\Role\AsOrganizationPartOf;
use i3Soft\CDA\Traits\AddrsTrait;
use i3Soft\CDA\Traits\AsEntityIdentifierTrait;
use i3Soft\CDA\Traits\ClassCodeTrait;
use i3Soft\CDA\Traits\DeterminerCodeTrait;
use i3Soft\CDA\Traits\IdsTrait;
use i3Soft\CDA\Traits\NamesTrait;
use i3Soft\CDA\Traits\TelecomsTrait;


/**
 * Class RepresentedOrganization
 *
 * @package i3Soft\CDA\RIM\Entity
 */
class RepresentedOrganization extends AbstractElement implements ClassCodeInterface, DeterminerCodeInterface
{
  use IdsTrait;
  use NamesTrait;
  use TelecomsTrait;
  use AddrsTrait;
  use ClassCodeTrait;
  use AsEntityIdentifierTrait;


  use DeterminerCodeTrait;


  /** @var StandardIndustryClassCode */
  protected $standardIndustryClassCode;
  /** @var AsOrganizationPartOf */
  protected $asOrganizationPartOf;

  /**
   * RepresentedOrganization constructor.
   *
   * @param EntityName         $name
   * @param AsEntityIdentifier $as_entity_identifier
   */
  public function __construct ($name = NULL, $as_entity_identifier = NULL)
  {
    $this->setAcceptableClassCodes(ClassCodeInterface::EntityClassOrganization)
      ->setClassCode(ClassCodeInterface::IDENTITY)
      ->setDeterminerCode('');
    if ($name && $name instanceof EntityName)
    {
      $this->addName($name);
    }
    if ($as_entity_identifier && $as_entity_identifier instanceof AsEntityIdentifier)
    {
      $this->setAsEntityIdentifier($as_entity_identifier);
    }
  }

  /**
   * @param EntityName $name
   *
   * @return self
   */
  public function addName (EntityName $name): self
  {
    $this->names[] = $name;
    return $this;
  }

  /**
   * @return string
   */
  public function getElementTag (): string
  {
    return 'representedOrganization';
  }

  /**
   * @param \DOMDocument $doc
   *
   * @return \DOMElement
   */
  public function toDOMElement (\DOMDocument $doc): \DOMElement
  {
    $el = $this->createElement($doc);
    if ($this->hasIds())
    {
      foreach ($this->getIds() as $id)
      {
        $el->appendChild($id->toDOMElement($doc));
      }
    }
    $this->renderIds($el, $doc);
    $this->renderNames($el, $doc);
    $this->renderTelecoms($el, $doc);
    $this->renderAddrs($el, $doc);


    if ($this->hasStandardIndustryClassCode())
    {
      $el->appendChild($this->getStandardIndustryClassCode()->toDOMElement($doc));
    }
    $this->renderAsOrganizationPartOf($el, $doc);
    $this->renderAsEntityIdentifier($el, $doc);

    return $el;
  }


  /**
   * @return bool
   */
  public function hasStandardIndustryClassCode (): bool
  {
    return NULL !== $this->standardIndustryClassCode;
  }

  /**
   * @return StandardIndustryClassCode
   */
  public function getStandardIndustryClassCode (): StandardIndustryClassCode
  {
    return $this->standardIndustryClassCode;
  }

  /**
   * @param StandardIndustryClassCode $standardIndustryClassCode
   *
   * @return self
   */
  public function setStandardIndustryClassCode (StandardIndustryClassCode $standardIndustryClassCode): self
  {
    $this->standardIndustryClassCode = $standardIndustryClassCode;
    return $this;
  }

  /**
   * @param \DOMElement  $el
   * @param \DOMDocument $doc
   */
  public function renderAsOrganizationPartOf (\DOMElement $el, \DOMDocument $doc)
  {
    if ($this->hasAsOrganizationPartOf())
    {
      $el->appendChild($this->getAsOrganizationPartOf()->toDOMElement($doc));
    }
  }

  /**
   * @return bool
   */
  public function hasAsOrganizationPartOf (): bool
  {
    return NULL !== $this->asOrganizationPartOf;
  }

  /**
   * @return AsOrganizationPartOf
   */
  public function getAsOrganizationPartOf (): AsOrganizationPartOf
  {
    return $this->asOrganizationPartOf;
  }

  /**
   * @param AsOrganizationPartOf $asOrganizationPartOf
   *
   * @return self
   */
  public function setAsOrganizationPartOf (AsOrganizationPartOf $asOrganizationPartOf): self
  {
    $this->asOrganizationPartOf = $asOrganizationPartOf;
    return $this;
  }


}