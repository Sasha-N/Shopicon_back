<?php

namespace Roowix\ShopiconApp\Model;

interface EntityStorageInterface
{
    public function takeAll();

    public function insert(array $fields);

    public function delete(array $filter);

    public function update(array $fields, array $filter);
}