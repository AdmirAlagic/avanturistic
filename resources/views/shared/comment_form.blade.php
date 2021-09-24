{!! Form::open(['url' => 'post/comment', 'method' => 'POST', 'id' => 'comment-form']) !!}
<div class="form-group row">
    @if(!$user)

    <div class="col col-12">
      
        <div class="comment-error"></div>
        <div class="row">
            <div class="col-4">
                {!! Form::label('Name * ') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder']) !!}
            </div>
            <div class="col-4">
                {!! Form::label('Email * ') !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' ]) !!}
            </div>

            <div class="col-4">
                {!! Form::label('Website ') !!}
                {!! Form::text('website', null, ['class' => 'form-control', 'placeholder']) !!}
            </div>
        </div>
        <small><span class="text-muted">Your email address will not be published.</span></small>
    </div>
    @endif
    <div class="col-12"><br>

        <div class="description-emoji">
            {!! Form::label('comment') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control','data-emojiable' => 'true','maxlength' => '100', 'rows' => '4', 'placeholder' => 'Type comment']) !!}

        </div>
        {!! Form::hidden('post_id', $post->id, ['id' => 'post_id']) !!}
        
        <button type="submit" class="btn btn-default btn-tall  flex  items-center submitComment" style="border-radius:8px !important;margin-top:10px;">
           
             <svg xmlns="http://www.w3.org/2000/svg" style="width:18px;" class="mr-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
              </svg>
              <span >
                Comment
            </span>
        </button>
        <div class="guest-comment-msg">

        </div>
    </div>
</div>
{!! Form::close() !!}