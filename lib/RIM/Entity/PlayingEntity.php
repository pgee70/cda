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


namespace i3Soft\CDA\RIM\Entity;


use i3Soft\CDA\Elements\AbstractElement;
use i3Soft\CDA\Elements\Code;
use i3Soft\CDA\Interfaces\ClassCodeInterface;
use i3Soft\CDA\Traits\ClassCodeTrait;
use i3Soft\CDA\Traits\CodeTrait;
use i3Soft\CDA\Traits\DescTrait;
use i3Soft\CDA\Traits\DeterminerCodeTrait;
use i3Soft\CDA\Traits\NamesTrait;
use i3Soft\CDA\Traits\QuantitiesTrait;
use i3Soft\CDA\Traits\SpecimenPlayingEntityTrait;

/**
 * Class PlayingEntity
 *
 * @package i3Soft\CDA\RIM\Entity
 */
class PlayingEntity extends AbstractElement implements ClassCodeInterface
{
    use CodeTrait;
    use QuantitiesTrait;
    use NamesTrait;
    use DescTrait;
    use SpecimenPlayingEntityTrait;
    use ClassCodeTrait;
    use DeterminerCodeTrait;

    /**
     * PlayingEntity constructor.
     *
     * @param null $code
     */
    public function __construct($code = null)
    {
        $this->setAcceptableClassCodes(ClassCodeInterface::EntityClassRoot)
          ->setClassCode(ClassCodeInterface::ENTITY)
          ->setDeterminerCode('');
        if ($code && $code instanceof Code) {
            $this->setCode($code);
        }
    }


    /**
     * Transforms the element into a DOMElement, which will be included
     * into the final CDA XML
     *
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderCode($el, $doc);
        $this->renderQuantities($el, $doc);
        $this->renderNames($el, $doc);
        $this->renderDesc($el, $doc);
        return $el;
    }

    /**
     * get the element tag name
     *
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'playingEntity';
    }
}