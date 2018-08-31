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
 * Time: 11:26 PM
 *
 * @package     i3Soft\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://github.com/pgee70/cda
 *
 */


namespace i3Soft\CDA\Elements;

use i3Soft\CDA\DataType\TextAndMultimedia\SimpleString;

/**
 * Class AbstractSimpleElement
 *
 * @package i3Soft\CDA\Elements
 */
abstract class AbstractSimpleElement extends AbstractElement
{

    /** @var SimpleString */
    protected $value;

    /**
     * AbstractSimpleElement constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->setValue(new SimpleString($value));
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);

        $this->getValue()->setValueToElement($el, $doc);

        return $el;
    }

    /**
     * @return SimpleString
     */
    public function getValue(): SimpleString
    {
        return $this->value;
    }

    /**
     * @param SimpleString $value
     *
     * @return AbstractSimpleElement
     */
    public function setValue(SimpleString $value): self
    {
        $this->value = $value;
        return $this;
    }
}