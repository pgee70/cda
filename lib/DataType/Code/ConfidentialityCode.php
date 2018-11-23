<?php
/**
 * The MIT License
 *
 * Copyright 2016 julien.
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

namespace i3Soft\CDA\DataType\Code;

/**
 * @author julien
 */
class ConfidentialityCode
{
  // 	<confidentialityCode code="R" displayName="Restricted" codeSystem="2.16.840.1.113883.5.25" codeSystemName="Confidentiality"/>

  const CODE_SYSTEM      = '2.16.840.1.113883.5.25';
  const CODE_SYSTEM_NAME = 'Confidentiality';

  const RESTRICTED          = 'Restricted';
  const RESTRICTED_KEY      = 'R';
  const NORMAL              = 'Normal';
  const NORMAL_KEY          = 'N';
  const VERY_RESTRICTED     = 'Very Restricted';
  const VERY_RESTRICTED_KEY = 'V';

  /**
   * @param $key
   * @param $displayName
   *
   * @return \i3Soft\CDA\DataType\Code\CodedValue
   */
  public static function create ($key, $displayName): CodedValue
  {
    return new CodedValue(
      $key,
      $displayName,
      self::CODE_SYSTEM,
      self::CODE_SYSTEM_NAME
    );
  }
}
