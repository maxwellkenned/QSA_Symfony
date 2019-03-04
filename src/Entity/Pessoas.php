<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PessoasRepository")
 */
class Pessoas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $nuSeqPessoa;

    /**
     * @ORM\Column(type="integer")
     */
    private $nuSeqEmpresa;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $dsNome;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $coCpfCnpj;

    // Getters
    public function getNuSeqPessoa(): ?int
    {
        
        return $this->nuSeqPessoa;
    }

    public function getDsNome(): ?string
    {
        
        return $this->dsNome;
    }

    public function getNuSeqEmpresa(): ?int
    {
        
        return $this->nuSeqEmpresa;
    }

    public function getCoCpfCnpj(): ?string
    {
        
        return $this->coCpfCnpj;
    }

    // Setters
    
    public function setNuSeqEmpresa(int $nuSeqEmpresa): self
    {
        $this->nuSeqEmpresa = $nuSeqEmpresa;

        return $this;
    }

    public function setDsNome(string $dsNome): self
    {
        $this->dsNome = $dsNome;

        return $this;
    }

    public function setCoCpfCnpj(string $coCpfCnpj): self
    {
        $this->coCpfCnpj = $coCpfCnpj;

        return $this;
    }
}
