<?php
/**
 * The MIT License
 *
 * Copyright 2017 Julien Fastré <julien.fastre@champs-libres.coop>.
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

namespace PHPHealth\CDA\DataType;

use PHPHealth\CDA\ClinicalDocument as CDA;

/**
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class ReferenceType extends AnyType
{
    /**
     *
     * @var string
     */
    private $reference;

    /**
     * ReferenceType constructor.
     *
     * @param $reference
     */
    public function __construct($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @param \DOMElement       $el
     * @param \DOMDocument|NULL $doc
     */
    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        $el->setAttribute('ID', $this->getReference());
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $doc->createElement(CDA::NS_CDA . 'reference');
        $el->setAttribute(CDA::NS_CDA . 'value', '#' . $this->getReference());

        return $el;
    }
}