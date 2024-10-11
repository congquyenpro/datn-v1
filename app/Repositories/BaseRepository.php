<?php
namespace App\Repositories;

use App\Contracts\Repositories\IBaseRepository;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function updateOrCreate(array $conditions, array $data)
    {
        return $this->model->updateOrCreate($conditions, $data);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->model->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function getByField($field, $value)
    {
        return $this->model->where($field, $value)->get();
    }
    
    //get all records with specific fields
    public function getWithFields($fields)
    {
        return $this->model->get($fields);
    }
    // Get all records with specific fields and conditions
    public function getFieldsWithConditions($fields, $conditions)
    {
        $query = $this->model->select($fields);
        foreach ($conditions as $field => $value) {
            $query = $query->where($field, $value);
        }
        return $query->get();
    }

    //get all records except specific fields
    public function getExceptFields($fields)
    {
        return $this->model->select($fields)->get();
    } 

    public function send_response($status, $message, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }


    // Fix XSS HTML tag
    public function remove_tag($string)
    {
        $patterns = '/(<([^>]+)>)/i';
        $replacement = "";
        return preg_replace($patterns, $replacement, $string);
    }

    public function to_reset($string)
    {
        $str = trim(mb_strtolower($string));
        $str = preg_replace('/\s+/', '', $str);
        return $str;
    }

    public function to_slug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(–)/', ' ', $str);
        $str = preg_replace('/(")/', '', $str);
        $str = preg_replace('/(”)/', '', $str);
        $str = preg_replace('/(“)/', '', $str);
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/(\[|\])/', '', $str);
        $str = preg_replace('/(\/)/', '-', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
}