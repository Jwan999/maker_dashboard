<?php

use App\Models\Product;

//dd($allStudents)

$products = Product::get()->count()

//if ($percentage == 0)
//    $percentage = 'There are no data right nowُ';

?>

<style>
    .text-4xl {
        font-size: 2.25rem;
        line-height: 2.5rem;
    }

    .mt-2 {
        margin-top: 0.5rem;
    }

    .w-20 {
        width: 6rem;
    }

    .py-6 {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .justify-around {
        justify-content: space-around;
    }

    .flex {
        display: flex;
    }
    .h{
        height: 8rem;
    }
</style>
<div class="flex justify-around items-center px-4 py-6 h">
    <div>
        <svg class="w-20" viewBox="0 0 135 134" version="1.1" xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Wireframe" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <path d="M128.081417,20.8431368 L69.7738156,1.40815321 C68.1395959,0.862573066 66.3723788,0.862573066 64.7381591,1.40815321 L6.43055795,20.8431368 C3.18628706,21.9274958 0.999992672,24.9653291 0.999992672,28.3860201 L0.999992672,105.55613 C0.995369441,108.982128 3.18578832,112.02586 6.43585864,113.109615 L64.7434598,132.544599 C66.3778658,133.089031 68.1447103,133.089031 69.7791163,132.544599 L128.086717,113.109615 C131.334693,112.024022 133.522666,108.980722 133.517285,105.55613 L133.517285,28.3860201 C133.517285,24.9639236 131.327782,21.92566 128.081417,20.8431368 Z M68.0934965,42.6952355 C67.5510262,42.8780345 66.9635988,42.8780345 66.4211285,42.6952355 L44.7863581,35.4836454 L99.0760355,16.7616047 L122.486537,24.5642219 L68.0934965,42.6952355 Z M66.4237789,6.43585864 C66.9662492,6.2530597 67.5536766,6.2530597 68.0961469,6.43585864 L90.8096079,14.0052454 L36.5146298,32.7272861 L12.0333884,24.5642219 L66.4237789,6.43585864 Z M6.30068896,105.55613 L6.30068896,28.3860201 C6.30068896,28.3383139 6.31924344,28.2959084 6.32189378,28.2482022 L64.6082922,47.6778851 L64.6082922,126.891412 L8.11352734,108.073959 C7.02982144,107.713013 6.29927401,106.698364 6.30068896,105.55613 Z M128.216584,105.55613 C128.216584,106.697389 127.486528,107.710671 126.403748,108.071308 L69.9089832,126.891412 L69.9089832,47.6778851 L128.195382,28.2508525 C128.195382,28.2959084 128.216584,28.3383139 128.216584,28.3860201 L128.216584,105.55613 Z"
                      id="Shape" stroke="var(--sidebar-icon)" stroke-width="2" fill="var(--sidebar-icon)" fill-rule="nonzero"></path>
                <path d="M28.2455518,99.762475 L17.8005402,96.279921 C16.9010068,95.9802344 15.9099227,96.1832078 15.2006198,96.8123833 C14.4913168,97.4415587 14.171555,98.4013494 14.3617854,99.3302115 C14.5520159,100.259074 15.2233381,101.015891 16.1228715,101.315577 L26.5678831,104.798131 C26.8375246,104.890013 27.1205267,104.936583 27.4053923,104.935956 C28.7066398,104.938199 29.817043,103.995461 30.0259429,102.711089 C30.2348428,101.426717 29.4804395,100.180673 28.2455518,99.7704261 L28.2455518,99.762475 Z"
                      id="Path" stroke="var(--sidebar-icon)" stroke-width="2" fill="var(--sidebar-icon)" fill-rule="nonzero"></path>
            </g>
        </svg>
    </div>
    <div>
        <p>
            Number of products:
        </p>
        <h1 class="text-4xl mt-2">
            {{ $products }}
        </h1>
    </div>
</div>



