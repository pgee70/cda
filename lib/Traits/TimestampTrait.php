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


namespace i3Soft\CDA\Traits;


use i3Soft\CDA\DataType\Quantity\DateAndTime\TimeStamp;

/**
 * Trait TimestampTrait
 *
 * @package i3Soft\CDA\Traits
 */
trait TimestampTrait
{
  /** @var TimeStamp */
  private $timestamp;

  /**
   * @param \DOMElement  $el
   * @param \DOMDocument $doc
   *
   * @return self
   */
  public function renderTimestamp (\DOMElement $el, \DOMDocument $doc): self
  {
    if ($this->hasTimestamp())
    {
      $this->getTimestamp()->setValueToElement($el, $doc);
    }
    return $this;
  }

  /**
   * @return bool
   */
  public function hasTimestamp (): bool
  {
    return NULL !== $this->timestamp;
  }

  /**
   * @return mixed
   */
  public function getTimestamp (): TimeStamp
  {
    return $this->timestamp;
  }

  /**
   * @param TimeStamp $timestamp
   *
   * @return self
   */
  public function setTimestamp (TimeStamp $timestamp): self
  {
    $this->timestamp = $timestamp;
    return $this;
  }
}