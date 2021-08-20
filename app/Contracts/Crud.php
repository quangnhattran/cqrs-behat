<?php

namespace App\Contracts;

interface Crud
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes = []);

    /**
     * Update
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes = []);

    /**
     * Delete
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}
