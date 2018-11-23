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


/**
 * Trait ResponsiblePartyTrait
 *
 * @package i3Soft\CDA\Traits
 */
trait ResponsiblePartyTrait
{
  // todo implement ResponsibleParty
  /** @var ResponsibleParty */
  private $responsible_party;

  /**
   * @param \DOMElement  $el
   * @param \DOMDocument $doc
   *
   * @return self
   */
  public function renderResponsibleParty (\DOMElement $el, \DOMDocument $doc): self
  {
    if ($this->hasResponsibleParty())
    {
      $el->appendChild($this->getResponsibleParty()->toDOMElement($doc));
    }
    return $this;
  }

  /**
   * @return bool
   */
  public function hasResponsibleParty (): bool
  {
    return NULL !== $this->responsible_party;
  }

  /**
   * @return mixed
   */
  public function getResponsibleParty ()
  {
    return $this->responsible_party;
  }

  /**
   * @param mixed $responsible_party
   *
   * @return self
   */
  public function setResponsibleParty ($responsible_party): self
  {
    $this->responsible_party = $responsible_party;
    return $this;
  }
}