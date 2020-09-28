<?php
namespace App\Services;

use App\Helpers\PasswordHelper;
use App\Models\Page;
use App\Models\PageGroup;
use App\Repositories\PageRepository;
use App\Services\S3Service;
use Illuminate\Support\Facades\DB;

class PageServices
{
    protected $pageRepo;
    protected $page;
    protected $s3Service;

    public function __construct(PageRepository $pageRepo, Page $page, S3Service $s3Service)
    {
        $this->pageRepo = $pageRepo;
        $this->page = $page;
        $this->s3Service = $s3Service;
    }

    public function createPage($attribute)
    {
        DB::beginTransaction();
        try {                        
            $page = $this->pageRepo->create($attribute);

            if (isset($attribute['groups'])) {
                $groups = json_decode($attribute['groups'], true);
                if (!empty($groups)) {
                    foreach ($groups as $group) {
                        PageGroup::insertOrIgnore([
                            'page_id' => $page->id,
                            'group_id' => $group['id']
                        ]);
                    }
                }
            }

            if (!empty($attribute['image'])) {
                $image = $this->s3Service->store($attribute['image'], 'pages/images');
                $page->image = $image;
                $page->save();
            }

            if (!empty($attribute['files'])) {
                $files = array();
                foreach ($attribute['files'] as $file) {
                    $pathFile = $this->s3Service->store($file, 'pages/files');
                    $files = [
                        'name' => $file->getClientOriginalName(),
                        'path' => $pathFile,
                        'size' => $this->_convertSizeToMB($file->getSize()),
                        'extension' => $file->getClientOriginalExtension()
                    ];
                }
                $page->files = json_encode($files);
                $page->save();
            }

            DB::commit();

            return $page;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updatePage($id, $attribute)
    {
        DB::beginTransaction();
        try {
            
            $page = $this->page->findOrFail($id);
            $page->update($this->_buildDataUpdate($attribute->all()));

            if (isset($attribute['groups'])) {
                $groups = json_decode($attribute['groups'], true);
                if (!empty($groups)) {
                    PageGroup::where('page_id', $page->id)->delete();

                    foreach ($groups as $group) {
                        PageGroup::insertOrIgnore([
                            'page_id' => $page->id,
                            'group_id' => $group['id']
                        ]);
                    }
                }
            }
            
            if (!empty($attribute['image'])) {
                $image = $this->s3Service->store($attribute['image'], 'pages/images');
                $page->image = $image;
                $page->save();
            } else {
                if (!empty($attribute['is_remove_image'])) {
                    
                    $page->image = null;
                    $page->save();
                }                
            }

            if ($attribute->hasFile('files')) {
                $files = array();
                foreach ($attribute['files'] as $file) {
                    $pathFile = $this->s3Service->store($file, 'pages/files');
                    $files = [
                        'name' => $file->getClientOriginalName(),
                        'path' => $pathFile,
                        'size' => $this->_convertSizeToMB($file->getSize()),
                        'extension' => $file->getClientOriginalExtension()
                    ];
                }
                $page->files = json_encode($files);
                $page->save();
            } else {
                if (!empty($attribute['is_remove_file'])) {
                    $page->files = null;
                    $page->save();
                }
            }

            DB::commit();

            return $page;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function _buildDataUpdate($attribute)
    {        
        $update = [
            'type' => $attribute['type'],
            'title' => $attribute['title'],
            'public' => $attribute['public'],            
            'status' => $attribute['status'],
            'url' => $attribute['url'],
            'category_id' => $attribute['category_id'],
            'content' => $attribute['content'],
            'summary' => $attribute['summary']
        ];
        if (!empty($attribute['public_date']) && $attribute['public_date'] != 'null') {
            $update['public_date'] = $attribute['public_date'];
        }
        return $update;
    }

    public function rating($id, $params)
    {
        if (!empty($params['type'])) {
            if ($params['type'] == 'download') {
                $update = $this->page::where('id', $id)->update([
                    'downloads' => DB::raw("`downloads`+1")
                ]);                
            }
            if ($params['type'] == 'view') {
                $this->page::where('id', $id)->update([
                    'views' => DB::raw('views + 1')
                ]);
            }
            return true;
        }
        return false;
    }
    
    protected function _convertSizeToMB($size)
    {
        try {
            $size = number_format($size / 1048576, 2);            
            return $size . ' MB';
        } catch (\Exception $e) {
            return '0 MB';
        }
    }
}
?>
