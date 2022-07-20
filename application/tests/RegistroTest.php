<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;

class RegistroTest extends TestCase
{
    private static WebDriver $driver;

    public static function setUpBeforeClass(): void
    {
        // Arrange
        $host = 'http://localhost:4444/wd/hub';
        self::$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
    }

    protected function setUp(): void
    {
        self::$driver->get('http://0.0.0.0:8080/novo-usuario');
    }

    public function testQuandoRegistrarNovoUsuarioDeveRedirecionarParaListaDeSeries()
    {
        // Act
        $inputNome = self::$driver->findElement(WebDriverBy::id('name'));
        $inputEmail = self::$driver->findElement(WebDriverBy::id('email'));
        $inputSenha = self::$driver->findElement(WebDriverBy::id('password'));

        $inputNome->sendKeys('Nome Teste');
        $inputEmail->sendKeys(md5(time()) . '@example.com');
        $inputSenha->sendKeys('123');

        $inputSenha->submit();

        // Assert
        self::assertSame('http://0.0.0.0:8080/series', self::$driver->getCurrentURL());
        self::assertInstanceOf(
            RemoteWebElement::class,
            self::$driver->findElement(WebDriverBy::linkText('Sair'))
        );
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->close();
    }
}
