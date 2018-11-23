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

/**
 * Class AsQualifications
 *
 * @package i3Soft\CDA\RIM\Extensions
 */
class AsQualifications extends Entity
{
  use ExtCodeTrait;

  /**
   * AsQualifications constructor.
   *
   * @param null $ext_code
   */
  public function __construct ($ext_code = NULL)
  {
    $this->setAcceptableClassCodes(array('', ClassCodeInterface::QUALIFICATION))
      ->setClassCode(ClassCodeInterface::QUALIFICATION);
    if ($ext_code)
    {
      $this->setExtCode($ext_code);
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
    $this->renderExtCode($el, $doc);
    return $el;
  }


  /**
   * @return string
   */
  protected function getElementTag (): string
  {
    return 'ext:asQualifications';
  }
}