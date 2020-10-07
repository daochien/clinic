<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Page;

class checkPageActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $pageId = $request->id;
            $page = Page::findOrFail($pageId);

            if ($page->status == Page::PAGE_STATUS['active']) {
                return $next($request);
            }

            return redirect()->to('/404');
        } catch (\Exception $e) {
            return redirect()->to('/404');
        }
    }
}
