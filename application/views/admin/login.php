<div class="content container h-100">
    <style>
        .card{
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
    </style>
    <div class="row align-items-center h-100">
        <div class="col-lg-4 mx-auto px-3 py-3 card">
                <h2>Please login</h2>
                <?php $fattr = array('class' => 'form-signin');
                     echo form_open(base_url().'admin/login/', $fattr); ?>
                <div class="form-group">
                  <?php echo form_password(array(
                      'name'=>'password',
                      'id'=> 'password',
                      'placeholder'=>'Password',
                      'class'=>'form-control',
                      'value'=> set_value('password'))); ?>
                  <?php echo form_error('password') ?>
                </div>
                <?php echo form_submit(array('value'=>'Connect', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
                <?php echo form_close(); ?>
            </div>
    </div>
</div>
