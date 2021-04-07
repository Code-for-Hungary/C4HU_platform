<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Projects extends Model
{
    use HasFactory;
    
    
    /**
    * projects-user-skills lista
    * @param integer $limit sor/lap
    * @param string  $orderField rendezés erre a mezőre
    * @param string  $orderDir 'ASC' vagy 'DESC'
    * @param string  $filter '[skillId, skillId,...]'
    * használja a request->input('page') -t is
    * @return paginator object + ->orderField, ->orderDir, ->filter 
    */
    public function paginateOrderFilter(int $limit, string $orderField, string $orderDir, string $filter) {
        $query = \DB::table('projects');
    	$query->leftJoin('users','projects.user_id','=','users.id')
    	      ->leftJoin('project_skills','projects.id','=','project_skills.project_id')
    	      ->leftJoin('skills','project_skills.skill_id','=','skills.id')
    		  ->select('projects.id',
    		     'projects.name',
    		     'projects.avatar',
    		     'projects.description',
    		     'projects.status',
    		     'projects.deadline',
    		     'projects.website',
    			 'users.avatar as user_avatar',
    			 'users.name as user_name',
    			  \DB::raw("GROUP_CONCAT(skills.name SEPARATOR ', ') as `skills`"))
    			 ->groupBy(['projects.id','projects.name','projects.avatar',
    		     	'projects.description','projects.status','users.avatar','users.name'])
    			 ->orderBy($orderField, $orderDir);
   		if ($filter != '[]') {
			$filterArray = JSON_decode($filter);   		
			$query->whereIn('skills.id',$filterArray);
   		}		     
    	$projects = $query->paginate($limit);
    	$projects->orderField = $orderField; 
    	$projects->orderDir = $orderDir;
    	$projects->filter = $filter;
    	return $projects; 
    }
    
    /**
    * project képernyőn megadott adatok tárolása
    * @param User $user
    * @param Request $request
    * @return bool  sikeres vagy nem
    */
    public function saveFormData($user, $request): bool {
		$result = false;
		\DB::transaction(function() use ($user, $request, &$result) {
		    	// tárolás a projects táblába
		        $projectModel = new Projects();
		        $projects->id = $request->input('id',0);
		        $projects->name = $request->input('name','');
		        $projects->description = $request->input('description','');
		        $projects->avatar = $request->input('avatar','');
		        $projects->website = $request->input('website','');
		        $projects->organisation = $request->input('organisation','');
		        $projects->deadline = $request->input('deadline','');
		        $projects->status = $request->input('status','');
		        $projects->user_id = \Auth::user()->id;
		        $projects->save();
		        
		        // tárolás a project_skills táblába
		        $project_skillsModel = new Project_skills();
		        $project_skillsModel->where('project_id','=',$projects->id)->get()->delete();
		        $skills = JSON_decode($request->input('skills','{}'));
		        foreach ($skills as $key => $value) {
			        $project_skillsModel = new Project_skills();
		        	$project_skillsModel->skill_id = $key;
		        	$project_skillsModel->project_id = $user->id;
		        	$project_skillsModel->level = $value;
		        	$project_skillsModel->save();
		        }
		        $result = true;
		});	 // transaction   	
		return $result;    
    }
    
    /**
    * project - project_skills - skills olvasása id alapján
    * @param integer $id   project.id
    * @return object { project record.., user_name, user_avatar, skills:[{id,name},...] }
    */
    public function fullGet(int $id) {
        $project = $this->where('id','=', $id)->first();
		$project->skills = \DB::table('project_skills')
			->leftJoin('skills','project_skills.skill_id','=','skills.id')
			->select(['skills.id as id','skills.name as name'])
			->where('project_skills.project_id','=',$id)
			->get();
		$user = User::where('id','=',$project->user_id)->first();
		if ($user) {
			$project->user_name = $user->name;
			$project->user_avatar = $user->avatar;
		}	
		return $project;
    }
    
}
    
