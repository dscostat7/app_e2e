<?php

namespace Alura\E2E\Tests\PageObject;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;

class PaginaLogin
{
    private WebDriver $driver;

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
    }

    public function realizaLoginCom(string $email, string $senha): void
    {
        $this->driver->get('http://0.0.0.0:8080/entrar');

        $this->driver
            ->findElement(WebDriverBy::id('email'))
            ->sendKeys($email);

        $this->driver
            ->findElement(WebDriverBy::id('password'))
            ->sendKeys($senha)
            ->submit();
    }
}
