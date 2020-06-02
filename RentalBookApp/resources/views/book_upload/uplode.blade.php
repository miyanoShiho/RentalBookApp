@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <form>
                    <!-- imageForm -->
                    <div class="form-group row">
                        <label class="col-md-2" for="File">本の画像：</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" id="File">
                        </div>
                    </div>
                    <!-- titleForm -->
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="TITLE">題名：</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="TITLE">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="EXPLANATION">説明：</label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="EXPLANATION"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10">
                            <button class="btn btn-primary w-100" type="submit">アップロード</button>
                        </div>
                    </div>
                </form>
            </div>  
            <div class="col-md-2">
            </div>
        </div>
    </div>
@endsection