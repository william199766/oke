<?php


class Category
{
    private $id_cat;
    private $name_cat;

    /**
     * @return mixed
     */
    public function getIdCat()
    {
        return $this->id_cat;
    }

    /**
     * @param mixed $id_cat
     */
    public function setIdCat($id_cat)
    {
        $this->id_cat = $id_cat;
    }

    /**
     * @return mixed
     */
    public function getNameCat()
    {
        return $this->name_cat;
    }

    /**
     * @param mixed $name_cat
     */
    public function setNameCat($name_cat)
    {
        $this->name_cat = $name_cat;
    }

}
?>