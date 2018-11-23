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

namespace i3Soft\CDA\RIM\Extensions;

/**
 *
 * @package     i3Soft\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://github.com/pgee70/cda
 *
 */


use i3Soft\CDA\Interfaces\ClassCodeInterface;
use i3Soft\CDA\RIM\Entity\Entity;
use i3Soft\CDA\Traits\ExtCodeTrait;
use i3Soft\CDA\Traits\ExtEmployerOrganizationTrait;
use i3Soft\CDA\Traits\JobClassCodeTrait;
use i3Soft\CDA\Traits\OccupationTrait;

/**
 * Class AsEmployment
 *
 * @package i3Soft\CDA\RIM\Extensions
 */
class AsEmployment extends Entity
{
  use ExtCodeTrait;
  use OccupationTrait;
  use JobClassCodeTrait;
  use ExtEmployerOrganizationTrait;

  /**
   * AsEmployment constructor.
   *
   * @param null $ext_code
   * @param null $occupation
   * @param null $job_class_code
   * @param null $ext_employer_organization
   */
  public function __construct (
    $ext_code = NULL,
    $occupation = NULL,
    $job_class_code = NULL,
    $ext_employer_organization = NULL
  ) {
    $this->setAcceptableClassCodes(array('', ClassCodeInterface::EMPLOYMENT))
      ->setClassCode(ClassCodeInterface::EMPLOYMENT);

    if ($ext_code)
    {
      $this->setExtCode($ext_code);
    }
    if ($occupation)
    {
      $this->setOccupation($occupation);
    }
    if ($job_class_code)
    {
      $this->setJobClassCode($job_class_code);
    }
    if ($ext_employer_organization)
    {
      $this->setExtEmployerOrganization($ext_employer_organization);
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
    $this->renderExtCode($el, $doc)
      ->renderOccupation($el, $doc)
      ->renderJobClassCode($el, $doc)
      ->renderExtEmployerOrganization($el, $doc);
    return $el;
  }

  /**
   * @return string
   */
  protected function getElementTag (): string
  {
    return 'ext:asEmployment';
  }

}