<?php
/**
 *
 * @package     i3Soft\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://github.com/pgee70/cda
 *
 */


namespace i3Soft\CDA\DataType\Code;

use i3Soft\CDA\DataType\AnyType;

class AssigningAuthorityNameCode extends AnyType
{
  /** @var \string */
  private $assigningAuthorityName;
  /** @var \string */
  private $root;
  /** @var \string */
  private $extension;

  /**
   * @param \DOMElement       $el
   * @param \DOMDocument|NULL $doc
   */
  public function setValueToElement (\DOMElement $el, \DOMDocument $doc)
  {
    if ($this->hasAssigningAuthorityName())
    {
      $el->setAttribute('assigningAuthorityName', $this->getAssigningAuthorityName());
    }

    if ($this->hasRoot())
    {
      $el->setAttribute('root', $this->getRoot());
    }

    if ($this->hasExtension())
    {
      $el->setAttribute('extension', $this->getExtension());
    }
  }

  /**
   * @return bool
   */
  public function hasAssigningAuthorityName (): bool
  {
    return FALSE === empty($this->assigningAuthorityName);
  }

  /**
   * @return string
   */
  public function getAssigningAuthorityName (): string
  {
    return $this->assigningAuthorityName;
  }

  /**
   * @param $assigningAuthorityName
   *
   * @return AssigningAuthorityNameCode
   */
  public function setAssigningAuthorityName ($assigningAuthorityName): self
  {
    $this->assigningAuthorityName = $assigningAuthorityName;
    return $this;
  }

  /**
   * @return bool
   */
  public function hasRoot (): bool
  {
    return FALSE === empty($this->root);
  }

  /**
   * @return string
   */
  public function getRoot (): string
  {
    return $this->root;
  }

  /**
   * @param $root
   *
   * @return AssigningAuthorityNameCode
   */
  public function setRoot ($root): self
  {
    $this->root = $root;
    return $this;
  }

  /**
   * @return bool
   */
  public function hasExtension (): bool
  {
    return FALSE === empty($this->extension);
  }

  /**
   * @return string
   */
  public function getExtension (): string
  {
    return $this->extension;
  }

  /**
   * @param $extension
   *
   * @return AssigningAuthorityNameCode
   */
  public function setExtension ($extension): self
  {
    $this->extension = $extension;
    return $this;
  }
}