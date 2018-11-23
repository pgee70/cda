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
use i3Soft\CDA\Interfaces\TypeCodeInterface;
use i3Soft\CDA\Traits\ConsentTrait;
use i3Soft\CDA\Traits\TypeCodeTrait;

/**
 * Class Authorization
 *
 * @package i3Soft\CDA\RIM\Act
 */
class Authorization extends AbstractElement implements TypeCodeInterface
{
  use TypeCodeTrait;
  use ConsentTrait;

  /**
   * get the element tag name
   *
   * @param Consent $consent
   */
  public function __construct (Consent $consent)
  {
    $this->setAcceptableTypeCodes(TypeCodeInterface::ActRelationshipType)
      ->setTypeCode(TypeCodeInterface::AUTHORIZED_BY);
    $this->setConsent($consent);
  }

  /**
   * Transforms the element into a DOMElement, which will be included
   * into the final CDA XML
   *
   * @param \DOMDocument $doc
   *
   * @return \DOMElement
   */
  public function toDOMElement (\DOMDocument $doc): \DOMElement
  {
    $el = $this->createElement($doc);
    $el->appendChild($this->getConsent()->toDOMElement($doc));
    return $el;
  }

  /**
   * @return string
   */
  protected function getElementTag (): string
  {
    return 'authorization';
  }
}