<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/*
class ProfileRec {
    public $id = 0;
    public $sysadmin = 0;
    public $voluntary = 0;
    public $web_site_owner = 0;
    public $publicinfo =  "";
    public $created_at = "1900-01-01 00:00:00";
    public $updated_at = "1900-01-01 00:00:00";
}
*/

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profile';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $errorMsg = '';
    
    /**
     * utolsó müvelet hibaüzenete
     * @return string
     */
    public function getErrorMsg(): string {
        return $this->errorMsg;
    }
    
    /**
     * profile rekord olvasása (ha nincs; létrehozása) id alapján
     * @param int $id
     * @return ProfileRec
     */
    public function getById(int $id)  {
        $this->errorMsg = '';
        $result = $this->where('id','=',$id)->first();
        if (!$result) {
            $arr = [
                "id" => $id,
                "sysadmin" => 0, 
                "voluntary" => 0, 
                "web_site_owner" => 0, 
                "publicinfo" => ""
            ];
            $this->insert($arr);
            $result = $this->where('id','=',$id)->first();
        }
        return $result;
    }
    
    /**
     * profile rekord olvasása (ha nincs létrehozása) email alapján
     * @param string $email
     * @return ProfileRec
     */
    public function getByEmail(string $email)  {
        $this->errorMsg = '';
        $user = User::where('email','=',$email)->first();
        if ($user) {
            $result = $this->getById($user->id);
        } else {
            $result = JSON_decode('{"id":0, 
                "sysadmin":0, "voluntary":0,
                "web_site_owner":0, "publicinfo":""}');
        }
        return $result;
    }
    
    /**
     * rekord tárolása (isert vagy update)
     * @param ProfileRec $profileRecord
     * @return bool
     */
    public function saveRec($profileRecord): bool {
        $this->errorMsg = '';
        $arr = ["id" => $profileRecord->id,
            "sysadmin" => $profileRecord->sysadmin,
            "voluntary" => $profileRecord->voluntary,
            "web_site_owner" => $profileRecord->web_site_owner,
            "publicinfo" => $profileRecord->publicinfo
        ];
        try {
            if ($profileRecord->id == 0) {
                $this->insert($arr);   
            } else {
                $this->where('id','=',$profileRecord->id)->update($arr);
            }
            $result = true;
        } catch (Exception $e) {
            $result = false;
            $this->errorMsg = $e->getMessage();
        }
        return $result;
    }
    
    /**
     * sysadmin -ok beolvasása
     * @return array
     */
    public function getSysadmins(): array {
        return \DB::select('select u.id, u.name
            from users u, profile p
            where u.id = p.id and p.sysadmin = 1
            order by u.name');
    }
    
    
}
    
