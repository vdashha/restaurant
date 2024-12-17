<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var string
     */
    protected string $model;

    protected array  $with = [];

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setWith(array $relations = []): self
    {
        $this->with = $relations;

        return $this;
    }

    public function baseQuery()
    {
        return $this->model::with($this->with);
    }
    /**
     * Получить все записи.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return $this->baseQuery()->all();
    }

    /**
     * Найти запись по ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return  $this->baseQuery()->find($id);
    }

    /**
     * Создать новую запись.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->baseQuery()->create($data);
    }

    /**
     * Обновить запись по ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $record = $this::find($id);

        if ($record) {
            return $record->update($data);
        }

        return false;
    }

    /**
     * Удалить запись по ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $record = $this::find($id);

        if ($record) {
            return $record->delete();
        }

        return false;
    }

    /**
     * Получить записи с пагинацией.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return  $this->baseQuery()->paginate($perPage);
    }

    /**
     * Применить фильтрацию по заданным параметрам.
     *
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filter(array $filters): Builder
    {
        $query = $this->model::newQuery();

        foreach ($filters as $field => $value) {
            if (!empty($value)) {
                $query->where($field, $value);
            }
        }

        return $query;
    }
}
