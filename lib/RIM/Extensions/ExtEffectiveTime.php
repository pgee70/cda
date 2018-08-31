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

use i3Soft\CDA\ClinicalDocument as CDA;
use i3Soft\CDA\DataType\Collection\Interval\IntervalOfTime;
use i3Soft\CDA\Elements\AbstractElement;
use i3Soft\CDA\Interfaces\XSITypeInterface;
use i3Soft\CDA\Traits\XSITypeTrait;

/**
 * Class ExtEffectiveTime
 *
 * @package i3Soft\CDA\RIM\Extensions
 */
class ExtEffectiveTime extends AbstractElement implements XSITypeInterface
{
    use XSITypeTrait;
    /** @var IntervalOfTime */
    protected $interval_of_time;


    /**
     * ExtEffectiveTime constructor.
     *
     * @param IntervalOfTime $interval_of_time
     */
    public function __construct(IntervalOfTime $interval_of_time)
    {
        $this->setIntervalOfTime($interval_of_time)
          ->setXSIType(XSITypeInterface::INTERVAL_TIMESTAMP);
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        if ($this->getIntervalOfTime()->hasLow()) {
            $low_el = $doc->createElement(CDA::NS_CDA . 'low');
            $this->getIntervalOfTime()->getLow()->setValueToElement($low_el, $doc);
            $el->appendChild($low_el);
        }
        if ($this->getIntervalOfTime()->hasHigh()) {
            $high_el = $doc->createElement(CDA::NS_CDA . 'high');
            $this->getIntervalOfTime()->getHigh()->setValueToElement($high_el, $doc);
            $el->appendChild($high_el);
        }
        return $el;
    }

    /**
     * @return IntervalOfTime
     */
    public function getIntervalOfTime(): IntervalOfTime
    {
        return $this->interval_of_time;
    }

    /**
     * @param IntervalOfTime $interval_of_time
     *
     * @return ExtEffectiveTime
     */
    public function setIntervalOfTime(IntervalOfTime $interval_of_time): self
    {
        $this->interval_of_time = $interval_of_time;
        return $this;
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'ext:effectiveTime';
    }
}