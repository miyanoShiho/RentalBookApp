@extends('template.bookform')

@section('image', $book->book_image_path)

@section('inputTitle', old('title', $book->title) )

@section('inputBody', old('body', $book->body))

@section('buttonValue', '更新')