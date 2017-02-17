<?php

namespace App\Http\ViewComposers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\View\View;

class SettingsComposer
{
    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Create a new app layout composer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('educationAll', $this->buildIt('education'));
        $view->with('jobs', $this->buildIt('job'));
        $view->with('provinces', $this->buildIt('province'));
        $view->with('districts', $this->buildIt('district'));
        $view->with('subDistricts', $this->buildIt('subDistrict'));
        $view->with('villages', $this->buildIt('village', 7));
        $view->with('disabilities', $this->buildIt('disability', 7));
    }

    public function buildIt($name, $perPage = 5, $baseRoute = null)
    {
        $data = "App\\" . ucfirst($name) . "::all";
        $data = paginate($data(), $perPage, $name, $baseRoute
            ? route('settings.index')
            : $baseRoute
        );

        $appends = collect([
            'education', 'job', 'province', 'district', 'subDistrict', 'village', 'disability',
        ]);

        $appends->each(function($append) use (&$data, $name) {
            if ($append != $name) {
                $data->appends($append, RequestFacade::get($append, 1));
            }
        });

        return $data;
    }
}
