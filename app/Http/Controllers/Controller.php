<?php

namespace App\Http\Controllers;

use App\Exceptions\FlowException;
use App\FamilyCard;
use App\Resident;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function throwErrors(array $message = [], $code= 422)
    {
        throw new FlowException($message, $code);
    }

    public function checkRWAbility($model)
    {
        $user = auth()->user();

        $rw = null;
        if ($model instanceof FamilyCard) {
            $rw = $model->rw;
        } elseif ($model instanceof Resident) {
            $rw = $model->familyCard() ? $model->familyCard()->rw : null;
        }

        if (! $user->isAn('Administrator')) {
            if (! is_null($rw) && $rw !== explode(' ', $user->position)[2]) {
                $this->throwErrors([
                    'message' => 'Anda tidak mempunyai hak akses.'
                ]);
            }
        }
    }
}
