<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;

class PaginaInicialTest extends TestCase
{
    private static WebDriver $driver;

    public static function setUpBeforeClass(): void
    {
        // Arrange
        $host = 'http://localhost:4444/wd/hub';
        self::$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
    }

    public function testPaginaInicialNaoLogadaDeveSerListagemDeSeries()
    {
        // Act
        self::$driver->get('http://localhost:8080');

        // Assert
        $h1Locator = WebDriverBy::tagName('h1');
        $textoH1 = self::$driver
            ->findElement($h1Locator)
            ->getText();

        self::assertSame('Séries', $textoH1);
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->close();
    }
}
