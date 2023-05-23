<?php

class Role extends DB
{
    function getRole()
    {
        $query = "SELECT * FROM tb_role";
        return $this->execute($query);
    }

    function getRoleById($id)
    {
        $query = "SELECT * FROM tb_role WHERE id_role=$id";
        return $this->execute($query);
    }
}

?>