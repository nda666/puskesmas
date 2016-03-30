<div class="ui fixed right-navbar violet inverted menu">
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
			<img class="ui avatar image foto-profil" src="{{ asset(auth()->guard('pegawai')->user()->foto) }}" /> @endif
			<span>{{ auth()->guard('pegawai')->user()->nama }}</span>
			<i class="dropdown icon"></i>
			<div class="menu">
				<a class="item" href="{{ url('dokter/profile')}}">
					<i class="menu-icon user icon"></i>Profil Saya
				</a>
				<a href="{{ url('dokter/logout') }}" class="item">
					<i class="menu-icon sign out icon"></i>Logout
				</a>
			</div>
		</div>
	</div>
</div>
