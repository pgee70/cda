<?php

/**
 * The MIT License
 *
 * Copyright 2016 Julien Fastré <julien.fastre@champs-libres.coop>.
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

namespace i3Soft\CDA\DataType\TextAndMultimedia;

/**
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class CharacterString extends EncapsuledData
{

    /**
     * CharacterString constructor.
     *
     * @param $content
     */
    public function __construct($content)
    {
        $this->setContent($content);
    }

    /**
     * @param $content
     *
     */
    public function setContent($content)
    {
        if (false === \is_string($content)) {
            throw new \InvalidArgumentException('the data should be a string, ' .
                                                \gettype($content) . ' given.');
        }

        parent::setContent($content);
    }

    /**
     * @return string
     */
    public function getMediaType(): string
    {
        return 'text/plain';
    }
}
