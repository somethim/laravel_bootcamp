<?php

namespace Database\Factories;

use App\Models\StarredMessages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StarredMessagesFactory extends Factory
{
    protected $model = StarredMessages::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
