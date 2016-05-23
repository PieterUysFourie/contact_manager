<?php

namespace controllers;

use models\ContactsModel;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = ContactsModel::getAll();
        $favorites = ContactsModel::getBy('favorite', 1);
        $nav = 'contacts';
        require_once 'views/contacts/index.php';
    }

    /**
     * Deletes the specified contact
     * 
     * @param int $id
     */
    public function deleteContact($id)
    {
        $contact = ContactsModel::find($id);
        $contact->delete();
        $this->redirect('/contacts');
    }

    /**
     * @param array $post
     */
    public function postContact($post)
    {
        $contact = new ContactsModel(
            [
                'name' => $post['name'],
                'email' => $post['email'],
                'phone' => $post['phone'],
            ]
        );
        
        if (!empty($post['id'])) 
        {
            $contact->id = $post['id'];
        }
        
        $contact->save();
        $this->redirect('/contacts');
    }

    /**
     * Toggle the favorite status of a contact
     * 
     * @param int $id
     */
    public function favorite($id)
    {
	    $contact = ContactsModel::find($id);
        $contact->favorite = ($contact->favorite) ? FALSE : TRUE;
        $contact->save();
        
        $this->redirect('/contacts');
    }

    /**
     * Search contacts
     * 
     * @param string $keyword
     */
    public function search($keyword)
    {
        $key = '%' . $keyword . '%';
        
        $contacts = ContactsModel::where(
            [
                'name' => [
                    'joiner' => 'OR',
                    'operator' => 'LIKE',
                    'value' => $key
                ],
                'email' => [
                    'joiner' => 'OR',
                    'operator' => 'LIKE',
                    'value' => $key
                ],
                'phone' => [
                    'joiner' => 'OR',
                    'operator' => 'LIKE',
                    'value' => $key
                ],
            ]
        );

        $nav = 'contacts';
        require_once 'views/contacts/index.php';
    }

    /**
     * Display only favorite contacts
     */
    public function favorites()
    {
        $favorites = ContactsModel::getBy('favorite', 1);
        $nav = 'favorites';
        require_once 'views/contacts/index.php';
    }
}
