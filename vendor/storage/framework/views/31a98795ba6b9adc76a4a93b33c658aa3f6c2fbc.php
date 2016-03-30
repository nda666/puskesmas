<div class="ui fixed right-navbar inverted teal menu">
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
	<a data-title="Segarkan Data" data-content="Click saya untuk segarkan penghitung"
		class="tooltip refresher icon item">
		<i class="icon refresh"></i>
	</a>
	<div class="right menu">
		<a class="active red item" href="#">
			<i class="icon sign out">
			</i>
			Logout
		</a>
	</div>
</div>