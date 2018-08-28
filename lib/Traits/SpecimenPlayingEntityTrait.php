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


namespace PHPHealth\CDA\Traits;


use PHPHealth\CDA\RIM\Entity\SpecimenPlayingEntity;

/**
 * Trait SpecimenPlayingEntityTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait SpecimenPlayingEntityTrait
{
    /** @var SpecimenPlayingEntity */
    private $specimenPlayingEntity;

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderSpecimenPlayingEntity(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasSpecimenPlayingEntity()) {
            $el->appendChild($this->getSpecimenPlayingEntity()->toDOMElement($doc));
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasSpecimenPlayingEntity(): bool
    {
        return null !== $this->specimenPlayingEntity;
    }

    /**
     * @return mixed
     */
    public function getSpecimenPlayingEntity()
    {
        return $this->specimenPlayingEntity;
    }

    /**
     * @param mixed $specimenPlayingEntity
     *
     * @return self
     */
    public function setSpecimenPlayingEntity($specimenPlayingEntity): self
    {
        $this->specimenPlayingEntity = $specimenPlayingEntity;
        return $this;
    }
}