@extends('template.bookform')

@section('pageTitle','図書編集')

@section('actionRoute', route('updateSave'))

@section('image', $book->book_image_path)

@section('inputBookId')
<input type="hidden" name="hidBookId" value="{{$book->book_id}}">
@endsection

@section('inputTitle', old('title', $book->title) )

@section('inputBody', old('body', $book->body))

@section('buttonValue', '更新')