@extends('layouts.app')

@section('cssconf')
<link href="{{ asset('css/bookform.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8 form-wrapper">
                <form action="@yield('actionRoute')" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- imageForm -->
                    <div class="image-wrapper">
                        <img class="image"  src="@yield('image')"/>
                    </div>
                    @yield('inputBookId')
                    @if ($errors->has('bookImagePath'))
                    <div class="alert-danger">{{$errors->first('bookImagePath')}}</div>
                    @endif
                    <div class="form-group row">
                        <div col class="col-md-2 label-wrapper">
                            <label>本の画像：</label>
                        </div>
                        <div class="col-md-10">
                            <input name="bookImagePath" type="file" class="form-control-file">
                        </div>
                    </div>
                    <!-- titleForm -->
                    @if ($errors->has('title'))
                    <div class="alert-danger">{{$errors->first('title')}}</div>
                    @endif
                    <div class="form-group row">
                        <div col class="col-md-2 label-wrapper" >
                            <label class="col-form-label">題名　　：</label>
                        </div>
                        <div class="col-md-10">
                            <input name="title" type="text" class="form-control" value="@yield('inputTitle')">
                        </div>
                    </div>
                    <!-- explanationForm -->
                    @if ($errors->has('body'))
                    <div class="alert-danger">{{$errors->first('body')}}</div>
                    @endif
                    <div class="form-group row">
                        <div col class="col-md-2 label-wrapper" >
                            <label class="col-form-label">説明　　：</label>
                        </div>
                        <div class="col-md-10">
                            <textarea name="body" class="form-control">@yield('inputBody')</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10">
                            <button name="uploadButton" class="btn btn-primary w-100" type="submit">@yield('buttonValue')</button>
                        </div>
                    </div>
                </form>
            </div>  
            <div class="col-md-2">
            </div>
        </div>
    </div>
    
@endsection 
    
@section('jsconf')
    <script src="{{ asset('/js/imagePreview.js') }}"></script>
@endsection