<div class="ui fixed right-navbar blue inverted menu">
	<a class="sidebar-toggle icon item">
		<i class="sidebar icon">
		</i>
	</a>
	<a class="left-menu-toggle icon item">
		<i class="sidebar icon">
		</i>
	</a>
	<div id="user-dropdown" class="ui right dropdown item">
		<i class="icon user"></i><?php echo e(auth()->guard('pegawai')->user()->nama); ?>

		<i class="dropdown icon"></i>
		<div class="menu">
			<a class="item" href="<?php echo e(url('administrasi/profile')); ?>">
				<i class="menu-icon user icon"></i>Profil Saya
			</a>
			<a href="<?php echo e(url('administrasi/logout')); ?>" class="item">
				<i class="menu-icon sign out icon"></i>Logout
			</a>
		</div>
	</div>
	
</div>