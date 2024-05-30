<?php

namespace Container;

interface ContainerEdit
{
    public function getCheckIsExist(): array;

    public function checkMessageExistence(): void;

    public function changeMessage() : void;

    public function build(): array;
}