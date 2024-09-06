<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => ['string', 'max:255'],
            'text' => ['string', 'max:500']
        ];
    }
}
