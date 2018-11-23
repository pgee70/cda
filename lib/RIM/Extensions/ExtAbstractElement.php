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

use i3Soft\CDA\ClinicalDocument as CDA;
use i3Soft\CDA\Interfaces\ClassCodeInterface;
use i3Soft\CDA\Interfaces\ElementInterface;
use i3Soft\CDA\Interfaces\MoodCodeInterface;
use i3Soft\CDA\Interfaces\NullFlavourInterface;
use i3Soft\CDA\Interfaces\TypeCodeInterface;

/**
 * this abstract element class does not have the realmcode typecode present in AbstractElement.
 */
abstract class ExtAbstractElement implements ElementInterface, NullFlavourInterface
{

  /**
   * @param \DOMDocument $doc
   *
   * @return \DOMElement
   */
  protected function createElement (\DOMDocument $doc): \DOMElement
  {
    /* @var $el \DOMElement */
    $el = $doc->createElement(CDA::getNS() . $this->getElementTag());
    /** @noinspection PhpUndefinedMethodInspection */
    if ($this->hasNullFlavour())
    {
      $el->setAttribute(CDA::getNS() . 'nullFlavor', $this->getNullFlavour());
      return $el;
    }
    // tag can have class code or type code, but not both.
    // can have a class code and a mood code, but not type code and mood code
    /** @noinspection PhpUndefinedMethodInspection */
    if ($this instanceof ClassCodeInterface
        && $this->hasClassCode())
    {
      $el->setAttribute(CDA::getNS() . 'classCode', $this->getClassCode());
      /** @noinspection PhpUndefinedMethodInspection */
      if ($this instanceof MoodCodeInterface
          && $this->hasMoodCode())
      {
        $el->setAttribute(CDA::getNS() . 'moodCode', $this->getMoodCode());
      }
    }
    /** @noinspection PhpUndefinedMethodInspection */
    elseif ($this instanceof TypeCodeInterface && $this->hasTypeCode())
    {
      $el->setAttribute(CDA::getNS() . 'typeCode', $this->getTypeCode());
    }
    return $el;
  }

  /**
   * get the element tag name
   *
   * @return string
   */
  abstract protected function getElementTag (): string;
}