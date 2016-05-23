<?php

namespace models;

class ContactsModel extends BaseModel
{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $photo;

    /**
     * ContactsModel constructor.
     *
     * @param array $row
     */
    public function __construct(array $row)
    {
        parent::__construct($row);
        
        if (empty($this->photo))
        {
            $this->photo = "/img/default_profile.png";
        }
    }
}
