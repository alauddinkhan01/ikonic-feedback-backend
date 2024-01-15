<?php

namespace App\Repositories;



class BaseRepository
{

    /**
     * return all the User with their perms.
     *
     * @return array
     */
    public function all($model)
    {
        return $model->get();
    }

    public function getPaginated($model, $perPage = 6)
    {
        return $model->paginate($perPage);
    }


    /**
     * return single User according to param ID.
     * @param  $id
     * @return array
     */
    public function find($model, $id)
    {
        return $model->where('id', $id)->first();
    }

    /**
     * return saved User after creating from $data array.
     * @param  $data
     * @return object
     */
    public function save($model, $data)
    {
        return $model->create($data);
    }

    public function insertData($model, $data)
    {
        return $model->insert($data);
    }

    public function deleteAll($model, $column, $toDelete)
    {
        return $model->where($column, $toDelete)->delete();
    }

    /**
     * return updated User after updating from $data array.
     * @param  $data
     *
     * @return object
     */
    public function update($model, $data, $id)
    {
        return $model->where('id', $id)->update($data);
    }

    public function updateOrCreate($model, $data, $column, $id)
    {
        return $model->updateOrCreate(
            [$column => $id],
            $data
        );
    }

    /**
     * delete User from param id with checks of default, automation and status.
     * @param  $id
     * @return -
     */
    public function delete($model, $id)
    {
        return $model->where('id', $id)->delete();
    }
}
