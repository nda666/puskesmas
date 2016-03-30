<?php if($data = session('response')): ?>
<div <?php if($data['status'] == 'error'): ?> class="ui negative icon message" <?php else: ?> class="ui positive icon message" <?php endif; ?>>
	<?php if($data['status'] == 'error'): ?>
	<i class="icon icons"><i class="icon database"></i><i class="inverted corner warning sign icon"></i></i>
	<?php else: ?>
	<i class="icon icons"><i class="icon database"></i><i class="inverted corner checkmark icon"></i></i>
	<?php endif; ?>
	<i class="close icon"></i>
	<div class="content">
		<div class="header">
			<?php if($data['status'] == 'error'): ?> Error <?php else: ?> Success <?php endif; ?>
		</div>
		<p>
			<?php if($data['message']): ?> <?php echo $data['message']; ?> <?php endif; ?>
		</p>
	</div>
</div>
<?php endif; ?>