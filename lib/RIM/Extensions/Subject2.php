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
use i3Soft\CDA\Interfaces\TypeCodeInterface;
use i3Soft\CDA\Traits\SubstitutionPermissionTrait;
use i3Soft\CDA\Traits\TypeCodeTrait;

class Subject2 extends AbstractElement implements TypeCodeInterface
{
  use SubstitutionPermissionTrait;
  use TypeCodeTrait;

  public function __construct ($substitution_permission = NULL)
  {
    $this->setAcceptableTypeCodes(['', TypeCodeInterface::SUBJECT])
      ->setTypeCode('');
    if ($substitution_permission && $substitution_permission instanceof SubstitutionPermission)
    {
      $this->setSubstitutionPermission($substitution_permission);
    }

  }

  /**
   * @inheritDoc
   */
  public function toDOMElement (\DOMDocument $doc): \DOMElement
  {
    $el = $this->createElement($doc);
    $el->appendChild($this->getSubstitutionPermission()->toDOMElement($doc));
    return $el;
  }

  /**
   * @inheritDoc
   */
  protected function getElementTag (): string
  {
    return 'ext:subject2';
  }

}