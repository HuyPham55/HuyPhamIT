<?php

namespace App\Services;

use App\Contracts\Repositories\TagRepositoryInterface;
use App\Contracts\Services\TagServiceInterface;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class TagService implements TagServiceInterface
{

    public function __construct(
        private readonly TagRepositoryInterface $repository
    )
    {
    }

    public function getCount()
    {
        return $this->repository->query()->count();
    }

    public function getByID($id)
    {
        return $this->repository->findByID($id);
    }

    public function create(array $data): bool
    {
        DB::beginTransaction();
        try {
            $model = $this->repository->create();
            $this->fillContent($data, $model);
            $model->save();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
        }
    }

    public function update($model, array $data): bool
    {
        DB::beginTransaction();
        try {
            $this->fillContent($data, $model);
            $model->updated_by = $data['updated_by'];
            $model->save();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
        }
    }

    public function delete($model): bool
    {
        DB::beginTransaction();
        try {
            $result = $this->repository->delete($model);
            DB::commit();
            return $result;
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
        }
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

    /**
     * @param array $data
     * @param Tag $model
     * @return void
     */
    public function fillContent(array $data, Tag $model): void
    {
        foreach (config('lang') as $langKey => $langTitle) {
            $title = $data[$langKey]["name"];
            $model->setTranslation('name', $langKey, $title);
            //$model->setTranslation('slug', $langKey, Str::slug($title)); //auto-generated
        }
    }
}
