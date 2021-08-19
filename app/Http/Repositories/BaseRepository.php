<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function makeModel()
    {
        $this->model = app()->make($this->model());
    }

    /**
     * @param array $where
     * @param array|string[] $columns
     * @return mixed
     */
    public function findWhere(array $where, array $columns = ['*']): mixed
    {
        return $this->model->where($where)->firstOrFail($columns);
    }

    /**
     * Trigger static method calls to the model
     *
     * @param $method
     * @param $arguments
     *
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array([new static(), $method], $arguments);
    }

    /**
     * Trigger method calls to the model
     *
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        return call_user_func_array([$this->model, $method], $arguments);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model(): string;
}
