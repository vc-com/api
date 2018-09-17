<?php

namespace App\Persistences\Mongodb;

use Exception;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class BaseMongodbAbstractRepository
 * @package App\Persistences\Eloquent
 */
abstract class BaseMongodbAbstractRepository implements BaseAbstractRepository
{

    protected $model;

    /**
     * BaseMongodbAbstractRepository constructor.
     * @param $model
     * @throws Exception
     */
    public function __construct($model)
    {
        if (($model instanceof Model) === false)
            throw new Exception("Model is invalid");
        $this->model = $model;
    }

    public function all(array $with = [], $limit = 15)
    {
        return $this->model->with($with)->paginate($limit);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function count($active=true)
    {
        $query = $this->model;
        if ($active === true || $active === false) {
            return $query->where('active', $active)->count();
        }
        return $query->count();
    }

    public function whereFirst(array $data)
    {
        return $this->model->where($data)->get()->first();
    }

    public function whereExists(array $data)
    {
        return $this->model->where($data)->exists();
    }

}
