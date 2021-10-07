@if($user && $model->id == $user->id)
@php $countryPostsCount = count($model->myCountryPosts);@endphp
@if($model->country && $countryPostsCount < 3)
<br>
<div style="padding:10px;border:1px solid #eeeeee;" class="">
    <p class="text-center mt-20 k-font">
        <svg xmlns="http://www.w3.org/2000/svg" style="width:18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
          </svg>
    Show us your country
    </p>
    @php $progress = 1;@endphp
    
    @if($countryPostsCount > 1)
        @php $progress = 1 / $countryPostsCount * 100; @endphp
    @endif
   
 
     
    <p class="text-center text-gray" style="margin:0;">
        @php $countLeftDifference =  3 - $countryPostsCount;@endphp
        <small> {{ $countryPostsCount }}/3 completed</small>
    </p>
    <div style="margin:2rem;">
        <div class="progress mb-10 ">
            <div class="progress-bar kt-bg-success" role="progressbar" style="width: {{ $progress}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <p class="text-muted">
        Help others to learn more about <b>{{ $model->country->title}}</b>. <br>  Share <b>3</b> adventure  locations from your country you value the most and give some informative description.
    </p>
    </div>
     
</div>
@endif
@endif