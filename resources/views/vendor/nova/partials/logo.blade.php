<?php

if (str_contains(url(''), 'iotkids')) {
    echo '<h1>IoT Kids</h1>';
} elseif (str_contains(url(''), 'iotmaker')) {
    echo '<h1>IoT Maker</h1>';
} elseif (str_contains(url(''), 'fallujahmakerspace')) {
    echo '<h1>Fallujah</h1>';
} elseif (str_contains(url(''), 'maarifmakerspace')) {
    echo '<h1>Maarif</h1>';
} elseif (str_contains(url(''), 'makerchi')) {
    echo '<h1>Makerchi</h1>';
}
elseif (str_contains(url(''), '3dworld')) {
    echo '<h1>3D World</h1>';
} elseif (str_contains(url(''), 'sulimakerspace')) {
    echo '<h1>Suli</h1>';
} elseif (str_contains(url(''), 'erbilmakerspace')) {
    echo '<h1>Erbil</h1>';
} else {
    echo 'You Not A Maker';
}

{{--@if(auth()->user()->email == 'iotkids@makershive.org')--}}
{{--    <h1>IoT Kids</h1>--}}
{{--@endif--}}
