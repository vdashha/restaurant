<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    /*
    * Установить модель.
    *
    * @param Model $model
    * @return void
    */
    public function setModel(string $model): void;


    public function setWith(array $relations = []): self;

    /*
    * Получить все записи.
    *
    * @return Collection
    */
    public function all(): Collection;

    /*
    * Найти запись по ID.
    *
    * @param int $id
    * @return Model|null
    */
    public function find(int $id): ?Model;

    /*
    * Создать новую запись.
    *
    * @param array $data
    * @return Model
    */
    public function create(array $data): Model;

    /*
    * Обновить запись по ID.
    *
    * @param int $id
    * @param array $data
    * @return bool
    */
    public function update(int $id, array $data): bool;

    /*
    * Удалить запись по ID.
    *
    * @param int $id
    * @return bool
    */
    public function delete(int $id): bool;

    /*
    * Получить записи с пагинацией.
    *
    * @param int $perPage
    * @return LengthAwarePaginator
    */
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    /*
    * Применить фильтрацию по заданным параметрам.
    *
    * @param array $filters
    * @return Builder
    */
    public function filter(array $filters): Builder;
}
