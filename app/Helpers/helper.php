<?PHP

function tranlateTime($date){
    $time = Carbon\Carbon::parse($date)->format('h A');
    $time = str_replace(['AM', 'PM'], ['صباحًا', 'مساءََ'], $time);

    return $time;
}