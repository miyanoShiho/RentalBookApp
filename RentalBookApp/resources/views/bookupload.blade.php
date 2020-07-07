@extends('template.bookform')

@section('inputTitle', old('title', ) )

@section('inputBody', old('body','おすすめです！' ))

@section('buttonValue', 'アップロード')