<?php
namespace classes;

/**
 * Created by PhpStorm.
 * User: Neal
 * Date: 5/24/2018
 * Time: 10:12 PM
 */
interface PortalInterface
{
    public function create();

    public function read();

    public function read_one();

    public function delete();

}