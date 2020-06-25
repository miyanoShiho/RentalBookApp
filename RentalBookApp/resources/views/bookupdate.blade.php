@extends('layouts.app')

@section('cssconf')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8 form-wrapper">
                <form action="updateSave" method="post" enctype="multipart/form-data" id="bookForm">
                    @csrf
                    <!-- imageForm -->
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-6">
                            <img class="w-100" id="bookImageDisplay"  src="{{$book->book_image_path}}"/>
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                    <input type="hidden" name="hidBookId" value="{{$book->book_id}}">
                    @if ($errors->has('bookImagePath'))
                    <div class="alert-danger">{{$errors->first('bookImagePath')}}</div>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="File">本の画像：</label>
                        <div class="col-md-10">
                            <input id="bookImagePath" name="bookImagePath" type="file" class="form-control-file" id="File">
                        </div>
                    </div>
                    <!-- titleForm -->
                    @if ($errors->has('title'))
                    <div class="alert-danger">{{$errors->first('title')}}</div>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="TITLE">題名：</label>
                        <div class="col-md-10">
                            <input name="title" type="text" class="form-control" id="TITLE" value="{{ old('title', $book->title) }}">
                        </div>
                    </div>
                    <!-- explanationForm -->
                    @if ($errors->has('body'))
                    <div class="alert-danger">{{$errors->first('body')}}</div>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="EXPLANATION">説明：</label>
                        <div class="col-md-10">
                            <textarea name="body" class="form-control" id="EXPLANATION" >{{ old('body', $book->body) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10">
                            <button name="uploadButton" class="btn btn-primary w-100" type="submit">更新</button>
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