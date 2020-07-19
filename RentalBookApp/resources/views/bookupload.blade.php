@extends('template.bookform')

@section('actionRoute', route('bookSave'))

@section('image', asset('storage/dummyImage.png'))

@section('inputTitle', old('title', ) )

@section('inputBody', old('body','おすすめです！' ))

@section('buttonValue', 'アップロード')