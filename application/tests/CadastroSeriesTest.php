<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverSelect;
use PHPUnit\Framework\TestCase;

class CadastroSeriesTest extends TestCase
{
    private static WebDriver $driver;

    public static function setUpBeforeClass(): void
    {
        // Arrange
        $host = 'http://localhost:4444/wd/hub';
        self::$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        self::$driver->get('http://0.0.0.0:8080/adicionar-serie');

        self::$driver->findElement(WebDriverBy::id('email'))->sendKeys('email@example.com');
        self::$driver->findElement(WebDriverBy::id('password'))->sendKeys('123')->submit();
    }

    protected function setUp(): void
    {
        self::$driver->get('http://0.0.0.0:8080/adicionar-serie');
    }

    public function testCadastrarNovaSerieDeveRedirecionarParaLista()
    {
        // Act
        $inputNome = self::$driver->findElement(WebDriverBy::id('nome'));
        $inputGenero = self::$driver->findElement(WebDriverBy::id('genre'));
        $inputTemporadas = self::$driver->findElement(WebDriverBy::id('qtd_temporadas'));
        $inputEpisodios = self::$driver->findElement(WebDriverBy::id('ep_por_temporada'));

        $inputNome->sendKeys('Teste');

        $selectGenero = new WebDriverSelect($inputGenero);
        $selectGenero->selectByValue('acao');

        $inputTemporadas->sendKeys('1');
        $inputEpisodios->sendKeys('1');

        $inputEpisodios->submit();

        // Assert
        self::assertSame('http://0.0.0.0:8080/series', self::$driver->getCurrentURL());
        self::assertSame(
            'Série com suas respectivas temporadas e episódios adicionada.',
            trim(self::$driver->findElement(WebDriverBy::cssSelector('div.alert.alert-success'))->getText())
        );
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->close();
    }
}
