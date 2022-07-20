<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverSelect;
use PHPUnit\Framework\TestCase;

class CadastroSeriesTest extends TestCase
{
    public function testCadastrarNovaSer
        $inputGenero = $driver->findElement(WebDriverBy::id('genre'));
        $inputTemporadas = $driver->findElement(WebDriverBy::id('qtd_temporadas'));
        $inputEpisodios = $driver->findElement(WebDriverBy::id('ep_por_temporada'));

        $inputNome->sendKeys('Teste');

        $selectGenero = new WebDriverSelect($inputGenero);
        $selectGenero->selectByValue('acao');

        $inputTemporadas->sendKeys('1');
        $inputEpisodios->sendKeys('1');

        $inputEpisodios->submit();

        // Assert
        self::assertSame('http://0.0.0.0:8080/series', $driver->getCurrentURL());
        self::assertSame(
            'Série com suas respectivas temporadas e episódios adicionada.',
            trim($driver->findElement(WebDriverBy::cssSelector('div.alert.alert-success'))->getText())
        );
    }
}
