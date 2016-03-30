<div id="sticky-sidebar" class="ui fixed sticky top vertical inverted menu">  
    <div class="item">
        <div class="header"><i class="icon handicap"></i> Passien</div>
        <div class="menu">
            <a href="<?php echo e(route('pasien')); ?>" class="item">Details</a>
            <a href="<?php echo e(route('pasien/create')); ?>" class="item">Tambah Baru</a>
        </div>
    </div>
    <div class="item">
        <div class="header"><i class="icon treatment"></i> Ruang Konsultasi</div>
        <div class="menu">
            <a href="<?php echo e(route('ruang-konsul')); ?>" class="item">Details</a>
            <a class="item">Input Baru</a>
        </div>
    </div>
</div>