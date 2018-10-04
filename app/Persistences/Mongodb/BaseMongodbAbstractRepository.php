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

    /**
     * @var
     */
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

    /**
     * @param array $with
     * @param int $limit
     * @return mixed
     */
    public function all(array $with = [], $limit = 15)
    {
        return $this->model->with($with)->paginate($limit);
    }

    /**
     * @param $id
     * @param array $with
     * @return mixed
     */
    public function findById($id, array $with = [])
    {
        return $this->model->with($with)->find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @param bool $active
     * @return mixed
     */
    public function count($active=true)
    {
        $query = $this->model;
        if ($active === true || $active === false) {
            return $query->where('active', $active)->count();
        }
        return $query->count();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function whereFirst(array $data)
    {
        return $this->model->where($data)->get()->first();
    }

    /**
     * Verify is Exists Data
     * @param array $data
     * @return mixed
     */
    public function whereExists(array $data)
    {

        if ($this->model->where($data)->count() > 0)
            return true;
        return false;

    }

}
