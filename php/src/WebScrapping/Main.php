<?php

namespace Chuva\Php\WebScrapping;

require_once __DIR__ . '/../../vendor/autoload.php';

use OpenSpout\Writer\Common\Creator\WriterEntityFactory;

/**
 * Main do projeto.
 */
class Main {

  /**
   * Run the web scraping process.
   *
   * @return void
   *   Retorna Void.
   */
  public static function run(): void {
    $dom = new \DOMDocument('1.0', 'utf-8');
    $dom->loadHTMLFile(__DIR__ . '/../../assets/origin.html');
    $data = (new Scrapper())->scrap($dom);
    self::escreverExcel($data);
  }

  /**
   * Escreve dados no Excel.
   *
   * @param array $papers
   *   Dados dos papers.
   *
   * @return void
   *   Retorna um void.
   */
  public static function escreverExcel(array $papers): void {
    $escrever = WriterEntityFactory::createXLSXWriter();
    $escrever->openToFile('assets/model.xlsx');

    // Criando as linhas para inserir os dados.
    $headerRow = WriterEntityFactory::createRowFromArray(
      [
        'ID', 'Title', 'Type', 'Author 1', 'Author 1 Instituition',
        'Author 2', 'Author 2 Instituition', 'Author 3', 'Author 3 Instituition',
        'Author 4', 'Author 4 Instituition', 'Author 5', 'Author 5 Instituition',
        'Author 6', 'Author 6 Instituition', 'Author 7', 'Author 7 Instituition',
        'Author 8', 'Author 8 Instituition', 'Author 9', 'Author 9 Instituition',
      ]
    );
    $escrever->addRow($headerRow);
    // Rodando o array papers para inserir os dados.
    foreach ($papers as $paper) {
      $rowData = [
        $paper['id'],
        // Adiciona o ID do projeto.
        $paper['title'],
        // Adiciona o título do projeto.
        $paper['type'],
        // Adiciona o tipo do projeto.
      ];
      // Iterar sobre os autores do artigo e adicionar seus nomes.
      // e instituições aos campos correspondentes.
      foreach ($paper['authors'] as $index => $author) {
        $authorIndex = $index + 1;
        // Índice do autor começa em 1.
        $rowData[] = $author->getName();
        // Adiciona o nome do autor ao array de dados.
        $rowData[] = $author->getInstitution();
        // Adiciona a instituição do autor ao array de dados.
      }
      // Preenchendo campos que não foram preenchidos.
      $maxAuthors = 9;
      $totalAuthors = count($paper['authors']);
      for ($i = $totalAuthors + 1; $i <= $maxAuthors; $i++) {
        $rowData[] = '';
        // Adiciona vazio para o nome do autor caso não exista.
        $rowData[] = '';
        // Adiciona vazio para a instituição do autor caso não exista.
      }
      // Adicionando a linha.
      $row = WriterEntityFactory::createRowFromArray($rowData);
      $escrever->addRow($row);
    }
    $escrever->close();
  }

}
