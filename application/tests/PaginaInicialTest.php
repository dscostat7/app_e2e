<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;

class PaginaInicialTest extends TestCase
{
    public function testPaginaInicialNaoLogadaDeveSerListagemDeSeries()
    {
        // Arrange
        $host = 'http://localhost:4444/wd/hub';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

        // Act
        $driver->get('http://localhost:8080');

        // Assert
        $h1Locator = WebDriverBy::tagName('h1');
        $textoH1 = $driver
            ->findElement($h1Locator)
            ->getText();

        self::assertSame('Séries', $textoH1);
        
        $driver->close();
    }
}
