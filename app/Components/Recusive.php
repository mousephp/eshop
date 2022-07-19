<?php
namespace App\Components;

class Recusive {
    private $data;
    private $htmlSlelect = '';

    public function __construct($data)
    {
        $this->data = $data;
    }

    public  function categoryRecusive($parentId, $id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                if (!empty($parentId) && $parentId == $value['id']) {
                    $this->htmlSlelect .= "<option selected value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
                } else {
                    $this->htmlSlelect .= "<option value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
                }

                $this->categoryRecusive($parentId, $value['id'], $text. '--');
            }
        }

        return $this->htmlSlelect;
    }

    
    public  function menuRecusive($parentId, $id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                $this->htmlSlelect .= "<li><a href=''>".$value['name']."</a></li>";
                $this->menuRecusive($parentId, $value['id']);
            }
        }

        return $this->htmlSlelect;
    }

    
    public  function permissionRecusive($parentId, $id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                if (!empty($parentId) && $parentId == $value['id']) {
                    $this->htmlSlelect .= "<option selected value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
                } else {
                    $this->htmlSlelect .= "<option value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
                }

                $this->permissionRecusive($parentId, $value['id'], $text. '--');
            }
        }
        
        return $this->htmlSlelect;
    }



}
