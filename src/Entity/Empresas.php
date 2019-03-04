<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmpresasRepository")
 */
class Empresas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $nuSeqEmpresa;

    /**
     * @ORM\Column(type="text",length=14)
     */
    private $coCnpj;

    /**
     * @ORM\Column(type="text",length=100)
     */
    private $razaoSocial;


    //  Getters

    public function getNuSeqEmpresa(): ?int
    {
        
        return $this->nuSeqEmpresa;
    }

    public function getCoCnpj()
    {
        
        return $this->coCnpj;
    }

    public function getRazaoSocial()
    {
        
        return $this->razaoSocial;
    }

    //  Setters

    public function setCoCnpj($cnpj)
    {
        $this->coCnpj=$cnpj;
    }

    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial=$razaoSocial;
    }
    
}
