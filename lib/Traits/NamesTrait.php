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


use i3Soft\CDA\DataType\Collection\Set;
use i3Soft\CDA\DataType\Name\PersonName;

trait NamesTrait
{

  /**
   *
   * @var Set|PersonName[]
   */
  private $names = array();

  /**
   * @param \DOMElement  $el
   * @param \DOMDocument $doc
   *
   * @return self
   */
  public function renderNames (\DOMElement $el, \DOMDocument $doc): self
  {
    if ($this->hasNames())
    {
      foreach ($this->getNames() as $name)
      {
        $name->setValueToElement($el, $doc);
      }
    }
    return $this;
  }

  /**
   * @return bool
   */
  public function hasNames (): bool
  {
    return FALSE === empty($this->names);
  }

  /**
   * @return Set|PersonName[]
   */
  public function getNames ()
  {
    return $this->names;
  }

  /**
   * @param Set $names
   *
   * @return self
   */
  public function setNames (Set $names): self
  {
    $this->names = $names;
    return $this;
  }
}