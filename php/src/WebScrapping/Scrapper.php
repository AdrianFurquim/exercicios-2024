<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Scrap data from HTML DOM.
   *
   * @param \DOMDocument $dom
   *   The DOMDocument object.
   *
   * @return array
   *   Scraped data.
   */
  public function scrap(\DOMDocument $dom): array {
    $papers = [];
    $elements = $dom->getElementsByTagName('a');
    // Pegando os elementos dentro das tags <a></a> e incerindo no papers.
    foreach ($elements as $element) {
      $paper = $this->scrapPaper($element);
      if ($paper) {
        $papers[] = $paper;
      }
    }
    return $papers;
  }

  /**
   * Scrap paper data from HTML element.
   *
   * @param \DOMElement $element
   *   Element do próprio DOM.
   *
   * @return \Chuva\Php\WebScrapping\Entity\Paper|null
   *   Retornará um paper com algo escrito ou null.
   */
  private function scrapPaper(\DOMElement $element): ? array {
    // Usando DOMXPath para consultar elementos por classe.
    $xpath = new \DOMXPath($element->ownerDocument);
    // Pegando a classe volume-info.
    $idNodeList = $xpath->query('.//*[@class="volume-info"]', $element);
    // Verificando se existe algum dado no id.
    $id = $idNodeList->length > 0 ? $idNodeList->item(0)->textContent : '';
    // Pegando o Titulo dos projetos.
    $title = $element->getElementsByTagName('h4')->item(0)->textContent;
    // Setando os autores e suas instituições em um array.
    $authors = [];
    $authorsSpan = $element->getElementsByTagName('span');
    foreach ($authorsSpan as $authorSpan) {
      $authorName = $authorSpan->textContent;
      $institution = $authorSpan->getAttribute('title');
      $authors[] = new Person($authorName, $institution);
    }
    // Pegando o Tipo do projeto.
    $presentationType = $element->getElementsByTagName('div')->item(2)->textContent;
    // Teste para outro modo de pegar ID.
    $volumeInfo = $element->getElementsByTagName('div')->item(1)->textContent;
    // Verifica se todos os campos estão preenchidos.
    if ($id !== '' && $title !== '' && $presentationType !== '' && !empty($authors)) {
      // Retorna os dados como um array  com os dados.
      return [
        'id' => $id,
        'title' => $title,
        'type' => $presentationType,
        'authors' => $authors,
      ];
    }
    else {
      // Retorna nulo se algum campo estiver vazio.
      return NULL;
    }
  }

}
