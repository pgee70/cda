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


use i3Soft\CDA\DataType\Collection\Interval\AbstractInterval;
use i3Soft\CDA\DataType\Quantity\PhysicalQuantity\PhysicalQuantity;
use i3Soft\CDA\Elements\DoseQuantity;

/**
 * Trait DoseQuantityTrait
 *
 * @package i3Soft\CDA\Traits
 */
trait DoseQuantityTrait
{
    /** @var DoseQuantity */
    private $doseQuantity;

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderDoseQuantity(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasDoseQuantity()) {
            $el->appendChild($this->getDoseQuantity()->toDOMElement($doc));
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasDoseQuantity(): bool
    {
        return null !== $this->doseQuantity;
    }

    /**
     *
     * @return DoseQuantity
     */
    public function getDoseQuantity(): DoseQuantity
    {
        return $this->doseQuantity;
    }

    /**
     *
     * @param AbstractInterval|PhysicalQuantity $doseQuantity
     *
     * @return self
     */
    public function setDoseQuantity($doseQuantity): self
    {
        if ($doseQuantity instanceof AbstractInterval || $doseQuantity instanceof PhysicalQuantity) {
            $this->doseQuantity = new DoseQuantity($doseQuantity);
        }
        return $this;
    }
}