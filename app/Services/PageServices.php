<?php
namespace App\Services;

use App\Helpers\PasswordHelper;
use App\Models\Page;
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
                        'size' => $file->getSize(),
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
        
    }

    public function blogLatest()
    {
        return $this->pageRepo->latestPage('blog', 5);
    }

    public function manualLatest()
    {
        return $this->pageRepo->latestPage('manual', 8);
    }

    public function faqLatest()
    {
        return $this->pageRepo->latestPage('faq', 4);
    }
}
?>
