<?php
namespace Interfaces;
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 23/07/17
 * Time: 13:39
 */
interface Resource
{
    public function getAction($id = null);
    public function postAction();
    public function putAction($id);
    public function deleteAction($id);
}