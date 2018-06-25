<?php
namespace RGiordano\DomParser;

class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return SimpleHtmlDom::class;
    }
}