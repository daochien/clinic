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
            'release' => $attributes['release'],
            'release_date' => $attributes['release_date'],
            'public' => $attributes['public'],
            'public_destination' => $attributes['public_destination'],
            'category_id' => $attributes['category_id'],
            'owner_id' => Auth::user()->id,
        ]);

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
