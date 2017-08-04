<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 23/07/17
 * Time: 13:44
 */

namespace Resource;


class User extends \Core\Resource implements \Interfaces\Resource
{
    public function getAction($id = null)
    {
        $pdo = \Core\Database::getInstance();
        if(is_null($id))
        {
            $request = $pdo->query('SELECT * FROM user');
        }
        else
        {
            $request = $pdo->prepare('SELECT * FROM user WHERE id = :idUser');
            $request->execute(['idUser'=>$id]);
        }
        $data = $request->fetchAll();
        if(!is_null($id) && empty($data))
        {
            return $this->sendErrorCode(404);
        }
        $request->closeCursor();
        return $this->sendResponse($data);
    }

    public function postAction()
    {
        $this->sendErrorCode(404);
        return false;
    }

    public function putAction($id)
    {
        $this->sendErrorCode(404);
        return false;
    }

    public function deleteAction($id)
    {
        $this->sendErrorCode(404);
        return false;
    }

    public function getFavoriteSongAction($idUser)
    {
        $pdo = \Core\Database::getInstance();
        $query = 'SELECT S.* 
                  FROM user_favorite_song UFS 
                  INNER JOIN song S ON S.id = UFS.id_song
                  WHERE UFS.id_user = :idUser
                  ';
        $request = $pdo->prepare($query);
        $request->execute(['idUser'=>$idUser]);
        $data = $request->fetchAll();

        $request->closeCursor();

        return $this->sendResponse($data);
    }
}