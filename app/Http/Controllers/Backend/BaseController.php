<?php

namespace App\Http\Controllers\Backend;

use App\Enums\CommonStatus;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Traits\BackendTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class BaseController extends Controller
{
    //
    use BackendTrait;
    public array $lang;

    public function __construct()
    {
        $this->lang = array_map(function($item) { return $item['title']; }, config('lang'));
        $this->middleware(function ($request, $next) {
            View::share([
                'status' => $this->getStatus(),
                'lang' => $this->lang,
            ]);
            return $next($request);
        });

        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            if ($event->menu->itemKeyExists('contact_requests') && $unreadContactCount = $this->getUnreadContactCount()) {
                $event->menu->addAfter('contact_requests', [
                    'key' => 'unread_contact_requests',
                    'text' => 'contact_requests',
                    'route' => 'contacts.list',
                    'icon' => 'fas fa-fw fa-address-card',
                    'can' => ['show_list_contacts'],
                    'active' => ['admin/contacts/*'],
                    'label' => $unreadContactCount,
                    'label_color' => 'warning'
                ]);
                $event->menu->remove('contact_requests');
            }
        });
    }

    private function getStatus(): array
    {
        return [
            CommonStatus::Active => trans('label.status.active'),
            CommonStatus::Inactive => trans('label.status.inactive'),
        ];
    }

    /**
     * @return mixed
     */
    function getUnreadContactCount(): mixed
    {
        return Cache::remember(Contact::$backendCacheKey, rand(0, 60), function () {
            return Contact::where('is_read', CommonStatus::Inactive)->count();
        });
    }
}
