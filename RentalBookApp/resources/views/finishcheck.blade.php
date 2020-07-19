@extends('template.checkrental')

@section('checkWords')
<p class="h6">上記の内容でよろしければ、確定ボタンを<br>クリックして下さい。</p>
@endsection

@section('underContent')
<div class="button-group">
    <button type="button" onclick="location.href='{{ route('bookdetail', ['book_id' => $book_id])}}'" class="btn btn-danger rounded-pill">キャンセル</button>
    <form action="/rentalFinish/finishCheck" method="post" id="offerForm"　style="display: inline">
        @csrf
        <input type="hidden" name="hidBookId" value="{{$book_id}}">
        <input type="hidden" name="hidTitle" value="{{$title}}">
        <input type="hidden" name="hidUserName" value="{{$offer_user_name}}">
        <button type="submit" class="btn btn-primary rounded-pill">確定</button>
    </form>
</div>
@endsection

