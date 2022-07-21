<?php

use Alura\E2E\Tests\PageObject\PaginaListagemSeries;
use Alura\E2E\Tests\PageObject\PaginaLogin;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriver;
use PHPUnit\Framework\TestCase;

class PaginaListagemTest extends TestCase
{
    private WebDriver $driver;

    protected function setUp(): void
    {
        $host = 'http://localhost:4444/wd/hub';
        $this->driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
    }

    public function testAlterarNomeDeSeriado()
    {
        // Arrange
        $paginaLogin = new PaginaLogin($this->driver);
        $paginaLogin->realizaLoginCom('email@example.com', '123');

        $paginaListagem = new PaginaListagemSeries($this->driver);
        $paginaListagem->visita();

        // Act
        $nomeSeriadoAlterado = 'Seriado alterado';
        $idSeriado = 2;
        $paginaListagem->clicaEmEditarSerieComId($idSeriado)
            ->defineNomeDaSerieComId($idSeriado, $nomeSeriadoAlterado)
            ->finalizaEdicaoDaSerieComId($idSeriado);

        // Assert
        self::assertSame($nomeSeriadoAlterado, $paginaListagem->nomeSeriado($idSeriado));
    }

    protected function tearDown(): void
    {
        $this->driver->close();
    }
}
