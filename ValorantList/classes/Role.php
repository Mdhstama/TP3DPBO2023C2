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

    function addRole($data)
    {
        $name_role = $data['nama'];
        $query = "INSERT INTO tb_role VALUES ('','$name_role')";
        return $this->executeAffected($query);
    }

    function deleteRole($id)
    {
        $query = "DELETE FROM tb_role WHERE id_role=$id";
        return $this->executeAffected($query);
    }

    function searchRole($keyword)
    {
        $query = "SELECT * FROM tb_role WHERE name_role LIKE '%$keyword%' ORDER BY id_role";
        return $this->execute($query);
    }

    function updateRole($id, $data)
    {
        $nama_role = $data['nama'];
        $query = "UPDATE tb_role SET name_role = '$nama_role' WHERE id_role=$id";
        return $this->executeAffected($query);
    }
}

?>