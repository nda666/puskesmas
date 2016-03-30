 <?php $__env->startSection('content'); ?>
<div class="ui middle aligned center aligned grid">
  <div class="column row">
    <h2 class="login-header"><i class="icon users"></i>Halaman Login</h2>
    <form style="width: 100%;" method="POST" action="<?php echo e(url('/login')); ?>" class="ui <?php if($data = session('response') || count($errors) > 0): ?> error <?php endif; ?>
            large form">
      <?php echo csrf_field(); ?>

      <div class="ui stacked left aligned segment">
        <?php /* ERROR VALIDATION */ ?>

        <h4 class="ui dividing teal header">Masukkan Data login Anda</h4>

        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="username" placeholder="Username">
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="password" placeholder="Password">
          </div>
        </div>
        <div class="ui segment">
          <div class="field">
            <div class="ui toggle checkbox">
              <input type="checkbox" name="remember" tabindex="0" class="hidden">
              <label>Izinkan saya tetap masuk</label>
            </div>
          </div>
        </div>
        <button type="submit" class="ui fluid large teal submit button"><i class="icon sign in"></i>Login</button>
        <?php if(count($errors) > 0): ?>
        <div class="ui error message">
          <ul class="list">
            <?php foreach($errors->all() as $error): ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?> <?php if($data = session('response')): ?>

        <div class="ui <?php echo e($data['status']); ?> message">
          <?php echo $data['message' ]; ?>

        </div>
        <?php endif; ?>
      </div>

    </form>
  </div>
</div>

</div>
<?php $__env->stopSection(); ?> <?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
  $('.ui.toggle.checkbox').checkbox();

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>