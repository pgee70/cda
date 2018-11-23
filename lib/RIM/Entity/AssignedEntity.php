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


namespace i3Soft\CDA\RIM\Entity;


use i3Soft\CDA\Elements\AbstractElement;
use i3Soft\CDA\Elements\Address\Addr;
use i3Soft\CDA\Elements\Address\Telecom;
use i3Soft\CDA\Elements\Code;
use i3Soft\CDA\Elements\Id;
use i3Soft\CDA\Interfaces\ClassCodeInterface;
use i3Soft\CDA\RIM\Extensions\AsEntityIdentifier;
use i3Soft\CDA\Traits\AddrsTrait;
use i3Soft\CDA\Traits\AsEntityIdentifierTrait;
use i3Soft\CDA\Traits\AssignedEntityTrait;
use i3Soft\CDA\Traits\AssignedPersonTrait;
use i3Soft\CDA\Traits\ClassCodeTrait;
use i3Soft\CDA\Traits\CodeTrait;
use i3Soft\CDA\Traits\IdTrait;
use i3Soft\CDA\Traits\RepresentedOrganizationTrait;
use i3Soft\CDA\Traits\TelecomsTrait;

/**
 * Class AssignedEntity
 *
 * @package i3Soft\CDA\RIM\Role
 */
class AssignedEntity extends AbstractElement implements ClassCodeInterface
{
  use IdTrait;
  use CodeTrait;
  use AddrsTrait;
  use TelecomsTrait;
  use AssignedEntityTrait;
  use AsEntityIdentifierTrait;
  use RepresentedOrganizationTrait;
  use AssignedPersonTrait;
  use ClassCodeTrait;

  /**
   * AssignedEntity constructor.
   *
   * @param Id                      $id
   * @param Code                    $code
   * @param Addr                    $addr
   * @param Telecom                 $telecom
   * @param AssignedPerson          $assigned_person
   * @param AsEntityIdentifier      $as_entity_identifier
   * @param RepresentedOrganization $represented_organization
   */
  public function __construct (
    Id $id,
    $code = NULL,
    $addr = NULL,
    $telecom = NULL,
    $assigned_person = NULL,
    $as_entity_identifier = NULL,
    $represented_organization = NULL
  ) {
    $this->setAcceptableClassCodes(['', ClassCodeInterface::ASSIGNED])
      ->setClassCode('')
      ->setId($id);
    if ($code && $code instanceof Code)
    {
      $this->setCode($code);
    }
    if ($addr && $addr instanceof Addr)
    {
      $this->addAddr($addr);
    }
    if ($telecom && $telecom instanceof Telecom)
    {
      $this->addTelecom($telecom);
    }
    if ($assigned_person && $assigned_person instanceof AssignedPerson)
    {
      $this->setAssignedPerson($assigned_person);
    }
    if ($as_entity_identifier && $as_entity_identifier instanceof AsEntityIdentifier)
    {
      $this->setAsEntityIdentifier($as_entity_identifier);
    }
    if ($represented_organization && $represented_organization instanceof RepresentedOrganization)
    {
      $this->setRepresentedOrganization($represented_organization);
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
    $this->renderId($el, $doc);
    $this->renderCode($el, $doc);
    $this->renderAddrs($el, $doc);
    $this->renderTelecoms($el, $doc);
    $this->renderAssignedPerson($el, $doc);
    $this->renderAsEntityIdentifier($el, $doc);
    $this->renderRepresentedOrganization($el, $doc);
    return $el;
  }


  /**
   * @return string
   */
  protected function getElementTag (): string
  {
    return 'assignedEntity';
  }
}