<?php

use application\Tests\PageObject\PaginaCadastroSeries;
use application\Tests\PageObject\PaginaLogin;
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

        $paginaLogin = new PaginaLogin(self::$driver);
        $paginaLogin->realizaLoginCom('email@example.com', '123');
    }

    public function testCadastrarNovaSerieDeveRedirecionarParaLista()
    {
        $paginaCadastro = new PaginaCadastroSeries(self::$driver);
        $paginaCadastro->preencheNome('Teste')
            ->selecionaGenero('acao')
            ->comTemporadas(1)
            ->comEpisodios(1)
            ->enviaFormulario();

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
