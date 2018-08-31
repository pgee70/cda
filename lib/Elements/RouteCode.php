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

namespace i3Soft\CDA\Elements;

use i3Soft\CDA\DataType\Code\CodedWithEquivalents;

/**
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class RouteCode extends AbstractElement
{
    /**
     *
     * @var CodedWithEquivalents
     */
    protected $code;

    /**
     *
     * @param CodedWithEquivalents $code
     */
    public function __construct(CodedWithEquivalents $code)
    {
        $this->setCode($code);
    }

    /**
     *
     * @return CodedWithEquivalents
     */
    public function getCode(): CodedWithEquivalents
    {
        return $this->code;
    }

    /**
     *
     * @param CodedWithEquivalents $code
     *
     * @return self
     */
    public function setCode(CodedWithEquivalents $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        return $this->createElement($doc, ['code']);
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'routeCode';
    }


}
