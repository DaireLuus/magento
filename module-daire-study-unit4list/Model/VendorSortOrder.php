<?php


namespace Lumav\DaireStudyUnit4list\Model;


class VendorSortOrder
{
    protected $sorting_field='vendor_id';
    protected $sorting_direction='asc';

    /**
     * @return string
     */
    public function getSortingField(): string
    {
        return $this->sorting_field;
    }

    /**
     * @param string $sorting_field
     */
    public function setSortingField(string $sorting_field)
    {
        $this->sorting_field = $sorting_field;
    }

    /**
     * @return string
     */
    public function getSortingDirection(): string
    {
        return $this->sorting_direction;
    }

    /**
     * @param string $sorting_direction
     */
    public function setSortingDirection(string $sorting_direction)
    {
        $this->sorting_direction = $sorting_direction;
    }


}
