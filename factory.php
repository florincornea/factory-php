<?php

interface CardType
{
    function name();
}

class OnlyTitle implements CardType
{
    function name()
    {
        echo 'card only title';
    }
}

class TitleAndDescription implements CardType
{
    function name()
    {
        echo 'card title and description';
    }
}

class OnlyDescription implements CardType
{
    function name()
    {
        echo 'card only description';
    }
}


class CardFactory
{
    function create($type)
    {
        $classes = get_declared_classes();
        foreach ($classes as $class) {
            $reflect = new ReflectionClass($class);
            if (
                $reflect->implementsInterface('CardType') && 
                ($class == $type )
            ) {

                return new $class();
           }
        }
    }
}

function createCard($type) {
    $cardFactory = new CardFactory();
    return $cardFactory->create($type);
}

createCard('OnlyDescription')->name();
createCard('OnlyTitle')->name();