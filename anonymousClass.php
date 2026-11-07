<?php
interface HelloWorld
{
    function sayHello(): void;
}


$helloWorld = new class("ahmad") implements HelloWorld 
{
    public string $name;

    public function __construct(string $name){
        $this->name = $name;
    }

    function sayHello(): void{
        echo "Hello Anonymous Class dan Hello {$this->name}" . PHP_EOL;
    }
};


$helloWorld->sayHello();