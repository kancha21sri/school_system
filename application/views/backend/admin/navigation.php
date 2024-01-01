<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li class="user-pro">

                <?php
                $key = $this->session->userdata('login_type') . '_id';
                $face_file = 'uploads/' . $this->session->userdata('login_type') . '_image/' . $this->session->userdata($key) . '.jpg';
                if (!file_exists($face_file)) {
                    $face_file = 'uploads/default.jpg';
                }
                ?>

                <a href="#" class="waves-effect"><img src="<?php echo base_url() . $face_file; ?>" alt="user-img"
                        class="img-circle"> <span class="hide-menu">

                        <?php
                        $account_type = $this->session->userdata('login_type');
                        $account_id = $account_type . '_id';
                        $name = $this->crud_model->get_type_name_by_id($account_type, $this->session->userdata($account_id), 'name');
                        echo $name;
                        ?>


                        <span class="fa arrow"></span>
                    </span>

                </a>
                <ul class="nav nav-second-level">
                    <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                    <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                    <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                    <li><a href="<?php echo base_url(); ?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </li>


            <!---  Permission for Admin Dashboard starts here ------>
            <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('login_user_id')))->row()->dashboard; ?>
            <?php if ($check_admin_permission == '1'): ?>
                <li> <a href="<?php echo base_url(); ?>admin/dashboard" class="waves-effect"><i
                            class="ti-dashboard p-r-10"></i> <span class="hide-menu">
                            <?php echo get_phrase('Dashboard'); ?>
                        </span></a> </li>
            <?php endif; ?>
            <!---  Permission for Admin Dashboard ends here ------>

            <!---  Permission for Admin Manage Academics starts here ------>
            <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('login_user_id')))->row()->manage_academics; ?>
            <?php if ($check_admin_permission == '1'): ?>
                <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-mortar-board" data-icon="7"></i>
                        <span class="hide-menu">
                            <?php echo get_phrase('Manage Academics'); ?> <span class="fa arrow"></span>
                        </span></a>
                    <ul class=" nav nav-second-level<?php
                    if (
                        $page_name == 'enquiry_category' ||
                        $page_name == 'list_enquiry' ||
                        $page_name == 'club' ||
                        $page_name == 'circular'
                    )
                        echo 'opened active';
                    ?> ">

                        <li class="<?php if ($page_name == 'enquiry_category')
                            echo 'active'; ?>">

                            <a href="<?php echo base_url(); ?>admin/enquiry_category">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu">
                                    <?php echo get_phrase('Equiry Category'); ?>
                                </span>

                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'enquiry')
                            echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>admin/list_enquiry">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu">
                                    <?php echo get_phrase('list_enquiries'); ?>
                                </span>
                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'club')
                            echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>admin/club">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu">
                                    <?php echo get_phrase('school_clubs'); ?>
                                </span>
                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'circular')
                            echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>admin/circular">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu">
                                    <?php echo get_phrase('manage_circular'); ?>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?> <!---  Permission for Admin Manage Academics ends here ------>





            <!---  Permission for Admin Manage Employee starts here ------>
            <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('login_user_id')))->row()->manage_employee; ?>
            <?php if ($check_admin_permission == '1'): ?>

                <li class="staff"> <a href="javascript:void(0);" class="waves-effect"><i data-icon="&#xe006;"
                            class="fa fa-angle-double-right p-r-10"></i> <span class="hide-menu">
                            <?php echo get_phrase('Manage Employees'); ?><span class="fa arrow"></span>
                        </span></a>

                    <ul class=" nav nav-second-level<?php
                    if (
                        $page_name == 'teacher' ||
                        $page_name == 'librarian' || $page_name == 'hrm' ||
                        $page_name == 'accountant' ||
                        $page_name == 'hostel'
                    )
                        echo 'opened active';
                    ?> ">

                        <li class="<?php if ($page_name == 'teacher')
                            echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>admin/teacher">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu">
                                    <?php echo get_phrase('teachers'); ?>
                                </span>
                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'librarian')
                            echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>admin/librarian">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu">
                                    <?php echo get_phrase('librarians'); ?>
                                </span>
                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'accountant')
                            echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>admin/accountant">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu">
                                    <?php echo get_phrase('accountants'); ?>
                                </span>
                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'hostel')
                            echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>admin/hostel">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu">
                                    <?php echo get_phrase('hostel_manager'); ?>
                                </span>
                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'hrm')
                            echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>admin/hrm">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu">
                                    <?php echo get_phrase('human_resources'); ?>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?> <!---  Permission for Admin Manage Employee ends here ------>

            <!---  Permission for Admin Manage Student starts here ------>
            <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('login_user_id')))->row()->manage_student; ?>
            <?php if ($check_admin_permission == '1'): ?>

                <li class="student"> <a href="#" class="waves-effect"><i data-icon="&#xe006;"
                            class="fa fa-users p-r-10"></i> <span class="hide-menu">
                            <?php echo get_phrase('manage_students'); ?><span class="fa arrow"></span>
                        </span></a>

                    <ul class=" nav nav-second-level<?php
                    if (
                        $page_name == 'student_information' ||
                        $page_name == 'view_student' ||
                        $page_name == 'searchStudent'
                    )
                        echo 'opened active has-sub';
                    ?> ">

                        <li class="<?php if ($page_name == 'studentCategory')
                            echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>studentcategory/studentCategory">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu">
                                    <?php echo get_phrase('Student Categories'); ?>
                                </span>
                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'studentHouse')
                            echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>studenthouse/studentHouse">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu">
                                    <?php echo get_phrase('Student House'); ?>
                                </span>
                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'clubActivity')
                            echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>activity/clubActivity">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu">
                                    <?php echo get_phrase('Student Activity'); ?>
                                </span>
                            </a>
                        </li>

                        <li class="<?php if ($page_name == 'socialCategory')
                            echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>socialcategory/socialCategory">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu">
                                    <?php echo get_phrase('Social Category'); ?>
                                </span>
                            </a>
                        </li>


                    </ul>
                </li>
            <?php endif; ?>
            <!---  Permission for Admin Manage Student ends here ------>

            <!---  Permission for Admin Manage Parents starts here ------>
            <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('login_user_id')))->row()->manage_student; ?>
            <?php if ($check_admin_permission == '1'): ?>

                <li class="student">
                    <a href="<?php echo base_url(); ?>admin/parent" class="waves-effect">
                        <i data-icon="&#xe006;" class="fa fa-users p-r-10"></i>
                        <span class="hide-menu">
                            <?php echo get_phrase('manage_parents'); ?><span class="fa arrow"></span>
                        </span>
                    </a>
                </li>
            <?php endif; ?> <!---  Permission for Admin Manage Parents ends here ------>

            <li><a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-bar-chart-o p-r-10"></i> <span
                        class="hide-menu">
                        <?php echo get_phrase('generate_reports'); ?><span class="fa arrow"></span>
                    </span></a>
            </li>

            <?php $checking_level = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->level; ?>
            <?php if ($checking_level == '2'): ?>


                <li class="<?php if ($page_name == 'manage_profile')
                    echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/manage_profile">
                        <i class="fa fa-gears p-r-10"></i>
                        <span class="hide-menu">
                            <?php echo get_phrase('manage_profile'); ?>
                        </span>
                    </a>
                </li>
            <?php endif; ?>

            <li class="">
                <a href="<?php echo base_url(); ?>login/logout">
                    <i class="fa fa-sign-out p-r-10"></i>
                    <span class="hide-menu">
                        <?php echo get_phrase('Logout'); ?>
                    </span>
                </a>
            </li>

        </ul>
    </div>
</div>
<!-- Left navbar-header end -->