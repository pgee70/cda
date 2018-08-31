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


namespace i3Soft\CDA\Elements;


use i3Soft\CDA\DataType\Code\CodedValue;

class Name extends Code
{

    /** @noinspection ReturnTypeCanBeDeclaredInspection */
    /**
     * @param string $code
     * @param string $displayName
     *
     * @return self
     *
     */

    public static function NCTIS(string $code, string $displayName)
    {
        return new self(new CodedValue($code, $displayName, '1.2.36.1.2001.1001.101', 'NCTIS Data Components'));
    }
    /** @noinspection ReturnTypeCanBeDeclaredInspection */

    /**
     * @param string $code
     * @param string $displayName
     *
     * @return self
     */
    public static function SNOMED(string $code, string $displayName)
    {
        return new self(new CodedValue($code, $displayName, '2.16.840.1.113883.6.96', 'SNOMED CT'));
    }

    /**
     * @inheritDoc
     */
    public function getElementTag(): string
    {
        return 'name';
    }

}