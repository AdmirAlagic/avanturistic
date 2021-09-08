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
        <br>
        <button type="submit" class="btn btn-default  submitComment" style="border-radius:8px !important;">
            <i class="fa fa-comment-dots text-muted"></i> Post Comment
        </button>
        <div class="guest-comment-msg">

        </div>
    </div>
</div>
{!! Form::close() !!}