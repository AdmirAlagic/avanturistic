<div style="padding:10px;margin-top:10px;border:1px solid #eee;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;">
    @if(isset($post->map_options['description']))
    <h6 style="border-bottom:1px solid #eee;padding-bottom:5px;">
        <em><span class="text-muted">{{ $post->map_options['description'] }}</span></em>
    </h6>  
    @endif
 

   
        <div class="row">
            
            <div class="col-12  text-center">
                <h6>
                    Coordinates 
                </h6>
                <b>{{ UtilHelper::latLngtoDMS($post->lat,$post->lng) }}</b>
               
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a class="btn btn-dark" style="margin-top:10px;padding:5px;background:#474747;-webkit-border-radius: 4px !important;-moz-border-radius: 4px !important;border-radius: 4px !important;padding-left: 10px; padding-right: 10px; " target="_blank" href="https://www.google.com/maps/search/?api=1&query={{$post->lat}},{{$post->lng}}">
                    <b><span class="text-white">Get Directions</span></b>
                </a>
            </div>
        </div>
        @if(isset($post->map_options['length'] )) 
        <br>
        <div class="row">
            <div class="col-6 text-center">
                    <div class="img-circle" style="width:30px;height:30px;padding-top:3px;margin-left: auto;margin-right: auto;margin-bottom:10px;">
                    <img src="{{ url('/img/route.svg') }}" style="height:22px;margin-left:2px;margin-right:2px;" alt="">
                    </div>
                    <h6 style="line-height: 1.6em;">
                    
                    
                    <span class="text-muted">Length</span>
                </h6>
                &nbsp;&nbsp;{{ $post->map_options['length'] }} <span class="text-gray">km</span>
            </div>
            
            <div class="col-6  text-center">
                <div class="img-circle" style="width:30px;height:30px;padding-top:3px;margin-left: auto;margin-right: auto;margin-bottom:10px;">
                    <img src="{{ url('/img/clock.svg') }}" style="height:22px;margin-left:2px;margin-right:2px;" alt="">
                </div>
                <h6> 
               
               
                <span class="text-muted">
                Duration</span> 
                </h6>
                <h6 class="text-center">
                    
                        <span class="text-muted">Walking:</span>&nbsp;{!! UtilHelper::minutesToHours($post->map_options['length'] / 7 * 60) !!} <br>
                        <span class="text-muted">Driving:</span>&nbsp;&nbsp;&nbsp;{!! UtilHelper::minutesToHours($post->map_options['length'] / 60 * 60)  !!}  <br>
                        @if(isset($post->options['badges']['bicycling']))
                            <span class="text-muted">Bicycling:</span>&nbsp;&nbsp;&nbsp;{!! UtilHelper::minutesToHours($post->map_options['length'] / 20 * 60)  !!}  <br>
                        @endif
 
                    
<!-- 
                    @if(isset($post->options['badges']['gyrocopter']))
                    <span class="text-muted">Flyling(<b>gyrocopter</b>):</span> {!! UtilHelper::minutesToHours($post->map_options['length'] / 120 * 60)  !!}   <br>
                    @endif

                   
 
                    @if(isset($post->options['badges']['rafting']))
                        <span class="text-muted">Paddling(<b>raft</b>):</span> {!! UtilHelper::minutesToHours($post->map_options['length'] / 3 * 60)  !!}<br>
                    @endif
                    
                    @if(isset($post->options['badges']['kayaking']))
                        <span class="text-muted">Paddling(<b>kayak</b>):</span> {!! UtilHelper::minutesToHours($post->map_options['length'] / 5 * 60)  !!} </b> <br>
                    @endif -->
                </h6>

                
   
            </div>
            
            @endif
        </div>
       
      
   
 