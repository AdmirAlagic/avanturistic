@if($user && $model->id == $user->id)
@php $countryPostsCount = count($model->myCountryPosts);@endphp
@if($model->country && $countryPostsCount < 3)
<br>
<div style="padding:10px;margin:10px;border:1px solid #eeeeee;" class="border-r4">
    <p class="text-center" style="border-bottom:1px solid #eeeeee;">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <path d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z" fill="#666666"/>
            <path d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z" fill="#666666" opacity="0.3"/>
        </g>
    </svg>
    Show us your country
    </p>
    @php $progress = 1;@endphp
    
    @if($countryPostsCount)
        @php $progress = 1 / $countryPostsCount * 100; @endphp
    @endif
 
    <p class="text-muted">
        Help others to learn more about <b>{{ $model->country->title}}</b>. <br>  Share <b>3</b> adventure  locations in your country you value the most and give some informative description.
    </p>    
    <p class="text-center text-gray" style="margin:0;">
        @php $countLeftDifference =  3 - $countryPostsCount;@endphp
         {{ $countryPostsCount }}/3 completed
    </p>
    <div class="progress">
            <div class="progress-bar kt-bg-success" role="progressbar" style="width: {{ $progress}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    
</div>
@endif
@endif