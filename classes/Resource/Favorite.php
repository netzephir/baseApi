<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 24/07/17
 * Time: 11:45
 */

namespace Resource;

use Core\Database;

class Favorite extends \Core\Resource implements \Interfaces\Resource
{
    public function getAction($id = null)
    {
        if(is_null($id))
        {
            return $this->sendErrorCode(404);
        }

        return true;
    }

    public function postAction()
    {
        $params = $this->getRequest()->getParams();
        if(!isset($params['id_song']) || !is_numeric($params['id_song']) || !isset($params['id_user']) || !is_numeric($params['id_user']))
        {
            $this->sendErrorCode(400, 'Missing param');
            return true;
        }
        $query = 'INSERT INTO user_favorite_song SET id_song = :idSong, id_user = :idUser';
        $pdo = Database::getInstance();
        $request = $pdo->prepare($query);
        $result = $request->execute(['idSong'=>$params['id_song'], 'idUser'=>$params['id_user']]);
        if(!$result)
        {
            return $this->sendErrorCode(500, 'Sql error');
        }
        $lastId = $pdo->lastInsertId();
        return $this->sendResponse(['result'=>true,'id'=>$lastId], 201);
    }

    public function putAction($id)
    {
        $this->sendErrorCode(404);
        return true;
    }

    public function deleteAction($id)
    {
        $pdo = Database::getInstance();
        $request = $pdo->prepare('DELETE FROM user_favorite_song WHERE id = :id');
        $result = $request->execute(['id'=>$id]);
        if(!$result)
        {
            return $this->sendErrorCode(500, 'Sql error');
        }
        return $this->sendResponse(['result'=>true]);
    }
}