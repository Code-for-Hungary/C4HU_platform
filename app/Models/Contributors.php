<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Projects;
use App\Models\User;

class Contributors extends Model
{
    use HasFactory;
    
    /**
    * contributor - project - user lista
    * @param integer $limit sor/lap
    * @param string  $orderField rendezés erre a mezőre
    * @param string  $orderDir 'ASC' vagy 'DESC'
    * @param array   $filter '['fieldName','=',value]'
    * használja a request->input('page') -t is
    * @return paginator object + ->orderField, ->orderDir, ->filter 
    */
    public function paginateOrderFilter(int $limit, string $orderField, string $orderDir, 
    	array $filter, 
    	array $orFilter = ['contributors.project_id','=',0]) {
        $query = \DB::table('projects');
    	$query->leftJoin('contributors','projects.id','=','contributors.project_id')
    		  ->leftJoin('users','contributors.user_id','=','users.id')
    		  ->select(['contributors.project_id',
    		     'contributors.user_id',
    		     'projects.name as project_name',
    		     'projects.avatar as project_avatar',
    		     'projects.status as project_status',
    		     'projects.deadline',
    			 'users.avatar as user_avatar',
    			 'users.name as user_name',
    			 'contributors.status',
    			 'contributors.grade'])
   		      ->orderBy($orderField, $orderDir)
			  ->where($filter[0],$filter[2])
			  ->orWhere($orFilter[0], $orFilter[2]);
    	$records = $query->paginate($limit);
    	$records->orderField = $orderField; 
    	$records->orderDir = $orderDir;
    	$records->filter = $filter;
		for ($i=0; $i<count($records); $i++) {
			if ($records[$i]->status == '') {
				$records[$i]->status = 'owner';
			}		
		}    	
    	return $records; 
    }
    
    /**
    * contributor képernyőn megadott adatok tárolása
    * @param User $user
    * @param Request $request
    * @return bool  sikeres vagy nem
    */
    public function saveFormData($user, $request): bool {
		$result = false;
		\DB::transaction(function() use ($user, $request, &$result) {
		    	// tárolás a projects táblába
		        $contributor = \DB::table('contributors');
		        $contributor->where('project_id','=',$request->input('project_id'));
		        $contributor->where('user_id','=',$request->input('user_id'))->get();
				$rec = [
			        'description' => $request->input('description',''),
			        'status' => $request->input('status',''),
			        'evaluation' => $request->input('evaluation',''),
		    	    'grade' => $request->input('grade',''),
		    	    'updated_at' => date('Y-m-d')
				];
				if ($request->input('start') != '') {
		        	$rec['start'] = $request->input('start','');
		        }	
				if ($request->input('end') != '') {
			        $rec['end'] = $request->input('end','');
				}	
				$contributor->update($rec);
		        $result = true;
		});	 // transaction   	
		return $result;    
    }
    
    /**
    * contributor - project - user olvasása project_id és user_id  alapján
    * @param integer $project_id   project.id
    * @param integer $user_id   user.id
    * @return object { project record.., user_name, user_avatar, skills:[{id,name},...] }
    */
    public function fullGet(int $project_id, int $user_id ) {
        $contributor = $this->leftJoin('projects','contributors.project_id','=','projects.id')
			->leftJoin('users','contributors.user_id','=','users.id')
			->select(['contributors.*',
			'projects.name as project_name',
			'projects.avatar as project_avatar',
			'projects.status as project_status',
			'projects.deadline as project_deadline',
			'projects.description as project_description',
			'projects.user_id as project_user_id',
			'users.name as user_name',
			'users.avatar as user_avatar'
			])
            ->where('contributors.user_id','=', $user_id)
            ->where('contributors.project_id','=', $project_id)->first();
		return $contributor;
    }
    
}
    
