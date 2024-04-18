<?php

namespace Chuva\Php\WebScrapping\Entity;

/**
 * Represents a Paper entity.
 */
class Paper {
  /**
   * Paper Id.
   *
   * @var int
   */
  public $id;

  /**
   * Paper Title.
   *
   * @var string
   */
  public $title;

  /**
   * The paper type (e.g. Poster, Nobel Prize, etc).
   *
   * @var string
   */
  public $type;

  /**
   * Paper authors.
   *
   * @var \Chuva\Php\WebScrapping\Entity\Person[]
   */
  public $authors;

  /**
   * Constructor.
   *
   * @param int $id
   *   The paper's ID.
   * @param string $title
   *   The paper's title.
   * @param string $type
   *   The paper's type.
   * @param array $authors
   *   The paper's authors.
   */
  public function __construct(int $id, string $title, string $type, array $authors = []) {
    $this->id = $id;
    $this->title = $title;
    $this->type = $type;
    $this->authors = $authors;
  }

  /**
   * Get the paper's ID.
   *
   * @return int
   *   Retorna um inteiro representando o ID do artigo.
   */
  public function getId(): int {
    return $this->id;
  }

  /**
   * Set the paper's ID.
   *
   * @param int $id
   *   The paper's ID.
   *
   * @return void
   *   Retorna void indicando que a função não retorna nenhum valor.
   */
  public function setId(int $id): void {
    $this->id = $id;
  }

  /**
   * Get the paper's title.
   *
   * @return string
   *   Retorna uma string representando o título do artigo.
   */
  public function getTitle(): string {
    return $this->title;
  }

  /**
   * Get the paper's type.
   *
   * @return string
   *   Retorna uma string representando o tipo do artigo.
   */
  public function getType(): string {
    return $this->type;
  }

  /**
   * Get the paper's authors.
   *
   * @return \Chuva\Php\WebScrapping\Entity\Person[]
   *   Retorna um array de objetos Person representando os autores do artigo.
   */
  public function getAuthors(): array {
    return $this->authors;
  }

}
