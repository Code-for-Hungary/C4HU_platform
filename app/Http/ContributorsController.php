<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contributors;
use App\Models\Projects;
use App\Models\Profils;
use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ContributorsController extends Controller {
	
	/**
	* a bejelentkezett user jelentkezik önkéntesnek a projektbe
	* @param Request $request
	* @param int $project_id
	*/ 
	public function add(Request $request, int $project_id) {
	    $result = '';
	    $user = \Auth::user();
	    if (!$user) {
	        $result = view('welcome',["msg" => __('contributor.notlogged'), "msgClass" => "alert-danger"]);
	    } else {
	    	// nézzük nem létezik-e már ilyen rekord...
			$old =  new Contributors();
			$old->where('project_id','=',$project_id)
				->where('user_id','=', $user->id)->first();
			if ($old) {
		        $result = view('welcome',["msg" => __('contributor.exists'), "msgClass" => "alert-danger"]);
			} else {	
				$contributor = new Contributors();
				$contributor->project_id = $project_id;
				$contributor->user_id = $user->id;
				$contributor->status = 'appliciant';
				$contributor->save();
				redirect( '/contributors/'.$project_id);
			}
		}
		return $result;	
	}

	/**
	* contributor képenyő
	* @param Request $request
	* @param int $project_id
	* @param int $user_id
	* @return string full HTML page
	*/	
	public function form(Request $request, int $project_id, int $user_id) {
	    $result = '';
	    $user = \Auth::user();
	    if (!$user) {
			$result = $this->show($request, $project_id, $user_id);
		} else {
		    $project = Projects::where('id','=',$project_id)->first();
		    if ($project) {
		    	if ($project->user_id == $user->id) {
		        	$modelContributor = new Contributors();
	    	    	$contributor = $modelContributor->fullGet($project_id, $user_id);
	        		$result = view('contributor',["contributor" => $contributor]);
	        	} else {
					$result = $this->show($request, $project_id, $user_id);
	        	}	
		    } else {
	    	    $result = view('welcome',["msg" => __('contributor.notfound'), "msgClass" => "alert-danger"]);
		    }
		}
	    return $result;
	}

	
	/**
	* profil képernyő tárolása
	* @param Request $request - profil képernyő látható adatai és  skills rejtet mező
	* @return string full HTML page
	*/
	public function save(Request $request): string {
	    $user = \Auth::user();
	    if (!$user) {
	        $result = view('welcome',["msg" => __('contributor.notlogged'), "msgClass" => "alert-danger"]);
	    } else {
			$contributorModel = new Contributors();
			$contributor = $contributorModel->fullGet($request->input('project_id'), 
				$request->input('user_id'));
			if ($contributor->project_user_id != $user->id) {
		        $result = view('welcome',["msg" => __('contributor.accesViolation'), "msgClass" => "alert-danger"]);
			} else {
				if ($contributorModel->saveFormData($user, $request)) {
					$result = $this->indexPaging($request, $contributor->project_id, __('contributor.saved'), 'allert-success');	
				} else {
		    	    $result = view('welcome',["msg" => __('contributot.database error'), "msgClass" => "alert-danger"]);
				}
			}													  
	    }
	    return $result;
	}
	
	
	/**
	* közremüködők Böngésző
	*/	
	public function indexPaging(Request $request, $project_id, string $msg = '', string $msgClass = '')	{
		$oldOrderField = $request->session()->get('contributorsOrder','contributors.user_name');
		$oldOrderDir = $request->session()->get('contributorsOrderDir','ASC');
		$orderField = $request->input('orderfield', $oldOrderField);
		$orderDir = $request->input('orderdir', $oldOrderDir);
		$filter = ['contributors.project_id', '=', (int)$project_id];		
		if ($oldOrderField == $request->input('orderfield')) {
			if ($orderDir == 'ASC') {
				$orderDir = 'DESC';
			} else {
				$orderDir = 'ASC';
			}
		}
		$request->session()->put('contributorsOrder',$orderField);
		$request->session()->put('contributorsOrderDir',$orderDir);
		$project = Projects::where('id','=',$project_id)->first();
		$modelContributors = new Contributors();
		$contributors = $modelContributors->paginateOrderFilter(5, $orderField, $orderDir, $filter);		
	    return view('contributors-index-paging',['contributors' => $contributors,
	    									'project' => $project,
	    									'page' => $request->input('page',''),
	    									'msg' => $msg, 'msgClass' => $msgClass]);
	}
	
	public function profileprojects(Request $request, int $user_id, string $msg = '',  string $msgClass = '') {
		$oldOrderField = $request->session()->get('cprojectsOrder','projects.name');
		$oldOrderDir = $request->session()->get('cprojectsOrderDir','ASC');
		$orderField = $request->input('orderfield', $oldOrderField);
		$orderDir = $request->input('orderdir', $oldOrderDir);
		$filter = ['contributors.user_id', '=', (int)$user_id];		
		if ($oldOrderField == $request->input('orderfield')) {
			if ($orderDir == 'ASC') {
				$orderDir = 'DESC';
			} else {
				$orderDir = 'ASC';
			}
		}
		$orFilter = ['projects.user_id','=',(int)$user_id]; 
		$request->session()->put('cprojectsOrder',$orderField);
		$request->session()->put('cprojectsOrderDir',$orderDir);
		$modelContributors = new Contributors();
		$contributors = $modelContributors->paginateOrderFilter(5, $orderField, $orderDir,
			 $filter, $orFilter);
		$user = User::where('id','=', $user_id)->first();
		if (!$user) {
    	    $result = view('welcome',["msg" => __('contributot.notfound'), "msgClass" => "alert-danger"]);
		} else {			
	    	$result = view('profileprojects',['contributors' => $contributors,
	    									'user' => $user,
	    									'page' => $request->input('page',''),
	    									'msg' => $msg, 'msgClass' => $msgClass]);
		}	    	
		return $result;								
	}
	
	/**
	* contributor adatok megjelenítése
	* @param Request $request  
	* @param int $project_id
	* @param int $user_id
	* @return void
	*/
	public function show(Request $request, int $project_id, int $user_id) {
	    $modelContributor = new Contributors();
	    $contributor = $modelContributor->fullGet($project_id, $user_id);
	    return view('contributorshow',['contributor' => $contributor]);
	}

}
