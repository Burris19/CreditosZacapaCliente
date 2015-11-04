<?php namespace App\Repositories\Base;

interface BaseInterface {
    public function findOrFail($id);

    public function findWithRelations($id);

    public function findByField($field, $value,$comparator = '=');

    public function create(array $data);

    public function update($entity, array $data);

    public function delete($entity);

    public function getAll();

    public function getWithRelations();

    public function lists($value,$value2);
}
