<div class="ui fixed right-navbar blue inverted menu">
  <a class="sidebar-toggle icon item">
    <i class="sidebar icon"></i>
  </a>
  <a class="left-menu-toggle icon item">
    <i class="sidebar icon"></i>
  </a>
  <div class="right menu">
    <div id="user-dropdown" class="ui item dropdown">
      @if (auth()->guard('pegawai')->user()->foto == null) @if (auth()->guard('pegawai')->user()->jenis_kelamin == 'Laki-Laki')
      <img class="ui avatar image foto-profil" src="{{ url('foto-profil/default-l.jpg') }}" /> @else
      <img class="ui avatar image foto-profil" src="{{ url('foto-profil/default-p.jpg') }}" /> @endif @else
        <?php
        $thumb_foto = \File::name(base_path('public/' . (auth()->guard('pegawai')->user()->foto)));
        $thumb_ex = \File::extension(base_path('public/' . (auth()->guard('pegawai')->user()->foto)));
        $thumb_path = base_path('public/foto-profil/'.'thumb_'.$thumb_foto.'.'.$thumb_ex);
        $thumb_url = asset('foto-profil/'.'thumb_'.$thumb_foto.'.'.$thumb_ex);
        if (\File::exists($thumb_path)){
          echo '<img class="ui avatar image foto-profil" src="'. $thumb_url .'" />';
        } else {
          $img = \Image::make(base_path('public/' . (auth()->guard('pegawai')->user()->foto)))->resize(50, 50);
          $img->save(base_path('public/foto-profil/thumb_'.$thumb_foto.'.'.$thumb_ex));
          echo '<img class="ui avatar image foto-profil" src="'. $thumb_url .'" />';
        }
        ?>
       @endif

      <span>{{ auth()->guard('pegawai')->user()->nama }}</span>
      <i class="dropdown icon"></i>
      <div class="menu">
        <a class="item" href="{{ url('administrasi/profile')}}">
          <i class="menu-icon user icon"></i>Profil Saya
        </a>
        <a href="{{ url('administrasi/logout') }}" class="item">
          <i class="menu-icon sign out icon"></i>Logout
        </a>
      </div>
    </div>
  </div>
</div>
