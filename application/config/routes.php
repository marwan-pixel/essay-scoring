<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'essay';
$route['404_override'] = '';
$route['login'] = 'essay/login';
$route['logout'] = 'essay_controller/logout';
$route['loginService'] = 'essay_controller/loginService';
$route['input_soal_esai_uts/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'essay/input_soal_esai_uts/$1/$2/$3/$4/$5';
$route['input_soal_esai_uas/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'essay/input_soal_esai_uas/$1/$2/$3/$4/$5';
$route['dashboard_home_mahasiswa'] = 'essay/dashboard_home_mahasiswa';
$route['melihat_jawaban_esai_dan_nilai_uts/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'essay/melihat_jawaban_esai_dan_nilai_uts/$1/$2/$3/$4/$5';
$route['melihat_jawaban_esai_dan_nilai_uas/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'essay/melihat_jawaban_esai_dan_nilai_uas/$1/$2/$3/$4/$5';
$route['menjawab_soal_esai/(:any)/(:any)/(:any)/(:any)'] = 'essay/menjawab_soal_esai/$1/$2/$3/$4';
$route['input_matkul'] = 'essay_controller/add_data_matkul';
$route['input_soal'] = 'essay_controller/add_data_soal';
$route['simpan_jawaban_esai'] = 'essay_controller/simpan_jawaban_esai';
$route['update_status_soal/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'essay_controller/update_status_soal/$1/$2/$3/$4/$5/$6/$7';
$route['input_mhs'] = 'essay_controller/add_data_mhs';
$route['translate_uri_dashes'] = FALSE;
