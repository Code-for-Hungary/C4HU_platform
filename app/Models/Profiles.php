<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profiles extends Model
{
    use HasFactory;
    
    /**
     * sysadmin -ok beolvasása
     * @return array
     */
    public function getSysadmins(): array {
        return \DB::select('select u.id, u.name
            from users u, profiles p
            where u.id = p.id and p.sysadmin = 1
            order by u.name');
    }
    
    /**
    * profile-user-skills lista
    * @param integer $limit sor/lap
    * @param string  $orderField rendezés erre a mezőre
    * @param string  $orderDir 'ASC' vagy 'DESC'
    * @param string  $filter '[skillId, skillId,...]'
    * használja a request->input('page') -t is
    * @return paginator object + ->orderField, ->orderDir, ->filter 
    */
    public function paginateOrderFilter(int $limit, string $orderField, string $orderDir, string $filter) {
        $query = \DB::table('profiles');
    	$query->leftJoin('users','profiles.id','=','users.id')
    	      ->leftJoin('profile_skills','profiles.id','=','profile_skills.profile_id')
    	      ->leftJoin('skills','profile_skills.skill_id','=','skills.id')
    		  ->select('profiles.id',
    			 'users.avatar',
    			 'users.name',
    			 'profiles.publicinfo', 
    			  \DB::raw("GROUP_CONCAT(skills.name SEPARATOR ', ') as `skills`"))
    			 ->groupBy(['profiles.id','users.avatar','users.name','profiles.publicinfo'])
    			 ->orderBy($orderField, $orderDir)
   			     ->where('profiles.voluntary','=',1);
   		if ($filter != '[]') {
			$filterArray = JSON_decode($filter);   		
			$query->whereIn('skills.id',$filterArray);
   		}		     
    	$profiles = $query->paginate($limit);
    	$profiles->orderField = $orderField; 
    	$profiles->orderDir = $orderDir;
    	$profiles->filter = $filter;
    	return $profiles; 
    }
    
    /**
    * profile képernyőn megadott adatok tárolása
    * @param User $user
    * @param Request $request
    * @return bool  sikeres vagy nem
    */
    public function saveFormData($user, $request): bool {
		$result = false;
		\DB::transaction(function() use ($user, $request, &$result) {
		    	// tárolás a profile táblába
		        $profileModel = new Profiles();
		        $profileCount = $profileModel->all()->count();
		        $profile = $profileModel->where('id','=',$user->id)->first();
		        $profile->id = $user->id;
		        $profile->voluntary = $request->input('voluntary',0);
		        $profile->project_owner = $request->input('project_owner',0);
		        $profile->publicinfo = $request->input('publicinfo','').' ';
		        // ha csak ez az egy profile van; akkor legyen sysadmin
		        if ($profileCount <= 1) {
					$profile->sysadmin = 1;		        
		        }
				$profile->save();	        

		        $user->avatar = $request->input('avatar','');
		        if ($user->avatar == '') {
		        	$user->avatar = 'https://gravatar.com/avatar/'.md5($user->email).
					'?default='.urlencode(url('/').'/assets/img/noavatar.png');
				}
		        $user->save();
		        
		        // tárolás a profile_skills táblába
		        $profile_skillsModel = new Profile_skills();
		        $profile_skillsModel->where('profile_id','=',$user->id)->delete();
		        $skills = JSON_decode($request->input('skills','{}'));
		        foreach ($skills as $key => $value) {
			        $profile_skillsModel = new Profile_skills();
		        	$profile_skillsModel->skill_id = $key;
		        	$profile_skillsModel->profile_id = $user->id;
		        	$profile_skillsModel->level = $value;
		        	$profile_skillsModel->save();
		        }
		        $result = true;
		});	 // transaction   	
		return $result;    
    }
    
    /**
    * profile - profile_skills - skills olvasása id alapján
    * @param integer $id   profiles.id
    * @return object { profile record.., skills:[{id,name,level},...] }
    */
    public function fullGet(int $id) {
        $profileCount = $this->all()->count();
        $profile = $this->where('id','=', $id)->first();
        // ha még nincs profil rekord ehhez a userhez akkor most létrehozzuk
        if (! $profile ) {
        	$profile = new Profiles();
        	$profile->id = $id;
        	$profile->voluntary = 0;
        	$profile->project_owner = 0;
        	$profile->publicinfo = '';
        	if ($profileCount <= 0) {
        		$profile->sysadmin = 1;
        	} else {
        		$profile->sysadmin = 0;
        	}	
        	$profile->save();
        }
		$profile->skills = \DB::table('profile_skills')
			->leftJoin('skills','profile_skills.skill_id','=','skills.id')
			->select(['skills.id as id','skills.name as name','profile_skills.level as level'])
			->where('profile_skills.profile_id','=',$id)
			->get();
		$user = User::where('id','=',$id)->first();
		if ($user) {
			$profile->name = $user->name;
			$profile->avatar = $user->avatar;
		}	
		return $profile;
    }
    
}
    
