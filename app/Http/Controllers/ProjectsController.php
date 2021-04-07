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

class ProjectsController extends Controller
{
	/**
	* project képenyő (felvitel vagy modosítás)
	* @param Request $request
	* @param int $id  ha 0 akkor új felvitel
	* @return string full HTML page
	*/	
	public function form(Request $request, int $id) {
	    $result = '';
	    $user = \Auth::user();
	    if (!$user) {
	        $result = view('welcome',["msg" => __('project.notlogged'), "msgClass" => "alert-danger"]);
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
	            "skills" => JSON_encode($skills)
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
		
		/*		
		$validated = $request->validate([
        	'password2' =>  Rule::in([$request->input('password')])
    	]);
    	*/
    	
		
	    $user = \Auth::user();
	    if (!$user) {
	        $result = view('welcome',["msg" => __('project.notlogged'), "msgClass" => "alert-danger"]);
	    } else {
	    	
	    	// ha modositás (id > 0) akkor csak azt modosithatja, ahol Ő a projektgazda
			
			$projectModel = new Projects();
			if ($projectModel->saveFormData($user, $request)) {
		        $result = view('welcome',["msg" => __('project.saved'), "msgClass" => "alert-success"]);
			} else {
		        $result = view('welcome',["msg" => __('project.database error'), "msgClass" => "alert-danger"]);
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

		$oldOrderField = $request->session()->get('projectsOrder','projects.name');
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
	* @param Request $request   
	* @param int $id
	* @return void
	*/
	public function show(Request $request, int $id) {
	        $modelProject = new Projects();
	        $project = $modelProject->fullGet($id);
	        $result = view('projectshow',["project" => $project]);
	    return $result;
	}
	
}
