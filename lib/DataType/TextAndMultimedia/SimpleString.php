<?php
/**
 * @package     i3Soft\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://github.com/pgee70/cda
 *
 */


namespace i3Soft\CDA\DataType\TextAndMultimedia;


class SimpleString extends BinaryData
{

  /**
   * SimpleString constructor.
   *
   * @param $content
   */
  public function __construct ($content)
  {
    $this->setContent($content);
  }

  /**
   * @param $content
   *
   * @return BinaryData|void
   */
  public function setContent ($content)
  {
    if (!\is_string($content))
    {
      throw new \InvalidArgumentException('the data should be a string, ' . \gettype($content) . ' given.');
    }
    parent::setContent($content);
  }

  /**
   * @return string
   */
  public function getMediaType (): string
  {
    return 'text';
  }
}