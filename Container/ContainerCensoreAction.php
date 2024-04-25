<?php

interface ContainerCensoreAction
{
    public function getAll($connect) : array;

    public function add($connect) : bool;

    public function rename($connect, $id) : bool;

    public function delete($connect, $id) : bool;
}