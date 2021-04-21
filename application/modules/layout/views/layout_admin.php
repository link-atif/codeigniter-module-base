<?php
// ob_start();
error_reporting(0);

$dhtmlxscheduler = false;
$this_class = $this->router->fetch_class();
$this_method = $this->router->fetch_method();
// $method          =   $this->router->fetch_method();
if ($this_class == 'jobscheduler' || $this_class == 'staff' || $this_class == 'scheduler' || $this_class == 'timesheet' || $this_class == 'jobstimesheet' || $this_class == 'leaves' || $this_class == 'oncallscheduler' || $this_class == 'staffdaydata' || $this_class == 'schedule') {
    $dhtmlxscheduler = true;
}


$ci = & get_instance();

$class = $ci->router->fetch_class();
$module = $this->router->fetch_module();
$method = $this->router->fetch_method();

$argument ='';
$q = $_SERVER['REQUEST_URI'];
$q1 = explode('/',$q);
$a = array_search($method,$q1);
if($a !='')
{
$argument = join('/', array_slice($q1,$a +1));

}
// $user_row_data = $this->ion_auth->user()->row();
// $userid = $user_row_data->id;
// $this->load->model('users/users_model');

?> 

<?php
  $this->load->view('layout/layout_header');
  $this->load->view('layout/layout_top_bar');
  $this->load->view($view);
  $this->load->view('layout/layout_footer');
?>