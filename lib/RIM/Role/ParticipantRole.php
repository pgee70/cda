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


namespace i3Soft\CDA\RIM\Role;


use i3Soft\CDA\Interfaces\ClassCodeInterface;
use i3Soft\CDA\RIM\Entity\PlayingDevice;
use i3Soft\CDA\RIM\Entity\PlayingEntity;
use i3Soft\CDA\Traits\AddrsTrait;
use i3Soft\CDA\Traits\CodeTrait;
use i3Soft\CDA\Traits\PlayingDeviceTrait;
use i3Soft\CDA\Traits\PlayingEntityTrait;
use i3Soft\CDA\Traits\ScopingEntityTrait;
use i3Soft\CDA\Traits\TelecomsTrait;

class ParticipantRole extends Role
{
    use CodeTrait;
    use AddrsTrait;
    use TelecomsTrait;
    use PlayingEntityTrait;
    use PlayingDeviceTrait;
    use ScopingEntityTrait;

    public function __construct($entity = null)
    {
        $this->setAcceptableClassCodes(ClassCodeInterface::RoleClassRoot)
          ->setClassCode(ClassCodeInterface::ROLE);
        if ($entity) {
            if ($entity instanceof PlayingEntity) {
                $this->setPlayingEntity($entity);
            } elseif ($entity instanceof PlayingDevice) {
                $this->setPlayingDevice($entity);
            }
        }
    }


    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderIds($el, $doc);
        $this->renderCode($el, $doc);
        $this->renderAddrs($el, $doc);
        $this->renderTelecoms($el, $doc);
        if ($this->hasPlayingEntity()) {
            $this->renderPlayingEntity($el, $doc);
        } elseif ($this->hasPlayingDevice()) {
            $this->renderPlayingDevice($el, $doc);
        }
        $this->renderScopingEntity($el, $doc);
        return $el;
    }

    /**
     * get the element tag name
     *
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'participantRole';
    }
}