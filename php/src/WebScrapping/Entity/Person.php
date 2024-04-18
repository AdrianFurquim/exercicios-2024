<?php

namespace Chuva\Php\WebScrapping\Entity;

/**
 * Paper Author personal information.
 */
class Person {
  /**
   * Name Person.
   *
   * @var string
   */
  public $name;

  /**
   * Istituition Person.
   *
   * @var string
   */
  public $institution;

  /**
   * Constructor.
   *
   * @param string $name
   *   The name's Person.
   * @param string $institution
   *   The institution's Person.
   */
  public function __construct($name, $institution) {
    $this->name = $name;
    $this->institution = $institution;
  }

  /**
   * Get the person's name.
   *
   * @return string
   *   Retorna uma string
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * Set the person's name.
   *
   * @param string $name
   *   Nome Person.
   *
   * @return void
   *   Retorna void.
   */
  public function setName(string $name): void {
    $this->name = $name;
  }

  /**
   * Get the person's institution.
   *
   * @return string
   *   Retorna uma String.
   */
  public function getInstitution(): string {
    return $this->institution;
  }

  /**
   * Set the person's institution.
   *
   * @param string $institution
   *   Intituition Person.
   *
   * @return void
   *   Retorna um void.
   */
  public function setInstitution(string $institution): void {
    $this->institution = $institution;
  }

}
