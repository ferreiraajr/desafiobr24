<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
require_once("../app/bitrix.php");


class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['ID', 'NAME', 'LAST_NAME'];
    protected $primaryKey = 'ID';
    public $incrementing = false;
    protected $keyType = 'string';

    public static function bitrixSetContact($name, $last_name)
    {
        $endpoint = '/crm.contact.add';
        $data = http_build_query(array(
            'fields' => array(
                "NAME" => $name,
                "LAST_NAME" => $last_name
            ),
            'params' => array("REGISTER_SONET_EVENT" => "Y")
        ));

        $result = webhook($endpoint,$data);
        return $result;
    }
    public static function bitrixUpdateContact($name, $last_name, $id)
    {
        $endpoint =  '/crm.contact.update';
        $data = http_build_query(array(
            'ID' => $id,
            'fields' => array(
                "NAME" => $name,
                "LAST_NAME" => $last_name
            )
        ));
        return webhook($endpoint,$data);
    }

    public static function bitrixDeleteContact($id){
        $endpoint =  '/crm.contact.delete';
        $data = http_build_query(array(
            "ID" => $id,
        ));
        return webhook($endpoint,$data);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_contacts', 'CONTACT_ID', 'COMPANY_ID');
    }

}
