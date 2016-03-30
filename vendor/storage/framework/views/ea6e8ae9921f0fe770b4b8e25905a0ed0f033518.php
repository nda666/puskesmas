<div class="ui fixed right-navbar blue inverted menu">
	<a class="sidebar-toggle icon item">
		<i class="sidebar icon">
		</i>
	</a>
	<a class="left-menu-toggle icon item">
		<i class="sidebar icon">
		</i>
	</a>
	<div class="item">
		<b><i class="icon doctor"></i><?php echo e(auth()->guard('pegawai')->user()->nama_pegawai); ?></b>
	</div>
	<div class="right menu">
		<a href="<?php echo e(url('administrasi/logout')); ?>" class="item">
		<i class="menu-icon sign out icon"></i>Logout
	</a>
	</div>
</div>