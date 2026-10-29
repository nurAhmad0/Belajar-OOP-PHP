<?php
class Programmer
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}


class BackendProgrammer extends Programmer {}

class FrontendProgrammer extends Programmer {}

class Company {
    public Programmer $programer;
}