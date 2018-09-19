<?php

namespace App\Interfaces;

/**
 * Interface IRepository
 * @package App\Interfaces
 */
interface IRepository
{

    /**
     * @param array $with
     * @param int $limit
     * @return mixed
     */
    public function all(array $with = [], $limit = 15);

    /**
     * @param $id
     * @param array $with
     * @return mixed
     */
    public function findById($id, array $with = []);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param bool $active
     * @return mixed
     */
    public function count($active=true);

    /**
     * @param array $data
     * @return mixed
     */
    public function whereFirst(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function whereExists(array $data);

}
