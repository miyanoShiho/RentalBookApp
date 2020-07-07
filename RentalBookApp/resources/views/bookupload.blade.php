@extends('template.bookform')

@section('actionRoute', route('bookSave'))

@section('inputTitle', old('title', ) )

@section('inputBody', old('body','おすすめです！' ))

@section('buttonValue', 'アップロード')