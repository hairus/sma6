@if (session()->has('flash_notif.message'))
  <div class="box-body">
    <div class="alert alert-{{session()->get('flash_notif.level')}}">
      <button type="button" class="close" name="button"></button>
      {!! session()->get('flash_notif.message')!!}
    </div>
  </div>
@endif
