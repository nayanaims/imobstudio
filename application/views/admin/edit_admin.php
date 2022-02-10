<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col">
               <h3 class="page-title">Edit Admin</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a>Admin Management</a></li>
                  <li class="breadcrumb-item active">Edit User</li>
               </ul>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card mb-0">
               <div class="card-header">
                  <h4 class="card-title mb-0">Create Admin</h4>
               </div>
               
               <div class="card-body">
                  <form action="<?= base_url('admin/Edit') ?>" method="post">
                   <input type="hidden" value="<?= @$id;  ?>" name="id" />
                     <div class="row">
                     	<div class="col-xl-12">
                     	<?php if(validation_errors()){ ?>
                     		<div class="alert alert-danger col-sm-6">
                     	 		<?= validation_errors(); ?>
                     		</div>
                     	<?php } ?>
                     	<span id="message_id"><?php echo $this->session->flashdata('message'); ?></span>
                     	</div>
                        <div class="col-xl-6">
                          
                            <div class="row">
                              <label class="col-lg-3 col-form-label">Name</label>
                              <div class="col-lg-9">
                                 <div class="row">
                                    <div class="col-md-6">
                                    	<!-- echo form_error('firstname', '<div class="error">', '</div>'); -->
                                       <div class="form-group">
                                          <input type="text" name="firstname" placeholder="First Name" class="form-control fname" value="<?= @$result[0]['firstname'] ? $result[0]['firstname'] : set_value('firstname'); ?>">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <input type="text" name="lastname" placeholder="Last Name" class="form-control lname" value="<?= @$result[0]['lastname'] ? $result[0]['lastname'] : set_value('lastname'); ?>">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Password</label>
                              <div class="col-lg-9">
                                 <input type="password" name="admin_pass"  class="form-control" min="6" value="<?= @$result[0]['admin_pass'] ? $result[0]['admin_pass'] : set_value('admin_pass'); ?>">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Role</label>
                              <div class="col-lg-9">
                              	<?php echo $result[0]['role']; ?>
                                 <select class="select" name="role" >
                                    <option value>User Role</option>
                                    <option value="admin" <?php
                                     if(@$result[0]['role'] == 'admin')
                                     	{echo 'selected="selected"';}
                                     else{
                                      echo set_select('role', 'admin', TRUE);
                                       } ?> >Admin</option>
                                    <option value="employee" <?php 
                                    if(@$result[0]['role'] == 'employee'){
                                    	echo 'selected="selected"';}
                                    	else{
                                    	 echo set_select('role', 'employee', TRUE);
                                    } ?>>Employee</option>
                                 </select>
                              </div>
                           </div>
                           
                        </div>
                        <div class="col-xl-6">

                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Email</label>
                              <div class="col-lg-9">
                                 <input type="text" class="form-control admin_id" name="admin_id" value="<?= @$result[0]['admin_id'] ? $result[0]['admin_id'] : set_value('admin_id'); ?>">
                              </div>
                           </div>
                            <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Confirm Password</label>
                              <div class="col-lg-9">
                                 <input type="password" name="confirm_pass"  class="form-control" min="6" value="<?= @$result[0]['confirm_pass'] ? $result[0]['confirm_pass'] : set_value('confirm_pass'); ?>">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Phone</label>
                              <div class="col-lg-9">
                                 <input type="text" class="form-control Phone" name="phone" value="<?= @$result[0]['phone'] ? $result[0]['phone'] : set_value('phone'); ?>">
                              </div>
                           </div>
                           
                        </div>
                     </div>
                     <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /Main Wrapper -->