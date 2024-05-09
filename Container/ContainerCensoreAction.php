<?php

namespace Container;

interface ContainerCensoreAction
{
    public function getAll() : array;

    public function add() : bool;

    public function rename($id) : bool;

    public function delete($id) : bool;
}