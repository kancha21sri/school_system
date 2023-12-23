<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->model('academic_model');                   // Load Apllication Model Here
                $this->load->model('student_model');                    // Load Apllication Model Here
                $this->load->model('exam_question_model');              // Load Apllication Model Here
                $this->load->model('language_model');                   // Load Apllication Model Here
                $this->load->model('admin_model');                      // Load Apllication Model Here
    }

    /**default functin, redirects to login page if no admin logged in yet***/
    public function index() 
	{
    if ($this->session->userdata('admin_login') != 1) redirect(base_url() . 'login', 'refresh');
    if ($this->session->userdata('admin_login') == 1) redirect(base_url() . 'admin/dashboard', 'refresh');
    }
	  /************* / default functin, redirects to login page if no admin logged in yet***/

    /*Admin dashboard code to redirect to admin page if successfull login** */
    function dashboard() {
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / Admin dashboard code to redirect to admin page if successfull login** */


    function manage_profile($param1 = null, $param2 = null, $param3 = null){
    if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
    if ($param1 == 'update') {


        $data['name']   =   $this->input->post('name');
        $data['email']  =   $this->input->post('email');

        $this->db->where('admin_id', $this->session->userdata('admin_id'));
        $this->db->update('admin', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
        redirect(base_url() . 'admin/manage_profile', 'refresh');
       
    }

    if ($param1 == 'change_password') {
        $data['new_password']           =   sha1($this->input->post('new_password'));
        $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));

        if ($data['new_password'] == $data['confirm_new_password']) {
           
           $this->db->where('admin_id', $this->session->userdata('admin_id'));
           $this->db->update('admin', array('password' => $data['new_password']));
           $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
        }

        else{
            $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
        }
        redirect(base_url() . 'admin/manage_profile', 'refresh');
    }

        $page_data['page_name']     = 'manage_profile';
        $page_data['page_title']    = get_phrase('Manage Profile');
        $page_data['edit_profile']  = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('admin_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }


    function enquiry_category($param1 = null, $param2 = null, $param3 = null){

    if($param1 == 'insert'){
   
        $this->crud_model->enquiry_category();

        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');
    }

    if($param1 == 'update'){

       $this->crud_model->update_category($param2);


        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');

        }

    if($param1 == 'delete'){

       $this->crud_model->delete_category($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');

        }

        $page_data['page_name']     = 'enquiry_category';
        $page_data['page_title']    = get_phrase('Manage Category');
        $page_data['enquiry_category']  = $this->db->get('enquiry_category')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    function list_enquiry ($param1 = null, $param2 = null, $param3 = null){


        if($param1 == 'delete')
        {
            $this->crud_model->delete_enquiry($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/list_enquiry', 'refresh');
    
        }

        $page_data['page_name']     = 'list_enquiry';
        $page_data['page_title']    = get_phrase('All Enquiries');
        $page_data['select_enquiry']  = $this->db->get('enquiry')->result_array();
        $this->load->view('backend/index', $page_data);

    }



    function club ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->crud_model->insert_club();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/club', 'refresh');
        }

        if($param1 == 'update'){
            $this->crud_model->update_club($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/club', 'refresh');
        }


        if($param1 == 'delete'){
            $this->crud_model->delete_club($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/club', 'refresh');
    
            }


        $page_data['page_name']     = 'club';
        $page_data['page_title']    = get_phrase('Manage Club');
        $page_data['select_club']  = $this->db->get('club')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    function circular($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_circular();
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/circular', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_circular($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/circular', 'refresh');

        }


        if($param1 == 'delete'){
            $this->crud_model->delete_circular($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/circular', 'refresh');


        }

        $page_data['page_name']         = 'circular';
        $page_data['page_title']        = get_phrase('Manage Circular');
        $page_data['select_circular']   = $this->db->get('circular')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    function librarian($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_librarian();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/librarian', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_librarian($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/librarian', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_librarian($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/librarian', 'refresh');

        }

        $page_data['page_name']         = 'librarian';
        $page_data['page_title']        = get_phrase('Manage Librarian');
        $page_data['select_librarian']   = $this->db->get('librarian')->result_array();
        $this->load->view('backend/index', $page_data);
    }

  

    function accountant($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_accountant();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/accountant', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_accountant($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/accountant', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_accountant($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/accountant', 'refresh');

        }

        $page_data['page_name']         = 'accountant';
        $page_data['page_title']        = get_phrase('Manage Accountant');
        $page_data['select_accountant']   = $this->db->get('accountant')->result_array();
        $this->load->view('backend/index', $page_data);
    }




    function hostel($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_hostel();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/hostel', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_hostel($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/hostel', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_hostel($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/hostel', 'refresh');

        }

        $page_data['page_name']         = 'hostel';
        $page_data['page_title']        = get_phrase('Manage Hostel');
        $page_data['select_hostel']     = $this->db->get('hostel')->result_array();
        $this->load->view('backend/index', $page_data);
    }





    function hrm($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_hrm();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/hrm', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_hrm($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/hrm', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_hrm($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/hrm', 'refresh');

        }

        $page_data['page_name']         = 'hrm';
        $page_data['page_title']        = get_phrase('Manage HRM');
        $page_data['select_hrm']        = $this->db->get('hrm')->result_array();
        $this->load->view('backend/index', $page_data);
    }


    function teacher ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->teacher_model->insetTeacherFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/teacher', 'refresh');
        }

        if($param1 == 'update'){
            $this->teacher_model->updateTeacherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/teacher', 'refresh');
        }


        if($param1 == 'delete'){
            $this->teacher_model->deleteTeacherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/teacher', 'refresh');
    
        }

        $page_data['page_name']     = 'teacher';
        $page_data['page_title']    = get_phrase('Manage Teacher');
        $page_data['select_teacher']  = $this->db->get('teacher')->result_array();
        $this->load->view('backend/index', $page_data);

    }

    function get_designation($department_id = null){

        $designation = $this->db->get_where('designation', array('department_id' => $department_id))->result_array();
        foreach($designation as $key => $row)
        echo '<option value="'.$row['designation_id'].'">' . $row['name'] . '</option>';
    }

    function get_employees($department_id = null)
    {
        $employees = $this->db->get_where('teacher', array('department_id' => $department_id))->result_array();
        foreach($employees as $key => $employees)
            echo '<option value="' . $employees['teacher_id'] . '">' . $employees['name'] . '</option>';
    }

    /***********  The function manages school timetable  ***********************/
    function class_routine ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
        $this->class_routine_model->createTimetableFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/listStudentTimetable', 'refresh');
        }

        if($param1 == 'update'){
        
        $this->class_routine_model->updateTimetableFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/listStudentTimetable', 'refresh');
        }

        if($param1 == 'delete'){
        
        $this->db->where('class_routine_id', $param2);
        $this->db->delete('class_routine');
        //$this->class_routine_model->deleteTimetableFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/listStudentTimetable', 'refresh');
        }
    }

    function studentTimetableLoad($class_id){

        $page_data['class_id']  =   $class_id;
        $this->load->view('backend/admin/studentTimetableLoad', $page_data);

    }


    /***********  The function manages academic syllabus ***********************/
    function academic_syllabus ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
        $this->academic_model->createAcademicSyllabus();
        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/academic_syllabus', 'refresh');
    }

    if($param1 == 'update'){
        $this->academic_model->updateAcademicSyllabus($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/academic_syllabus', 'refresh');
    }


    if($param1 == 'delete'){
        $this->academic_model->deleteAcademicSyllabus($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/academic_syllabus', 'refresh');

        }

        $page_data['page_name']     = 'academic_syllabus';
        $page_data['page_title']    = get_phrase('Academic Syllabus');
        $this->load->view('backend/index', $page_data);

    }

    function get_class_subject($class_id){
        $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
            foreach($subjects as $key => $subject)
            {
                echo '<option value="'.$subject['subject_id'].'">'.$subject['name'].'</option>';
            }
    }

    function get_class_section($class_id){
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
            foreach($sections as $key => $section)
            {
                echo '<option value="'.$section['section_id'].'">'.$section['name'].'</option>';
            }
    }


    function download_academic_syllabus($academic_syllabus_code){
        $get_file_name = $this->db->get_where('academic_syllabus', array('academic_syllabus_code' => $academic_syllabus_code))->row()->file_name;
        // Loading download from helper.
        $this->load->helper('download');
        $get_download_content = file_get_contents('uploads/syllabus' . $get_file_name);
        $name = $file_name;
        force_download($name, $get_download_content);
    }

    function get_academic_syllabus ($class_id = null){

        if($class_id == '')
        $class_id = $this->db->get('class')->first_row()->class_id;
        
        $page_data['page_name']     = 'academic_syllabus';
        $page_data['class_id']      = $class_id;
        $page_data['page_title']    = get_phrase('Academic Syllabus');
        $this->load->view('backend/index', $page_data);

    }

    /***********  The function below add, update and delete student from students' table ***********************/
    function new_student ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->student_model->createNewStudent();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/student_information', 'refresh');
        }

        if($param1 == 'update'){
            $this->student_model->updateNewStudent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_information', 'refresh');
        }

        if($param1 == 'delete'){
            $this->student_model->deleteNewStudent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/student_information', 'refresh');

        }

        $page_data['page_name']     = 'new_student';
        $page_data['page_title']    = get_phrase('Manage Student');
        $this->load->view('backend/index', $page_data);

    }


    function student_information(){

        $page_data['page_name']     = 'student_information';
        $page_data['page_title']    = get_phrase('List Student');
        $this->load->view('backend/index', $page_data);
    }


    /**************************  search student function with ajax starts here   ***********************************/
    function getStudentClasswise($class_id){

        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/showStudentClasswise', $page_data);
    }
    /**************************  search student function with ajax ends here   ***********************************/


    function edit_student($student_id){

        $page_data['student_id']      = $student_id;
        $page_data['page_name']     = 'edit_student';
        $page_data['page_title']    = get_phrase('Edit Student');
        $this->load->view('backend/index', $page_data);
    }


    function resetStudentPassword ($student_id) {
        $password['password']               =   sha1($this->input->post('new_password'));
        $confirm_password['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
        if ($password['password'] == $confirm_password['confirm_new_password']) {
           $this->db->where('student_id', $student_id);
           $this->db->update('student', $password);
           $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
        }
        else{
            $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
        }
        redirect(base_url() . 'admin/student_information', 'refresh');
    }

    function manage_attendance($date = null, $month= null, $year = null, $class_id = null, $section_id = null ){
        $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
        
        if ($_POST) {
	
            // Loop all the students of $class_id
            $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
            foreach ($students as $key => $student) {
            $attendance_status = $this->input->post('status_' . $student['student_id']);
            $full_date = $year . "-" . $month . "-" . $date;
            $this->db->where('student_id', $student['student_id']);
            $this->db->where('date', $full_date);
    
            $this->db->update('attendance', array('status' => $attendance_status));
    
                   if ($attendance_status == 2) 
            {
                     if ($active_sms_gateway != '' || $active_sms_gateway != 'disabled') {
                        $student_name   = $this->db->get_where('student' , array('student_id' => $student['student_id']))->row()->name;
                        $parent_id      = $this->db->get_where('student' , array('student_id' => $student['student_id']))->row()->parent_id;
                        $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                        if($parent_id != null && $parent_id != 0){
                            $recieverPhoneNumber = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                            if($recieverPhoneNumber != '' || $recieverPhoneNumber != null){
                                $this->sms_model->send_sms($message, $recieverPhoneNumber);
                            }
                            else{
                                $this->session->set_flashdata('error_message' , get_phrase('Parent Phone Not Found'));
                            }
                        }
                        else{
                            $this->session->set_flashdata('error_message' , get_phrase('SMS Gateway Not Found'));
                        }
                    }
           }
        }
    
            $this->session->set_flashdata('flash_message', get_phrase('Updated Successfully'));
            redirect(base_url() . 'admin/manage_attendance/' . $date . '/' . $month . '/' . $year . '/' . $class_id . '/' . $section_id, 'refresh');
        }

        $page_data['date'] = $date;
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['class_id'] = $class_id;
        $page_data['section_id'] = $section_id;
        $page_data['page_name'] = 'manage_attendance';
        $page_data['page_title'] = get_phrase('Manage Attendance');
        $this->load->view('backend/index', $page_data);

    }

    function attendance_selector(){
        $date = $this->input->post('timestamp');
        $date = date_create($date);
        $date = date_format($date, "d/m/Y");
        redirect(base_url(). 'admin/manage_attendance/' .$date. '/' . $this->input->post('class_id'). '/' . $this->input->post('section_id'), 'refresh');
    }


    function attendance_report($class_id = NULL, $section_id = NULL, $month = NULL, $year = NULL) {
        
        $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
        
        
        if ($_POST) {
        redirect(base_url() . 'admin/attendance_report/' . $class_id . '/' . $section_id . '/' . $month . '/' . $year, 'refresh');
        }
        
        $classes = $this->db->get('class')->result_array();
        foreach ($classes as $key => $class) {
            if (isset($class_id) && $class_id == $class['class_id'])
                $class_name = $class['name'];
            }
                    
        $sections = $this->db->get('section')->result_array();
            foreach ($sections as $key => $section) {
                if (isset($section_id) && $section_id == $section['section_id'])
                    $section_name = $section['name'];
        }
        
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['class_id'] = $class_id;
        $page_data['section_id'] = $section_id;
        $page_data['page_name'] = 'attendance_report';
        $page_data['page_title'] = "Attendance Report:" . $class_name . " : Section " . $section_name;
        $this->load->view('backend/index', $page_data);
    }


    /******************** Load attendance with ajax code starts from here **********************/
	function loadAttendanceReport($class_id, $section_id, $month, $year)
    {
        $page_data['class_id'] 		= $class_id;					// get all class_id
		$page_data['section_id'] 	= $section_id;					// get all section_id
		$page_data['month'] 		= $month;						// get all month
		$page_data['year'] 			= $year;						// get all class year
		
        $this->load->view('backend/admin/loadAttendanceReport' , $page_data);
    }
    /******************** Load attendance with ajax code ends from here **********************/
    

    /******************** print attendance report **********************/
	function printAttendanceReport($class_id=NULL, $section_id=NULL, $month=NULL, $year=NULL)
    {
        $page_data['class_id'] 		= $class_id;					// get all class_id
		$page_data['section_id'] 	= $section_id;					// get all section_id
		$page_data['month'] 		= $month;						// get all month
		$page_data['year'] 			= $year;						// get all class year
		
        $page_data['page_name'] = 'printAttendanceReport';
        $page_data['page_title'] = "Attendance Report";
        $this->load->view('backend/index', $page_data);
    }
    /******************** /Ends here **********************/
    
    function get_class_student($class_id){
        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
            foreach($students as $key => $student)
            {
                echo '<option value="'.$student['student_id'].'">'.$student['name'].'</option>';
            }
    }


    function get_class_mass_student($class_id){

        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
        foreach($students as $key => $student)
        {
            echo '<div class="">
            <label><input type="checkbox" class="check" name="student_id[]" value="' . $student['student_id'] . '">' . '&nbsp;'. $student['name'] .'</label></div>';
        }

        echo '<br><button type ="button" class="btn btn-success btn-sm btn-rounded" onClick="select()">'.get_phrase('Select All').'</button>';
        echo '<button type ="button" class="btn btn-primary btn-sm btn-rounded" onClick="unselect()">'.get_phrase('Unselect All').'</button>';
    }

     /***********  The function below manages school language ***********************/
     function manage_language ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'edit_phrase'){
            $page_data['edit_profile']  =   $param2;
        }

        if($param1 == 'add_language'){
            $this->language_model->createNewLanguage();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        if($param1 == 'add_phrase'){
            $this->language_model->createNewLanguagePhrase();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        if($param1 == 'delete_language'){
            $this->language_model->deleteLanguage($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        $page_data['page_name']     = 'manage_language';
        $page_data['page_title']    = get_phrase('Manage Language');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school language ends here ***********************/

    function updatePhraseWithAjax(){

        $checker['phrase_id']   =   $this->input->post('phraseId');
        $updater[$this->input->post('currentEditingLanguage')]  =   $this->input->post('updatedValue');

        $this->db->where('phrase_id', $checker['phrase_id'] );
        $this->db->update('language', $updater);

        echo $checker['phrase_id']. ' '. $this->input->post('currentEditingLanguage'). ' '. $this->input->post('updatedValue');

    }

    function updateAdminRole($param2){
        $this->admin_model->updateAllDetailsForAdminRole($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/newAdministrator', 'refresh');
    }

}
