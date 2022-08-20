<?php

use App\Models\Branch;

$factory_check = Branch::where('user_id',auth()->user()->id)->where('type','factory')->exists();

return $factory_check;
