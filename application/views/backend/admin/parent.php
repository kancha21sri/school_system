<!--Insert Parent Details !-->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><?php echo get_phrase('new_parent');?>
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;ADD NEW PARENT HERE<i class="btn btn-info btn-xs"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div>
            </div>
            <div class="panel-wrapper collapse out" aria-expanded="true">
                <div class="panel-body">
                    <?php echo validation_errors(); ?>
                    <?php echo form_open(base_url() . 'admin/parent/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data' , 'id'=>'parent_add_form' ));?>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-12" for="parent-name-label"><?php echo get_phrase('name');?>*</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="name" id ="name" >
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label  class="col-12" for="parent-email-label"><?php echo get_phrase('email');?>*</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="email" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-12" for="parent-phone-no"><?php echo get_phrase('phone');?>*</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="phone" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-12" for="parent-profession" ><?php echo get_phrase('profession');?>*</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="profession" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-12" for="parent-address"><?php echo get_phrase('address');?>*</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="address" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-12" for="parent-password-label"><?php echo get_phrase('password');?>*</label>
                                <div class="col-12">
                                    <input type="password" class="form-control" name="password" value="">
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <p> * Fields Required</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-rounded btn-block btn-sm"> <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('add_parent');?></button>
                            <img id="install_progress" src="<?php echo base_url() ?>assets/images/loader-2.gif" style="margin-left: 20px; display: none"/>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Display Parent Details !-->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_parents');?>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th><div><?php echo get_phrase('Name');?></div></th>
                            <th><div><?php echo get_phrase('Email');?></div></th>
                            <th><div><?php echo get_phrase('Phone No');?></div></th>
                            <th><div><?php echo get_phrase('Address');?></div></th>
                            <th><div><?php echo get_phrase('Profession');?></div></th>
                            <th><div><?php echo get_phrase('Options');?></div></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($select_parent as $key => $parent){ ?>
                            <tr>
                                <td><?php echo $parent['name'];?></td>
                                <td><?php echo $parent['email'];?></td>
                                <td><?php echo $parent['phone'];?></td>
                                <td><?php echo $parent['address'];?></td>
                                <td><?php echo $parent['profession'];?></td>
                                <td>
                                    <a onclick="#" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/parent/delete/<?php echo $parent['parent_id'];?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        /*
           Validate the Parents Add Form
         */
        $.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z][a-z\s]*$/i.test(value);
        }, "Letters only please");

        $('#parent_add_form').validate({

            onblur: true,
            onkeyup: false,
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                "name": {
                    required: {
                        depends:function(){
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },
                    lettersonly: true
                },
                "email": {
                    required: {
                        depends:function(){
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },
                    email: true
                },
                "phone": {
                    required: {
                        depends:function(){
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },
                    minlength: 10,
                    maxlength: 10,
                    digits: true
                },
                "profession": {
                    required: {
                        depends:function(){
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },
                    lettersonly: true
                },
                "address": {
                    required: {
                        depends:function(){
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },
                },
                "password": {
                    required: true,
                    minlength: 4,
                }
            },
            messages: {
                "name": {
                    required: "Parent Name is Required",
                },
                "email": {
                    required: "Parent Email is required",
                    email: "Invalid email Id"
                },
                "phone": {
                    required: "Parent Phone  No is required",
                    minlength: "Phone No should be a 10-digit number",
                    maxlength: "Phone No should be a 10-digit number",
                    digits: "Phone No should contain only numbers"
                },
                "profession": {
                    required: "Parent Profession is required",
                },
                "address":{
                    required: "Parent Address is required",
                },
                "password":{
                    required: "Password is required",
                    minlength: "Password should be at least 4 characters",
                }
            },

            invalidHandler: function(form, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    $("html, body").animate({
                        scrollTop: $(validator.errorList[0].element).offset().top-1
                    }, 500);
                }
            }
        });
    });
</script>




