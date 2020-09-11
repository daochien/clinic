<?php

namespace App\Repositories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PageRepository
{

    protected $model;

    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    public function getAll($params = [], $limit = 10)
    {
        $query = $this->model->orderBy('id', 'desc');
        if (!empty($params['type'])) {
            $query->where('type', $params['type']);
        }

        if (!empty($params['status'])) {
            $query->whereStatus($params['status']);
        }

        if (!empty($params['keyword'])) {
            $query->where('title', 'like', '%' . $params['keyword'] . '%');
        }

        if (!empty($params['release_date'])) {

            $rangeDate = json_decode($params['release_date'], true);
            if (!empty($rangeDate['startDate']) && !empty($rangeDate['endDate'])) {
                $dateStart = date_format(date_create($rangeDate['startDate']), 'Y-m-d 00:00:00');
                $dateEnd = date_format(date_create($rangeDate['endDate']), 'Y-m-d 23:59:59');
                $query->where([
                    ['created_at', '>=', $dateStart],
                    ['created_at', '<=', $dateEnd]
                ]);
            }
        }

        return $query->paginate($limit);
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {

        return $this->model->create([
            'title' => $attributes['title'],
            'content' => $attributes['content'],
            'public' => $attributes['public'],
            'public_date' => $attributes['public_date'],
            'status' => $attributes['status'],
            'url' => $attributes['url'],
            'category_id' => $attributes['category_id'],
            'owner_id' => Auth::user()->id,
        ]);

    }

    public function changeStatus($id)
    {
        $page = $this->model->findOrFail($id);
        $page->status = $page->status == 1 ? 0 : 1;
        $page->save();
        return $page;
    }

    public function show($id)
    {
        return $this->model->with('groups')->find($id);
    }

    public function latestPage($type = 'blog', $limit = 5)
    {
        return $this->model->where('type', $type)->orderBy('id', 'desc')->paginate($limit);
    }

    public function getPathUpload($page, $folder = 'images')
    {
        if (!empty($page)) {
            return $page->type.'/'.$page->id.'/'.$folder;
        }
        return 'page/content';
    }

    public function uploadFile($file, $pathFolder)
    {
        try {
            $path = Storage::disk('s3')->put($pathFolder, $file, 'public');
            return Storage::disk('s3')->url($path);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function uploadFiles($files, $pathFolder)
    {
        try {

            $paths = array();
            foreach ($files['files'] as $file) {
                $path = Storage::disk('s3')->put($pathFolder, $file, 'public');
                $path = Storage::disk('s3')->url($path);
                $paths[] = $path;
            }
            return $paths;

        } catch (\Exception $e) {

            return false;
        }
    }

    /**
     * On method call
     * To use Eloquent Methods which are not exist on repository
     *  Example Eloquent findOrFail() method
     *
     * @param $method
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            return Model::__call('setModel', [$this->model])->setTable($this->model->table)->$method(...$arguments);
        } else {
            return $this->model->$method(...$arguments);
        }
    }
}
