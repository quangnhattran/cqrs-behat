<?php

namespace App\Repositories;

use App\Contracts\Crud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

abstract class BaseRepository implements Crud
{
    protected Model $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    /**
     * Set model
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setModel(): void
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get all
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Find by id
     *
     * @param int $id
     * @param array $select
     * @return Model
     * @throws ModelNotFoundException
     */
    public function find(int $id, array $select = ['*']): Model
    {
        return $this->model->findOrFail($id, $select);
    }

    /**
     * Create
     *
     * @param array $attributes
     * @return Model
     * @throws QueryException
     */
    public function create(array $attributes = []): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Update
     *
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes = [])
    {
        if ($result = $this->find($id)) {
            $result->update($attributes);

            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        if ($result = $this->find($id)) {
            return $result->delete();
        }

        return false;
    }

    /**
     * Insert
     *
     * @param array $attributes
     * @return void
     */
    public function insert(array $attributes = [])
    {
        return $this->model->insert($attributes);
    }

    /**
     * Find users by conditions
     *
     * @param array $conditions
     * @param array $select
     * @return void
     */
    public function findByConditions(array $conditions, array $select = ['*'])
    {
        return $this->model->select($select)->where($conditions)->get();
    }

    /**
     * Find user by email
     *
     * @param string $email
     *
     * @return Model
     */
    public function findByEmail(string $email): ?Model
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Trigger static method calls to the model
     *
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     */
    public static function __callStatic(string $method, array $arguments)
    {
        return call_user_func_array([new static(), $method], $arguments);
    }

    /**
     * Trigger method calls to the model
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        return call_user_func_array([$this->model, $method], $arguments);
    }
}
