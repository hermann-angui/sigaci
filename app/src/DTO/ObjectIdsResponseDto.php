<?php

namespace App\DTO;

class ObjectIdsResponseDto {

    private ?array $villes = null;
    private ?array $departments = null;
    private ?array $communes = null;
    private ?array $nationalities = null;
    private ?array $crms = null;
    private ?array $metiers = null;
    private ?array $corpsMetiers = null;
    private ?array $pays = null;
    private ?array $sousPrefectures = null;
    private ?array $categoryArtisans = null;

    /**
     * @return array|null
     */
    public function getVilles(): ?array
    {
        return $this->villes;
    }

    /**
     * @param array|null $villes
     * @return ObjectIdsResponseDto
     */
    public function setVilles(?array $villes): ObjectIdsResponseDto
    {
        $this->villes = $villes;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getDepartments(): ?array
    {
        return $this->departments;
    }

    /**
     * @param array|null $departments
     * @return ObjectIdsResponseDto
     */
    public function setDepartments(?array $departments): ObjectIdsResponseDto
    {
        $this->departments = $departments;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getCommunes(): ?array
    {
        return $this->communes;
    }

    /**
     * @param array|null $communes
     * @return ObjectIdsResponseDto
     */
    public function setCommunes(?array $communes): ObjectIdsResponseDto
    {
        $this->communes = $communes;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getNationalities(): ?array
    {
        return $this->nationalities;
    }

    /**
     * @param array|null $nationalities
     * @return ObjectIdsResponseDto
     */
    public function setNationalities(?array $nationalities): ObjectIdsResponseDto
    {
        $this->nationalities = $nationalities;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getCrms(): ?array
    {
        return $this->crms;
    }

    /**
     * @param array|null $crms
     * @return ObjectIdsResponseDto
     */
    public function setCrms(?array $crms): ObjectIdsResponseDto
    {
        $this->crms = $crms;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getMetiers(): ?array
    {
        return $this->metiers;
    }

    /**
     * @param array|null $metiers
     * @return ObjectIdsResponseDto
     */
    public function setMetiers(?array $metiers): ObjectIdsResponseDto
    {
        $this->metiers = $metiers;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getCorpsMetiers(): ?array
    {
        return $this->corpsMetiers;
    }

    /**
     * @param array|null $corpsMetiers
     * @return ObjectIdsResponseDto
     */
    public function setCorpsMetiers(?array $corpsMetiers): ObjectIdsResponseDto
    {
        $this->corpsMetiers = $corpsMetiers;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getPays(): ?array
    {
        return $this->pays;
    }

    /**
     * @param array|null $pays
     * @return ObjectIdsResponseDto
     */
    public function setPays(?array $pays): ObjectIdsResponseDto
    {
        $this->pays = $pays;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getSousPrefectures(): ?array
    {
        return $this->sousPrefectures;
    }

    /**
     * @param array|null $sousPrefectures
     * @return ObjectIdsResponseDto
     */
    public function setSousPrefectures(?array $sousPrefectures): ObjectIdsResponseDto
    {
        $this->sousPrefectures = $sousPrefectures;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getCategoryArtisans(): ?array
    {
        return $this->categoryArtisans;
    }

    /**
     * @param array|null $categoryArtisans
     * @return ObjectIdsResponseDto
     */
    public function setCategoryArtisans(?array $categoryArtisans): ObjectIdsResponseDto
    {
        $this->categoryArtisans = $categoryArtisans;
        return $this;
    }


}
