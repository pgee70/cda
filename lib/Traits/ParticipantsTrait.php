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


use i3Soft\CDA\RIM\Participation\Participant;

trait ParticipantsTrait
{

    /** @var Participant[] */
    private $participants = [];

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderParticipants(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasParticipants()) {
            foreach ($this->getParticipants() as $participant) {
                $el->appendChild($participant->toDOMElement($doc));
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasParticipants(): bool
    {
        return \count($this->participants) > 0;
    }

    /**
     * @return Participant[]
     */
    public function getParticipants(): array
    {
        return $this->participants;
    }

    /**
     * @param Participant[] $participants
     *
     * @return self
     */
    public function setParticipants(array $participants): self
    {
        foreach ($participants as $participant) {
            if ($participant instanceof Participant) {
                $this->addParticipant($participant);
            }
        }
        return $this;
    }

    /**
     * @param Participant $participant
     *
     * @return self
     */
    public function addParticipant(Participant $participant): self
    {
        $this->participants[] = $participant;
        return $this;
    }
}