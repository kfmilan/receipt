<?php

use Carbon\Carbon;

if(!function_exists("timestampResource")) {
    function timestampResource($obj, bool $withTime = false) {
        $format = !$withTime ? "Y-m-d" : "Y-m-d H:i:s";
        return [
            "created_at" => (new Carbon($obj->created_at))->format($format),
            "updated_at" => (new Carbon($obj->updated_at))->format($format),
        ];
    }
}
