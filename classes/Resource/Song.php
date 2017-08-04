<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 24/07/17
 * Time: 12:00
 */

namespace Resource;


class Song extends \Core\Resource implements \Interfaces\Resource
{
    public function getAction($id = null)
    {
        $pdo = \Core\Database::getInstance();
        if(is_null($id))
        {
            $request = $pdo->query('SELECT * FROM song');
        }
        else
        {
            $request = $pdo->prepare('SELECT * FROM song WHERE id = :idUser');
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
}