@if($user && $model->id == $user->id)
    @if(!$model->country || !isset($model->options['badges']) || !$model->avatar)
        <div style="padding:10px;margin:10px;border:1px solid #eeeeee;" class="border-r4">
            @php $progressCountry = 1;@endphp
            @if($model->avatar)
                @php $progressCountry += 33;@endphp
            @endif
            @if($model->country)
                @php $progressCountry += 33;@endphp
            @endif
            @if(isset($model->options['badges']) && count($model->options['badges']))
                @php $progressCountry += 33;@endphp
            @endif
            <p class="text-center k-font" style="margin-top:20px;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:18px;" fill="none" viewBox="0 0 24 24" stroke="#636363">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
            Complete your profile
            </p>
            <p class="text-gray">
            <small>{{
                intval( $progressCountry / 30)
            }}/3 completed
            </small>
            </p>
        
                
            <div class="progress" style="margin:2rem;margin-top:1rem;">
                    <div class="progress-bar kt-bg-success" role="progressbar" style="width: {{ $progressCountry}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            <div style="margin:2rem;">
                
            
            @if(!$model->avatar)
                <a href="/profile#info" class="btn btn-line-rounded" style="width:100%;padding: .5em;">
                    <div class="row img-fade-hover">
                        <div class="col-2">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                              </svg>
                        </div>
                        <div class="col-10 text-center">
                        
                            <span class="text-dark">Upload profile picture
                            </span>
                        </div>
                    </div>

                </a>
                <br>
            @endif
            
            @if(!$model->country)
                <a href="/profile#info" class="btn btn-line-rounded" style="width:100%;padding: .5em;">
                    <div class="row img-fade-hover">
                        <div class="col-2">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                              </svg> 
                        </div>
                        <div class="col-10 text-center">
                        
                            <span class="text-dark">Set your country
                            </span>
                        </div>
                    </div>

                </a>
                <br>
                
            @endif
            
            @if(!isset($model->options['badges']))
                <a href="/profile#interests" class="btn btn-line-rounded" style="width:100%;padding: .5em;">
                    <div class="row img-fade-hover">
                        <div class="col-2">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;" fill="none" viewBox="0 0 24 24" stroke="#474747">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"></path>
                              </svg>
                        </div>
                        <div class="col-10 text-center">
                        
                            <span class="text-dark">Choose your services
                        
                        </div>
                    </div>

                </a>
            
            @endif
            <br>
        </div>
    </div>
    
    @endif  
@endif