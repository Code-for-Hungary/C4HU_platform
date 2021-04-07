<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Projects;
use App\Models\Project_skills;
use App\Models\Skills;
use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
	/**
	* profile képenyő (felvitel vagy modosítás)
	* @param Request $request
	* @param int $id  ha 0 akkor új felvitel
	* @return string full HTML page
	*/	
	public function form(Request $request, int $id) {
	    $result = '';
	    $user = \Auth::user();
	    if (!$user) {
	        $result = view('welcome',["msg" => __('profile.notlogged'), "msgClass" => "alert-danger"]);
	    } else {
	        $modelProject = new Projects();
	        if ($id > 0) {
	        	$project = $modelProject->fullGet($id);
	        } else {
				$project = new \stdClass();
				$project->id = 0;	        
				$project->name = '';	        
				$project->description = '';	        
				$project->avatar = '';	        
				$project->organisation = '';	        
				$project->website = '';	        
				$project->deadline = '';	        
				$project->user_id = $user->id;	        
				$project->status = 'plan';
				$project->skills = [];	        
	        }	
			$skills = new \stdClass();
			foreach ($project->skills as $project_skill) {
				$skill_id = $project_skill->id;
				$skills->$skill_id = $project_skill->level;			
			}	        
	        $skillsModel = new Skills();
	        $result = view('project',["project" => $project,
	            "skillsTree" => $skillsModel->getJsonStr(),
	            "skills" => JSON_encode($skills),
	            "back"=> urlencode('/projects?page='.$request->input('page','1'))
	         ]);
	         	    }
	    return $result;
	}
	
	/**
	* project képernyő tárolása
	* @param Request $request - project képernyő látható adatai és  skills rejtet mező
	* @return string full HTML page
	*/
	public function save(Request $request): string {
		
		$validated = $request->validate([
        	'password2' =>  Rule::in([$request->input('password')])
    	]);		
		
	    $user = \Auth::user();
	    if (!$user) {
	        $result = view('welcome',["msg" => __('profile.notlogged'), "msgClass" => "alert-danger"]);
	    } else {
	    	
			// jelszómodosítás
			if ($request->input('password') != '') {
				if ($request->input('password') == $request->input('password2')) {
					$user->password = \Hash::make($request->input('password'));
					$user->save();
				} else {
			        $result = view('welcome',["msg" => __('profile.passwords_not_equals'), "msgClass" => "alert-danger"]);
				}			
			}
			
			$profileModel = new Profiles();
			if ($profileModel->saveFormData($user, $request)) {
		        $result = view('welcome',["msg" => __('profile.saved'), "msgClass" => "alert-success"]);
			} else {
		        $result = view('welcome',["msg" => __('profile.database error'), "msgClass" => "alert-danger"]);
			}
	    }
	    return $result;
	}
	
	/**
	* projektek Böngésző
	* @param Request $request - page paramétert is tartalmazhat
	*/	
	public function indexPaging(Request $request)	{
        $skillsModel = new Skills();
		$skillsTree = $skillsModel->getJsonStr();

		$oldOrderField = $request->session()->get('projectsOrder','users.name');
		$oldOrderDir = $request->session()->get('projectsOrderDir','ASC');
		$orderField = $request->input('orderfield', $oldOrderField);
		$orderDir = $request->input('orderdir', $oldOrderDir);
		$filter = $request->input('filter', $request->session()->get('projectsFilter','[]'));
		if ($oldOrderField == $request->input('orderfield')) {
			if ($orderDir == 'ASC') {
				$orderDir = 'DESC';
			} else {
				$orderDir = 'ASC';
			}
		}
		$request->session()->put('projectsOrder',$orderField);
		$request->session()->put('projectsOrderDir',$orderDir);
		$request->session()->put('projectsFilter',$filter);
		$modelProjects = new Projects();
		$projects = $modelProjects->paginateOrderFilter(5, $orderField, $orderDir, $filter);		
	    return view('project-index-paging',['skillsTree' => $skillsTree,
	    									'projects' => $projects,
	    									'page' => $request->input('page','')]);
	}
	
	/**
	* project adatok megjelenítése
	* @param Request $request   - back paraméter érkezhet
	* @param int $id
	* @return void
	*/
	public function show(Request $request, int $id) {
	        $modelProject = new Projects();
	        $project = $modelProject->fullGet($id);
	        $result = view('projectshow',["project" => $project, 
	                                      "back" => $request->input('back','')]);
	    return $result;
	}
	
}
