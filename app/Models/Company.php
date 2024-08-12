<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
require_once("../app/bitrix.php");


class Company extends Model
{
    use HasFactory;
    protected $fillable = ['ID','TITLE','EMAIL'];
    protected $primaryKey = 'ID';
    public $incrementing = false;
    protected $keyType = 'string';

    public static function bitrixSetCompany($title, $email)
    {
        $endpoint = '/crm.company.add';
        $data = http_build_query(array(
            'fields' => array(
                "TITLE" => $title,
                "EMAIL" =>  array(
                    array(
                        "VALUE" => $email,
                        "VALUE_TYPE" => "WORK"
                    )
                ),
            ),
            'params' => array("REGISTER_SONET_EVENT" => "Y")
        ));

        $result = webhook($endpoint,$data);
        return $result;

    }
    public static function bitrixGetCompany($id)
    {
        $endpoint = '/crm.company.get';
        $data = http_build_query(array(
            "ID" => $id,
        ));
        return webhook($endpoint,$data);
    }

    public static function bitrixCompanyList(){
        $endpoint =  '/crm.company.list';
        $data = http_build_query(array(
                'order' => array("DATE_CREATE" => "ASC"),
                'select' => array("ID", "TITLE", "EMAIL"),
            )
        );

        return webhook($endpoint,$data);
    }
    public static function bitrixUpdateCompany($title,$email,$id){
        $endpoint =  '/crm.company.update';
        $data = http_build_query(array(
            'ID' => $id,
            'fields' => array(
                "TITLE" => $title,
                "EMAIL" => array(array("VALUE" => $email, "VALUE_TYPE" => "WORK" )),
            )
        ));
        return webhook($endpoint,$data);
    }


    public static function bitrixDeleteCompany($id){
        $endpoint =  '/crm.company.delete';
        $data = http_build_query(array(
            "ID" => $id,
        ));
        return webhook($endpoint,$data);
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'company_contactS', 'COMPANY_ID', 'CONTACT_ID');
    }
}
