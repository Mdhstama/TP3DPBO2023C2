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

}

?>