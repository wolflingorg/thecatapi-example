<?php

namespace tests;

use PHPUnit\Framework\TestCase;

class FacadeTest extends TestCase
{
    public function we_can_call_facade()
    {
        $facade = new Facade($client);

        $facade->images()->search();
        $facade->categories()->get();
        $facade->favourites()->get();
    }
}