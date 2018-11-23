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


use i3Soft\CDA\DataType\Identifier\InstanceIdentifier;

/**
 * Trait InstanceIdentifierTrait
 *
 * @package i3Soft\CDA\Traits
 */
trait InstanceIdentifierTrait
{
  /**
   *
   * @var InstanceIdentifier
   */
  protected $instance_identifier;

  /**
   * @return InstanceIdentifier
   */
  public function getIdentifier (): InstanceIdentifier
  {
    return $this->instance_identifier;
  }

  /**
   * @param InstanceIdentifier $identifier
   *
   * @return self
   */
  public function setIdentifier (InstanceIdentifier $identifier): self
  {
    $this->instance_identifier = $identifier;
    return $this;
  }

  /**
   * @return bool
   */
  public function hasIdentifier (): bool
  {
    return NULL !== $this->instance_identifier;
  }


}