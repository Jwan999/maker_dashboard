<?php

if (str_contains(url(''), 'iotkids')) {
    echo '<h1>IoT Kids</h1>';
} elseif (str_contains(url(''), 'iotmaker')) {
    echo '<h1>IoT Maker</h1>';
    }
elseif (str_contains(url(''), 'fallujahmakerspace')) {
    echo '<h1>Fallujah</h1>';
}
else{
    echo 'You Not A Maker';
}

{{--@if(auth()->user()->email == 'iotkids@makershive.org')--}}
{{--    <h1>IoT Kids</h1>--}}
{{--@endif--}}
