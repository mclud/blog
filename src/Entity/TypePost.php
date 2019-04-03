<?php
/**
 * Created by PhpStorm.
 * User: LD
 * Date: 30/03/2019
 * Time: 02:13
 */

class TypePost
{
    private $id, $libelle;

    public function hydrate(array $data) {
        foreach ($data as $setter => $value) {
            $method = 'set'.ucfirst($setter);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }
}