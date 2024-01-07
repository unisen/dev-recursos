<?php
namespace ProjectSend\Classes;

use \ProjectSend\Classes\Validation;
use \Cocur\Slugify\Slugify;
use \PDO;

class Folder
{
    protected $id;
    protected $uuid;
    protected $name;
    protected $slug;
    protected $parent;
    protected $user_id;
    protected $public;

    public function __construct($id = null)
    {
        global $dbh;

        $this->dbh = $dbh;
        $this->logger = new \ProjectSend\Classes\ActionsLog;

        if (!empty($id)) {
            $this->get((int)$id);
        }
    }

    public function __get($name)
    {
        return html_output($this->$name);
    }

    /**
     * Set the ID
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Return the ID
     * @return int
     */
    public function getId()
    {
        if (!empty($this->id)) {
            return $this->id;
        }

        return false;
    }

    /**
     * Set the properties when editing
     */
    public function set($arguments = [])
    {
		$this->name = (!empty($arguments['name'])) ? encode_html($arguments['name']) : null;
        $this->parent = (!empty($arguments['parent'])) ? encode_html($arguments['parent']) : null;
        $this->public = (!empty($arguments['public'])) ? (int)$arguments['public'] : 0;
    }

    /**
     * Get existing user data from the database
     * @return bool
     */
    public function get($id)
    {
        $this->id = $id;

        $this->statement = $this->dbh->prepare("SELECT * FROM " . TABLE_FOLDERS . " WHERE id=:id");
        $this->statement->bindParam(':id', $this->id, PDO::PARAM_INT);
        $this->statement->execute();
        $this->statement->setFetchMode(PDO::FETCH_ASSOC);

        if ($this->statement->rowCount() == 0) {
            return false;
        }
    
        while ($this->row = $this->statement->fetch() ) {
            $this->uuid = html_output($this->row['uuid']);
            $this->name = html_output($this->row['name']);
            $this->slug = html_output($this->row['slug']);
            $this->parent = html_output($this->row['parent']);
            $this->user_id = html_output($this->row['user_id']);
            $this->public = html_output($this->row['public']);
        }
    }

    public function create()
    {
        if (empty($this->name)) {
            return false;
        }

        if (!$this->validate()) {
            return false;
        }

        try {
            $slugify = new Slugify();
    
            $this->uuid = uniqid();
            $this->parent = (!empty($this->parent)) ? $this->parent : null;
            $this->slug = $slugify->slugify($this->name);
            $this->user_id = CURRENT_USER_ID;
    
            $statement = $this->dbh->prepare("INSERT INTO " . TABLE_FOLDERS . " (uuid, name, slug, parent, public, user_id) VALUES (:uuid, :name, :slug, :parent, :public, :user_id)");
            $statement->bindParam(':uuid', $this->uuid);
            $statement->bindParam(':name', $this->name);
            $statement->bindParam(':slug', $this->slug);
            $statement->bindParam(':parent', $this->parent);
            $statement->bindParam(':public', $this->public);
            $statement->bindParam(':user_id', $this->user_id);
            $statement->execute();

            $this->id = $this->dbh->lastInsertId();

            return true;
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }

    public function getData()
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'slug' => $this->slug,
            'parent' => $this->parent,
            'user_id' => $this->user_id,
            'public' => $this->public,
        ];
    }

    public function userCanEdit($user_id)
    {
        $user = new \ProjectSend\Classes\Users($user_id);
        if (in_array($user->role, [9,8,7])) {
            return true;
        }

        if ($this->user_id == $user_id) {
            return true;
        }

        return false;
    }

    public function userCanNavigate($user_id)
    {
        if ($this->public == 1) {
            return true;
        }

        // If top level is public, this is too
        $hierarchy = $this->getHierarchy();
        $top_level = $hierarchy[array_key_last($hierarchy)];
        if ($top_level['public'] == 1) {
            return true;
        }

        return $this->userCanEdit($user_id);
    }

    public function userCanDelete($user_id)
    {
        $user = new \ProjectSend\Classes\Users($user_id);
        if (in_array($user->role, [9,8,7])) {
            return true;
        }

        if ($this->user_id == $user_id) {
            return true;
        }

        return false;
    }

    public function setNewParent($user_id, $new_parent_id)
    {
        if (empty($this->id)) {
            return false;
        }

        if ($this->userCanEdit($user_id) && $this->validate()) {
            if (empty($new_parent_id)) {
                $new_parent_id = null;
            } else {
                $new_parent_id = (int)$new_parent_id;
            }

            if ($new_parent_id == $this->id) {
                return false;
            }

            if ($this->validate()) {
                $statement = $this->dbh->prepare("UPDATE " . TABLE_FOLDERS . " SET parent=:parent_id WHERE id=:id");
                $statement->bindParam(':id', $this->id);
                $statement->bindParam(':parent_id', $new_parent_id);
                if ($statement->execute()) {
                    $this->parent = $new_parent_id;
                    return true;
                }
            }

            $this->get($this->id);
        }

        return false;
    }

    public function rename($name)
    {
        if (empty($this->id)) {
            return false;
        }

        if ($this->userCanEdit(CURRENT_USER_ID)) {
            $this->name = $name;

            if ($this->validate()) {
                $statement = $this->dbh->prepare("UPDATE " . TABLE_FOLDERS . " SET name=:name WHERE id=:id");
                $statement->bindParam(':id', $this->id);
                $statement->bindParam(':name', $name);
                if ($statement->execute()) {
                    return true;
                }
            }
        }

        // Refresh data
        $this->get($this->id);

        return false;
    }

    public function delete()
    {
        if (!$this->userCanDelete(CURRENT_USER_ID)) {
            return false;
        }

        $deleted = [
            'files' => [],
            'folder' => [],
        ];

        $descendants = $this->getAllDescendants($this->id);
        // reverse, to make sure that a folder that cannot be deleted is no left without parent
        $descendants = array_reverse($descendants);
        foreach ($descendants as $descendant) {
            $files_in_folder = [];
            $statement = $this->dbh->prepare("SELECT * FROM " . TABLE_FILES . " WHERE folder_id=:id");
            $statement->bindParam(':id', $descendant['id']);
            $statement->execute();
            if ($statement->rowCount() > 0) {
                $statement->setFetchMode(\PDO::FETCH_ASSOC);
                while ($row = $statement->fetch()) {
                    $files_in_folder[] = $row['id'];
                }
            }

            // Attempt to delete folder
            $folder = new \ProjectSend\Classes\Folder($descendant['id']);
            if (!$folder->userCanDelete(CURRENT_USER_ID)) {
                continue;
            }

            if (!$folder->deleteFromDatabase()) {
                continue;
            }

            $deleted['folders'][] = $folder->id;

            // Find and delete files, only if the folder was actually deleted before
            foreach ($files_in_folder as $file_id) {
                $file = new \ProjectSend\Classes\Files($file_id);
                if ($file->deleteFiles()) {
                    $deleted['files'][] = $file->id;
                }
            }
        }

        return $deleted;
    }

    public function deleteFromDatabase()
    {
        $sql = $this->dbh->prepare("DELETE FROM " . TABLE_FOLDERS . " WHERE id = :id");
        $sql->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $sql->execute();
    }

    public function currentUserCanAssignToFolder()
    {
        if (in_array(CURRENT_USER_LEVEL, [9, 8, 7])) {
            return true;
        }

        if ($this->user_id == CURRENT_USER_ID) {
            return true;
        }

        if ($this->public == '1') {
            return client_can_assign_to_public_folder(CURRENT_USER_ID);
        }
        
        return false;
    }

    private function validate()
    {
        global $json_strings;

        $validation = new \ProjectSend\Classes\Validation;

        $validation_items = [
            $this->name => [
                'required' => ['error' => $json_strings['validation']['no_name']],
            ],
            $this->parent => [
                'number' => ['error' => sprintf($json_strings['validation']['numeric'], 'parent')],
            ],
            $this->user_id => [
                'number' => ['error' => sprintf($json_strings['validation']['numeric'], 'user_id')],
            ],
        ];

        $validation->validate_items($validation_items);

        if ($validation->passed()) {
            $this->validation_passed = true;
            return true;
        } else {
            $this->validation_passed = false;
            $this->validation_errors = $validation->list_errors();
        }

        return false;
    }

    function getHierarchy()
    {
        return $this->getHierarchyFrom($this->id);
    }

    function getHierarchyFrom($folder_id = null, array $hierarchy = [])
    {
        global $dbh;
        $folder_id = (int)$folder_id;
    
        // Add current folder
        $folder = new \ProjectSend\Classes\Folder($folder_id);
        $hierarchy[] = $folder->getData();
    
        // Parents
        if ($folder_id != null) {
            $query = "SELECT * FROM " . TABLE_FOLDERS . " WHERE id=:id";
            $params[':id'] = (int)$folder_id;
            $statement = $dbh->prepare($query);
            $statement->execute($params);
            if ($statement->rowCount() > 0) {
                $statement->setFetchMode(\PDO::FETCH_ASSOC);
                while ($row = $statement->fetch()) {
                    if ($row['parent'] != null) {   
                        $hierarchy = $this->getHierarchyFrom($row['parent'], $hierarchy);
                    }
                }
            }
        }
    
        return $hierarchy;
    }

    function getAllDescendants($folder_id = null, array $descendants = [])
    {
        global $dbh;
        $folder_id = (int)$folder_id;

        // Add current folder
        $folder = new \ProjectSend\Classes\Folder($folder_id);
        $descendants[] = $folder->getData();
        
        // Children
        if ($folder_id != null) {
            $query = "SELECT * FROM " . TABLE_FOLDERS . " WHERE parent=:id";
            $params[':id'] = (int)$folder_id;
            $statement = $dbh->prepare($query);
            $statement->execute($params);
            if ($statement->rowCount() > 0) {
                $statement->setFetchMode(\PDO::FETCH_ASSOC);
                while ($row = $statement->fetch()) {
                    $descendants = $this->getAllDescendants($row['id'], $descendants);
                }
            }
        }
    
        return $descendants;
    }
}
