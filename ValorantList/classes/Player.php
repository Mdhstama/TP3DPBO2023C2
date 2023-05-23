<?php

class Player extends DB
{
    function getHuman()
    {
        $query = "SELECT * FROM tb_human";
        return $this->execute($query);
    }

    function getHumanJoin()
    {
        $query = "SELECT * FROM tb_human JOIN tb_team ON tb_human.id_club=tb_team.id_club JOIN tb_role ON tb_human.id_role=tb_role.id_role ORDER BY tb_human.id_player";

        return $this->execute($query);
    }

    function getHumanById($id)
    {
        $query = "SELECT * FROM tb_human WHERE id_player = $id";
        return $this->execute($query);
    }

    function getHumanByIdJoin($id)
    {
        $query = "SELECT * FROM tb_human JOIN tb_team ON tb_human.id_club=tb_team.id_club JOIN tb_role ON tb_human.id_role=tb_role.id_role WHERE id_player = $id ORDER BY tb_human.id_player ";

        return $this->execute($query);
    }

    function addPlayer($data, $file)
    {
        $real_name = $data['real_name'];
        $in_game_nickname = $data['in_game_nick'];
        $nationality = $data['nationality'];
        $id_club = $data['club'];
        $id_role = $data['role'];

        $img = $file['img']['name'];
        $container = $file['img']['tmp_name'];
        $path = 'assets/' . $img;
        $isMoved = move_uploaded_file($container, $path);
        if (!$isMoved) {
            $img = 'photo.jpg';
        }

        $query = "INSERT INTO tb_human VALUES (NULL, '$real_name', '$in_game_nickname', '$nationality', '$img', $id_club, $id_role)";

        return $this->executeAffected($query);
    }

    function updatePlayer($id, $data, $file)
    {


    }

    function searchPlayer($keyword)
    {
        $query = "SELECT * FROM tb_human JOIN tb_team ON tb_human.id_club=tb_team.id_club JOIN tb_role ON tb_human.id_role=tb_role.id_role WHERE tb_human.in_game_nickname LIKE '%$keyword%' ORDER BY tb_human.id_player ";

        return $this->execute($query);
    }
}

?>