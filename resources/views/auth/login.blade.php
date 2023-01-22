@extends('layouts.logout')
<!-- ↑子ビュー指定 -->

@section('content')
<!-- ↑子ビューの＠yeildにここから下の＠endsebtionまでのコードを送る -->

{!! Form::open() !!}
<!-- ↑フォームファサード開始。POST通信で -->

<p>DAWNSNSへようこそ2</p>

{{ Form::label('e-mail') }}
<!-- ↑ラベル名 -->
{{ Form::text('mail',null,['class' => 'input']) }}
<!-- インプットクラス＝input name=mail type=text value=nullと言いう意味 -->
 @if($errors->has('mail'))
 <p>{{ $errors->first('mail') }}</p>
 @endif
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}
 @if($errors->has('password'))
 <p>{{ $errors->first('password') }}</p>
 @endif

{{ Form::submit('ログイン') }}
<!-- ↑ログインボタン -->

<p><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection
