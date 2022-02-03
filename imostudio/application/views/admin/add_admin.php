<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col">
               <h3 class="page-title">Add Admin</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a>Admin Management</a></li>
                  <li class="breadcrumb-item active">Add User</li>
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
                  <form action="<?= base_url('admin/save') ?>" method="post">
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
                                          <input type="text" name="firstname" placeholder="First Name" class="form-control fname" value="<?php echo set_value('firstname'); ?>">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <input type="text" name="lastname" placeholder="Last Name" class="form-control lname" value="<?php echo set_value('lastname'); ?>">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Password</label>
                              <div class="col-lg-9">
                                 <input type="password" name="admin_pass"  class="form-control" min="6" value="<?php echo set_value('admin_pass'); ?>">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Role</label>
                              <div class="col-lg-9">
                                 <select class="select" name="role" >
                                    <option value>User Role</option>
                                    <option value="admin" <?php echo  set_select('role', 'admin', TRUE); ?>>Admin</option>
                                    <option value="employee" <?php echo  set_select('role', 'employee'); ?>>Employee</option>
                                 </select>
                              </div>
                           </div>
                           
                        </div>
                        <div class="col-xl-6">

                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Email</label>
                              <div class="col-lg-9">
                                 <input type="text" class="form-control admin_id" name="admin_id" value="<?php echo set_value('admin_id'); ?>">
                              </div>
                           </div>
                            <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Confirm Password</label>
                              <div class="col-lg-9">
                                 <input type="password" name="confirm_pass"  class="form-control" min="6" value="<?php echo set_value('confirm_pass'); ?>">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Phone</label>
                              <div class="col-lg-9">
                                 <input type="text" class="form-control Phone" name="phone" value="<?php echo set_value('phone'); ?>">
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