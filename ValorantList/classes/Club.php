<?php

class Club extends DB
{
    function getClub()
    {
        $query = "SELECT * FROM tb_team";
        return $this->execute($query);
    }

    function getClubById($id)
    {
        $query = "SELECT * FROM tb_team WHERE id_role = $id";
        return $this->execute($query);
    }

    function updateClub($id, $data)
    {
    }

    function addClub($data)
    {
        $name_team = $data['nama'];
        $query = "INSERT INTO tb_team VALUES ('','$name_team')";
        return $this->executeAffected($query);
    }

    function deleteClub($id)
    {
        $query = "DELETE FROM tb_team WHERE id_club=$id";
        return $this->executeAffected($query);
    }

    function searchClub($keyword)
    {
        $query = "SELECT * FROM tb_team WHERE name_team LIKE '%$keyword%' ORDER BY id_club";
        return $this->execute($query);
    }

}

?>