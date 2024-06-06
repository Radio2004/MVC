<?php

namespace Container;

interface ContainerCensoreAction
{
    public function getAll() : array;

    public function add($word) : bool;

    public function edit($id) : bool;

    public function delete($id) : bool;
}