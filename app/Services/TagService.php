<?php

namespace App\Services;

use App\Contracts\Repositories\TagRepositoryInterface;
use App\Contracts\Services\TagServiceInterface;
use Yajra\DataTables\Facades\DataTables;

class TagService implements TagServiceInterface {

    public function __construct(
        private TagRepositoryInterface $repository
    )
    {
    }

    public function getCount()
    {
        return $this->repository->getCount();
    }

    public function getByID($id)
    {
        return $this->repository->findByID($id);
    }

    public function create(array $data): bool
    {
        return $this->repository->create($data);
    }

    public function update($model, array $data): bool
    {
        return $this->repository->update($model, $data);
    }

    public function delete($model): bool
    {
        return $this->repository->delete($model);
    }

    public function datatables(array $filters)
    {
        $query = $this->repository->query()
            ->filter($filters);
        $data = DataTables::eloquent($query)
            ->editColumn('name', function ($item) {
                return $item->name;
            })
            ->editColumn('created_at', function ($item) {
                return formatDate($item->created_at);
            })
            ->editColumn('updated_at', function ($item) {
                return formatDate($item->updated_at);
            })
            ->addColumn('action', function ($item) {
                return view('components.buttons.edit', ['route' => route('tags.edit', ['tag' => $item])])
                    . ' ' .
                    view('components.buttons.datatables.delete', ['route' => route('tags.delete', ['tag' => $item]), 'key' => $item->id]);
            })
            ->setRowId(function ($item) {
                return 'row-id-' . $item->id;
            });
        return $data->toJson();
    }

    public function getAll()
    {
        return $this->repository->all();
    }
}
