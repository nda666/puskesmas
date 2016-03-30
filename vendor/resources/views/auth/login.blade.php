@extends('layouts.app') @section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column row">
    <h2 class="login-header"><i class="icon users"></i>Halaman Login</h2>
    <form style="width: 100%;" method="POST" action="{{ url('/login') }}" class="ui @if ($data = session('response') || count($errors) > 0) error @endif
            large form">
      {!! csrf_field() !!}
      <div class="ui stacked left aligned segment">
        {{-- ERROR VALIDATION --}}

        <h4 class="ui dividing teal header">Masukkan Data login Anda</h4>

        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="username" placeholder="Username">
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="password" placeholder="Password">
          </div>
        </div>
        <div class="ui segment">
          <div class="field">
            <div class="ui toggle checkbox">
              <input type="checkbox" name="remember" tabindex="0" class="hidden">
              <label>Izinkan saya tetap masuk</label>
            </div>
          </div>
        </div>
        <button type="submit" class="ui fluid large teal submit button"><i class="icon sign in"></i>Login</button>
        @if (count($errors) > 0)
        <div class="ui error message">
          <ul class="list">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif @if ($data = session('response'))

        <div class="ui {{ $data['status'] }} message">
          {!! $data['message' ] !!}
        </div>
        @endif
      </div>

    </form>
  </div>
</div>

</div>
@stop @section('javascript')
<script type="text/javascript">
  $('.ui.toggle.checkbox').checkbox();

</script>
@stop
