<?php namespace App\Repositories\Base;

use App\Repositories\Base;

abstract class BaseRepo implements BaseInterface {
    protected $repo;
    protected $relations = array();

    public abstract function getModel();


    function __construct()
    {
        $this->relations = $this->getModel()->relations;
    }

    public function findOrFail($id)
    {
        return $this->getModel()
                    ->findOrFail($id);
    }


    public function findByField($field, $value, $comparator = '=')
    {
        return $this->getModel()
                    ->where($field,$comparator,$value)
                    ->get()
                    ->first();
    }


    public function findByField2($field, $value, $comparator = '=')
    {
        return $this->getModel()
            ->where($field,$comparator,$value)
            ->get();
    }


    public function findByFieldAnd($field, $value, $field2, $value2)
    {
        return $this->getModel()
            ->where($field,'=',$value)
            ->where($field2,'!=',$value2)
            ->get()
            ->first();
    }

    public function findByFieldAnd2($field, $value, $field2, $value2)
    {
        return $this->getModel()
            ->where($field,'=',$value)
            ->where($field2,'=',$value2)
            ->get();
    }


    public function findWithRelations($id)
    {
        return $this->getModel()
                    ->with($this->relations)
                    ->find($id);
    }

    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }

    public function update($entity, array $data)
    {
        if(is_numeric($entity))
            $entity = $this->findOrFail($entity);
        $entity->fill($data);
        $entity->save();
        return $entity;
    }

    public function delete($entity)
    {
        if(is_numeric($entity))
            $entity = $this->findOrFail($entity);
        try
        {
            $entity->delete();
            return $entity;
        }
        catch(\Exception $e)
        {
            return null;
        }
    }

    public function getAll()
    {
        return $this->getModel()
                    ->all();
    }

    public function getWithRelations()
    {
        return $this->getModel()
                    ->with($this->relations)
                    ->get();
    }

    public function lists($value, $value2)
    {
        return $this->getModel()
                    ->lists($value,$value2);

    }

}
