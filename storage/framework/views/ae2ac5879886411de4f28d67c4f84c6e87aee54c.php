<div class="ui fixed right-navbar inverted teal menu">
	<a class="sidebar-toggle icon item">
    <i class="sidebar icon"></i>
  </a>
  <a class="left-menu-toggle icon item">
    <i class="sidebar icon"></i>
  </a>
  <div class="right menu">
    <div id="user-dropdown" class="ui item dropdown">
      <?php if(auth()->guard('pegawai')->user()->foto == null): ?> <?php if(auth()->guard('pegawai')->user()->jenis_kelamin == 'Laki-Laki'): ?>
      <img class="ui avatar image foto-profil" src="<?php echo e(url('foto-profil/default-l.jpg')); ?>" /> <?php else: ?>
      <img class="ui avatar image foto-profil" src="<?php echo e(url('foto-profil/default-p.jpg')); ?>" /> <?php endif; ?> <?php else: ?>
      <img class="ui avatar image foto-profil" src="<?php echo e(asset(auth()->guard('pegawai')->user()->foto)); ?>" /> <?php endif; ?>
      <span><?php echo e(auth()->guard('pegawai')->user()->nama); ?></span>
      <i class="dropdown icon"></i>
      <div class="menu">
        <a class="item" href="<?php echo e(url('dokter/profile')); ?>">
          <i class="menu-icon user icon"></i>Profil Saya
        </a>
        <a href="<?php echo e(url('dokter/logout')); ?>" class="item">
          <i class="menu-icon sign out icon"></i>Logout
        </a>
      </div>
    </div>
  </div>
</div>
