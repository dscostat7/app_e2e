<?php
  
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase
{
  public function testRegisterNewUser {
    // Arrange
    $host = 'http://localhost:4444/wd/hub';
    $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

    // Act
    $inputName = $driver->findElement(WebDriverBy::id('name'));
    $inputEmail = $driver->findElement(WebDriverBy::id('email'));
    $inputPassword = $driver->findElement(WebDriverBy::id('password'));
    
    $inputName->sendKeys('Test Name');
    $inputEmail->sendKeys(md5(time()) . '@example.com');
    $inputPassword->sendKeys('123');
    
    // $inputPassword->sendKeys(WebDriverKeys::ENTER);
    
    $inputPassword->submit();

    // Assert
    self::assertSame('http://0.0.0.0:8080/series', $driver->getCurrentURL());
    self::assertInstanceOf(RemoteWebElement::class, $driver->findElement(WebDriverBy::linkText('Sair')));
    
  }
}
