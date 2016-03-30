<div id="sticky-sidebar" class="ui inverted sticky left fixed top vertical menu">
    
    <div class="ui simple dropdown item">
        <a><i class="icon user"></i> Pasien</a>
        <i class="dropdown icon"></i>
        <div class="menu blue inverted">
            <a href="{{ url('pendaftaran') }}" class="item"><i class="edit icon"></i>Pendaftaran</a>
            <a href="{{ url('pasien') }}" class="item"><i class="search icon"></i>Cari</a>
            <a href="{{ url('tabel/pasien') }}" class="item"><i class="table icon"></i>Tabel</a>
        </div>
    </div>
    <div class="ui simple dropdown item">
        <a><i class="icon doctor"></i> Ruang Konsultasi</a>
        <i class="dropdown icon"></i>
        <div class="menu">
            <a href="{{ route('ruang-konsul') }}" class="item"><i class="list icon"></i>Details</a>
            <a href="{{ route('pasien/create') }}" class="item"><i class="edit icon"></i>Tambah Baru</a>
        </div>
    </div>
    
    <div class="ui simple dropdown item">
        <a><i class="icon file text"></i> Resep Pasien</a>
        <i class="dropdown icon"></i>
        <div class="menu">
            <a href="{{ route('ruang-konsul') }}" class="item"><i class="list icon"></i>Details</a>
            <a href="{{ route('pasien/create') }}" class="item"><i class="edit icon"></i>Tambah Baru</a>
        </div>
    </div>
    
    <a class="item" href="{{ route('ruang-konsul') }}">
    <span class="left"><i class="users icon"></i></span> Data Pegawai</a>

    <a class="item" href="{{ route('ruang-konsul') }}">
    <span class="left"><i class="setting icon"></i></span> Konfigurasi</a>
    
    <a class="item" href="{{ route('ruang-konsul') }}">
    <span class="left"><i class="bar chart icon"></i></span> Report</a>

</div>